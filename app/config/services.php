<?php
/*
 * MIT License
 *
 * Copyright (c) 2017 Juan Timaná
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
 
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as Flash;
use Phalcon\Cache\Frontend\Output as OutputFrontend;
use Phalcon\Cache\Frontend\Data as FrontendData;
use Phalcon\Cache\Backend\Redis as BackendRedis;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Register the global configuration as config
 */
$di->set('config', $config);

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            $compiler = $volt->getCompiler();

            // All these are filters that are used in the template files
            $compiler->addFilter(
              'number_format', 'number_format'
            );

            $compiler->addFilter('weapon_info', function($resolvedArgs, $exprArgs)
            {
              return '\DRLP\Library\Theme::weapon_info(' . $resolvedArgs . ')';
            });

            $compiler->addFilter('weapon_image', function($resolvedArgs, $exprArgs)
            {
              return '\DRLP\Library\Theme::weapon_image(' . $resolvedArgs . ')';
            });

            $compiler->addFilter('armor_info', function($resolvedArgs, $exprArgs)
            {
              return '\DRLP\Library\Utils::armor_info(' . $resolvedArgs . ')';
            });

            $compiler->addFilter('format_date', function($resolvedArgs, $exprArgs)
            {
              return '\DRLP\Library\Utils::format_date(' . $resolvedArgs . ')';
            });

            $compiler->addFunction('flot', function($resolvedArgs, $exprArgs) use ($compiler)
            {
               $arg1 = $compiler->expression($exprArgs[0]['expr']);
               $arg2 = $compiler->expression($exprArgs[1]['expr']);
               $arg3 = $compiler->expression($exprArgs[2]['expr']);

               return '\DRLP\Library\Utils::flot(' . $arg1 . ', ' . $arg2 . ', ' . $arg3 . ')';
            });

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Dispatcher use a default namespace
 */
$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('DRLP\Controllers');

    return $dispatcher;
});

/**
 * Flash service with custom CSS classes
 */
$di->set('flash', function () {
    return new Flash(array(
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
});

/**
 * Load modelsManager
 */
$di->set('modelsManager', function() {
    return new ModelsManager();
});

/**
 * Loading routes from the router.php file
 */
$di->set('router', function () {
    return require __DIR__ . '/router.php';

    $dispatcher = $di['dispatcher'];

    // Pass the processed router parameters to the dispatcher
    $dispatcher->setControllerName($router->getControllerName());
    $dispatcher->setActionName($router->getActionName());
    $dispatcher->setParams($router->getParams());

    try {

        // Dispatch the request
        $dispatcher->dispatch();

    } catch (Exception $e) {

        // An exception has occurred, dispatch some controller/action aimed for that

        // Pass the processed router parameters to the dispatcher
        $dispatcher->setControllerName('error');
        $dispatcher->setActionName('index');

        // Dispatch the request
        $dispatcher->dispatch();
    }

    // Get the returned value by the last executed action
    $response = $dispatcher->getReturnedValue();

    // Check if the action returned is a 'response' object
    if ($response instanceof Phalcon\Http\ResponseInterface) {

        // Send the response
        $response->send();
    }
});

/**
 * Set the models cache service
 */
$di->set('modelsCache', function () use ($config) {

    // Cache data for one hour by default
    $frontCache = new FrontendData([
      "lifetime" => $config->application->cacheTimeout
    ]);

    // Redis connection settings
    $cache = new BackendRedis(
        $frontCache,
        [
          "host" => $config->redis->host,
          "port" => $config->redis->port
        ]
    );

    return $cache;
});

/**
 * Set the views cache service
 */
$di->set('viewCache', function () use ($config) {

    // Cache data for one hour by default
    $frontCache = new OutputFrontend([
      "lifetime" => $config->application->cacheViewsTimeout
    ]);

    // Redis connection settings
    $cache = new BackendRedis(
        $frontCache,
        [
          "host" => $config->redis->host,
          "port" => $config->redis->port
        ]
    );

    return $cache;
});
