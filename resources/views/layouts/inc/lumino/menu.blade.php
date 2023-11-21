<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
  <div class="profile-sidebar">
    <div class="profile-userpic">
      <img src="http://via.placeholder.com/50x50" class="img-responsive" alt="">
    </div>
    <div class="profile-usertitle">
      <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
      <div class="profile-usertitle-status"><span class="indicator label-success"></span>{{ $role }}</div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="divider"></div>

  <ul class="nav menu">

    @if(Auth::user()->user_role == 1)
      <li class="{{ link_active('control', 'active') }} {{ link_active('index', 'active') }} {{ link_active('', 'active') }} "><a href="{{ url($role.'/control') }}"><em class="fa fa-car">&nbsp;</em> {{ __('Kontrol') }}</a></li>
      <li class="{{ link_active('bot', 'active') }} {{ link_active('bot', 'active') }} {{ link_active('bot', 'active') }} "><a href="{{ url($role.'/bot') }}"><em class="fa fa-eye">&nbsp;</em> {{ __('Bot') }}</a></li>
      
	  <li class="{{ link_active('settings', 'active') }} {{ link_active('settings', 'active') }}"><a href="{{ url($role.'/settings') }}"><em class="fa fa-dashboard">&nbsp;</em> {{ __('Ayarlar') }}</a></li>
      <li class="{{ link_active('users', 'active') }} {{ link_active('users', 'active') }}"><a href="{{ url($role.'/users') }}"><em class="fa fa-dashboard">&nbsp;</em> {{ __('Üyeler') }}</a></li>
      
      

    @else

      <li class="{{ link_active('index', 'active') }} {{ link_active('cars', 'active') }} {{ link_active('cars', 'active') }}"><a href="{{ url($role.'/cars') }}"><em class="fa fa-car">&nbsp;</em> {{ __('Araçlar') }}</a></li>


    @endif
    <!--
    <li class="{{ link_active('admin/items', 'active') }}"><a href="{{ url($role.'/items') }}"><em class="fa fa-calendar">&nbsp;</em> Oyuncular</a></li>
    <li class="{{ link_active('admin/news', 'active') }}"><a href="{{ url($role.'/news') }}"><em class="fa fa-calendar">&nbsp;</em> Haberler</a></li>
    <li class="{{ link_active('admin/sliders', 'active') }}"><a href="{{ url($role.'/sliders') }}"><em class="fa fa-calendar">&nbsp;</em> Sliderlar</a></li>


      ---->


    <li><a href="{{ url('logout') }}"><em class="fa fa-power-off">&nbsp;</em> {{ __('Çıkış') }}</a></li>
  </ul>
</div><!--/.sidebar-->
