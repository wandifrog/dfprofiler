<style>
  @keyframes location {
    0% {
      background-color: #adff2f;
    }
    100% {
      background-color: #008000;
    }
  }

  .coord.x{{ posx }}.y{{ posy }} {
    animation: location 1s infinite;
    border: 2px solid #adff2f;
    opacity: 1 !important;
  }
</style>

<div class="table-responsive">
  <table id="profiler-gps-container">
    <tr>
      <td>
        {{ image('images/gps-y.png') }}
      </td>
      <td>
        <table>
          <tr>
            <td>{{ image('images/coords-num.png') }}</td><td></td>
          </tr>
          <tr>
            <td>
              <table class="gps-table">
                {% for y in 981..1019 %}
                  <tr>
                    {% for x in 1000..1058 %}
                    <td class="coord x{{ x }} y{{ y }}" title="x:{{ x }} y:{{ y }}">
                      {% if x == 1029 and y == 1003 %}
                        <a href="javascript:void(0);" data-toggle="popover" data-container="body" data-placement="auto left" data-content="<img src='/images/fort_pastor.jpg'>" data-title="Fort Pastor">
                          {{ image('images/map-placeholder.png') }}
                        </a>
                      {% elseif x == 1012 and y == 1019 %}
                        <a href="javascript:void(0);" data-toggle="popover" data-container="body" data-placement="auto top" data-content="<img src='/images/p13.jpg'>" data-title="Precint 13">
                          {{ image('images/map-placeholder.png') }}
                        </a>
                      {% elseif x == 1005 and y == 985 %}
                        <a href="javascript:void(0);" data-toggle="popover" data-container="body" data-placement="auto bottom" data-content="<img src='/images/doggs_stockade.jpg'>" data-title="Dogg's Stockade">
                          {{ image('images/map-placeholder.png') }}
                        </a>
                      {% elseif x == 1000 and y == 1000 %}
                        <a href="javascript:void(0);" data-toggle="popover" data-container="body" data-placement="auto right" data-content="<img src='/images/nastyas_holdout.jpg'>" data-title="Nastyas's Holdout">
                          {{ image('images/map-placeholder.png') }}
                        </a>
                      {% elseif x == 1054 and y == 987 %}
                        <a href="javascript:void(0);" data-toggle="popover" data-container="body" data-placement="auto left" data-content="<img src='/images/secronom_bunker.jpg'>" data-title="Secronom Bunker">
                          {{ image('images/map-placeholder.png') }}
                        </a>
                      {% elseif x == 1042 and y == 1010 %}
                        <a href="javascript:void(0);" data-toggle="popover" data-container="body" data-placement="auto top" data-content="<img src='/images/arena.jpg'>" data-title="PvP Arena">
                          {{ image('images/map-placeholder.png') }}
                        </a>
                      {% endif %}
                      </td>
                    {% endfor %}
                  </tr>
                {% endfor %}
              </table>
            </td>
            <td style="height: 664px">{{ image('images/coords-letters.png') }}</td>
          </tr>
          <tr>
            <td>{{ image('images/coords-num.png') }}</td><td></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        {{ image('images/yx.png') }}
      </td>
      <td>
        {{ image('images/gps-x.png') }}
      </td>
    </tr>
  </table>
</div>