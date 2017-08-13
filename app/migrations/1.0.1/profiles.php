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

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ProfilesMigration_101
 */
class ProfilesMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('profiles', array(
                'columns' => array(
                    new Column(
                        'id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        )
                    ),
                    new Column(
                        'player_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'id'
                        )
                    ),
                    new Column(
                        'username',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'player_id'
                        )
                    ),
                    new Column(
                        'profession',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'default' => "",
                            'size' => 32,
                            'after' => 'username'
                        )
                    ),
                    new Column(
                        'level',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'profession'
                        )
                    ),
                    new Column(
                        'exp_since_death',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => "0",
                            'unsigned' => true,
                            'size' => 11,
                            'after' => 'level'
                        )
                    ),
                    new Column(
                        'weekly_ts',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => "0",
                            'size' => 11,
                            'after' => 'exp_since_death'
                        )
                    ),
                    new Column(
                        'all_time_ts',
                        array(
                            'type' => Column::TYPE_BIGINTEGER,
                            'default' => "0",
                            'unsigned' => true,
                            'size' => 20,
                            'after' => 'weekly_ts'
                        )
                    ),
                    new Column(
                        'total_exp',
                        array(
                            'type' => Column::TYPE_BIGINTEGER,
                            'default' => "0",
                            'size' => 20,
                            'after' => 'all_time_ts'
                        )
                    ),
                    new Column(
                        'weekly_tpk',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => "0",
                            'size' => 11,
                            'after' => 'total_exp'
                        )
                    ),
                    new Column(
                        'all_time_tpk',
                        array(
                            'type' => Column::TYPE_BIGINTEGER,
                            'default' => "0",
                            'unsigned' => true,
                            'size' => 20,
                            'after' => 'weekly_tpk'
                        )
                    ),
                    new Column(
                        'outpost',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 128,
                            'after' => 'all_time_tpk'
                        )
                    ),
                    new Column(
                        'money',
                        array(
                            'type' => Column::TYPE_BIGINTEGER,
                            'default' => "0",
                            'unsigned' => true,
                            'size' => 20,
                            'after' => 'outpost'
                        )
                    ),
                    new Column(
                        'weapon1',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 128,
                            'after' => 'money'
                        )
                    ),
                    new Column(
                        'weapon2',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 128,
                            'after' => 'weapon1'
                        )
                    ),
                    new Column(
                        'weapon3',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 128,
                            'after' => 'weapon2'
                        )
                    ),
                    new Column(
                        'armor',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 255,
                            'after' => 'weapon3'
                        )
                    ),
                    new Column(
                        'gm',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => "0",
                            'size' => 1,
                            'after' => 'armor'
                        )
                    ),
                    new Column(
                        'gm_end',
                        array(
                            'type' => Column::TYPE_BIGINTEGER,
                            'default' => "0",
                            'size' => 20,
                            'after' => 'gm'
                        )
                    ),
                    new Column(
                        'clan_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => "0",
                            'unsigned' => true,
                            'size' => 10,
                            'after' => 'gm_end'
                        )
                    ),
                    new Column(
                        'clan_name',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 255,
                            'after' => 'clan_id'
                        )
                    ),
                    new Column(
                        'clan_rank',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 255,
                            'after' => 'clan_name'
                        )
                    ),
                    new Column(
                        'created_at',
                        array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "0000-00-00 00:00:00",
                            'size' => 1,
                            'after' => 'clan_rank'
                        )
                    ),
                    new Column(
                        'updated_at',
                        array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "0000-00-00 00:00:00",
                            'size' => 1,
                            'after' => 'created_at'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('id'), null),
                    new Index('UNIQUE', array('player_id'), null),
                    new Index('player_id', array('player_id'), null)
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '56309',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_unicode_ci'
                ),
            )
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
