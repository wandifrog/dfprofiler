<nav class="navbar navbar-inverse yamm navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{ image("images/logo.png", "alt": "Dead Frontier Profiler", "class": "navbar-logo pull-left") }}
      {{ link_to('', 'Profiler', 'class': 'navbar-brand') }}
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Player Records <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <div class="yamm-content">
                <div class="row overview">
                  <div class="col-sm-12">
                    {{ link_to('player', 'Overview') }}
                  </div>
                </div>
                <div class="row">
                  <ul class="col-sm-4 list-unstyled">
                    <li class="menu-header">Top Survivor</li>
                    <li>{{ link_to('player/weekly-ts', 'Weekly TS') }}</li>
                    <li>{{ link_to('player/all-time-ts', 'All Time TS') }}</li>
                  </ul>
                  <ul class="col-sm-4 list-unstyled">
                    <li class="menu-header">Top Player Killer</li>
                    <li>{{ link_to('player/weekly-tpk', 'Weekly TPK') }}</li>
                    <li>{{ link_to('player/all-time-tpk', 'All Time TPK') }}</li>
                  </ul>
                  <ul class="col-sm-4 list-unstyled">
                    <li class="menu-header">Other Records</li>
                    <li>{{ link_to('player/top-strongest', 'Top Strongest') }}</li>
                    <li>{{ link_to('player/top-richest', 'Top Richest') }}</li>
                    <li>{{ link_to('player/top-hardcore', 'Top Hardcore') }}</li>
                    <li>{{ link_to('player/level-325', 'Level 325') }}</li>
                    <li>{{ link_to('player/dusk-winners', 'Dusk Winners') }}</li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users"></i> Clan Records <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <div class="yamm-content">
                <div class="row overview">
                  <div class="col-sm-12">
                    {{ link_to('clan', 'Overview') }}
                  </div>
                </div>
                <div class="row">
                  <ul class="col-sm-4 list-unstyled">
                    <li class="menu-header">Top Survivor</li>
                    <li>{{ link_to('clan/weekly-ts', 'Weekly TS') }}</li>
                    <li>{{ link_to('clan/all-time-ts', 'All Time TS') }}</li>
                  </ul>
                  <ul class="col-sm-4 list-unstyled">
                    <li class="menu-header">Top Player Killer</li>
                    <li>{{ link_to('clan/weekly-tpk', 'Weekly TPK') }}</li>
                    <li>{{ link_to('clan/all-time-tpk', 'All Time TPK') }}</li>
                  </ul>
                  <ul class="col-sm-4 list-unstyled">
                    <li class="menu-header">Other Records</li>
                    <li>{{ link_to('clan/top-strongest', 'Top Strongest') }}</li>
                    <li>{{ link_to('clan/top-richest', 'Top Richest') }}</li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>
        </li>
        <li>{{ link_to('damage', '<i class="fa fa-crosshairs"></i> Damage Table') }}</li>
        <li>{{ link_to('statistics', '<i class="fa fa-pie-chart"></i> Statistics</a>') }}</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>{{ link_to('donate', 'Donate') }}</li>
        <li>{{ link_to('help', '<i class="fa fa-info-circle"></i>') }}</li>
        <li><a href="http://www.facebook.com/yourfbpage" target="_blank"><i class="fa fa-facebook-official"></i></a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
