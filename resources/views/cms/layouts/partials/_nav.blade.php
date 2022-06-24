<div class="main-nav">
  <nav> 
    <!-- Menu Toggle btn-->
    <div class="menu-toggle">
      <h3>Menu</h3>
      <button type="button" id="menu-btn"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <!-- Responsive Menu Structure--> 
    <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
    <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
    <li><a href="{!! route('cms::dashboard') !!}" class="nav-link"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

      @foreach($modules as $module)
        @php
          $current = '';
          $menu = '';
          if(strpos(Route::currentRouteName(), $module->slug) !== false){
            $current = 'active';
            $menu = 'menu-is-opening menu-open';
          }
        @endphp
      
        <li class="nav-item {{ $menu }}"><a href="#" class="nav-link {{ $current }}"><i class="fa {!! $module->icon_class !!}"></i> <span>{!! $module->name !!}</span></a>
          @if($module->menus->count() > 0)
          <ul>
            @foreach($module->menus as $menu)
            @php
              $subCurrent = '';
              if(strpos(Route::currentRouteName(), $menu->slug) !== false){
                $subCurrent = 'active';
              }
            @endphp
            <li class="nav-item"><a class="nav-link {{ $subCurrent }}" href="{!! route($menu->slug) !!}"><i class="fa fa-circle nav-icon"></i> {!! $menu->menu_name !!}</a></li>
            @endforeach
          </ul>
          @endif
        </li>
      @endforeach

      <li>
      <a href="{!! route('cms::logout') !!}" class="nav-link"><i class="fa fa-power-off"></i> <span>Logout</span></a>
      </li>
    </ul>
  </nav>
</div>