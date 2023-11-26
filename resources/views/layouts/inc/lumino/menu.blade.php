<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
  <div class="profile-sidebar">
    <div class="profile-userpic">
      <img src="http://via.placeholder.com/50x50" class="img-responsive" alt="">
    </div>
    <div class="profile-usertitle">
      <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="divider"></div>

  <ul class="nav menu">

    @if(Auth::user()->role_id == 1)
      <li class="{{ link_active('', 'active') }} {{ link_active('index', 'active') }} {{ link_active('', 'active') }} "><a href="{{ url('admin/index') }}"><em class="fa fa-dashboard">&nbsp;</em> {{ __('Blog Articles') }}</a></li>

      <li class="{{ link_active('users', 'active') }} {{ link_active('users', 'active') }}"><a href="{{ url('admin/users') }}"><em class="fa fa-dashboard">&nbsp;</em> {{ __('Users') }}</a></li>
      
      

    @else

      <li class="{{ link_active('', 'active') }} {{ link_active('index', 'active') }} {{ link_active('', 'active') }} "><a href="{{ url('admin/index') }}"><em class="fa fa-dashboard">&nbsp;</em> {{ __('Blog Articles') }}</a></li>


    @endif



    <li><a href="{{ url('logout') }}"><em class="fa fa-power-off">&nbsp;</em> {{ __('Log Out') }}</a></li>
  </ul>
</div><!--/.sidebar-->
