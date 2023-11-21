<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog System</title>
	<link href="{{ asset('lumino/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('lumino/css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('lumino/css/styles.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.37/sweetalert2.min.css"
	integrity="sha512-r+ShOkTmhH/y+MOeQfVL1mW0dMcD/54nFOEmwn+gl4DCw9SAzWCqedtsefIy52x/amO1ZSsULwgDxU9BIdabqQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style type="text/css">

		@font-face {
				font-family: 'sofiapro';
				src: url("{{ asset('lumino/css/sofiapro-light.otf') }}") format("opentype");
				font-style: normal;
		}
	</style>

</head>
<body>


	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				
				<br style="clear:both">
				@if(isset($settings_site_logo))
				<div class="text-center" style="margin-top:5px;margin-bottom:5px;">
					<img src="{{ asset($settings_site_logo) }}">
				</div>
				@endif
				<div class="panel-body ">
	
					@yield('content', '')
	

				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
	

	<script src="{{ asset('lumino/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('lumino/js/bootstrap.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.37/sweetalert2.min.js"
	integrity="sha512-hMhiMG2V37nTipBqREV4+PdbKWnM3qXH9JPcD4s+YC9FStVfOMAyPvZ5tWx/SacBtHjTSsVvx7lg6CBUox1ZEA=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script type="text/javascript">
	    @if(isset( $errors ) && $errors->first())

	        Swal.fire(''
	                 @foreach ($errors->all() as $error)
	                +'	{{ $error }}<br>'
	                 @endforeach
	                +'');
	    @endif


	</script>



</body>
</html>
