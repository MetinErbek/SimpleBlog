<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
@include('layouts.inc.lumino.head')
@yield('extracss', '');

</head>
<body>
  @include('layouts.inc.lumino.sidebar')
	@include('layouts.inc.lumino.menu')



	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    @yield('content', '')
	</div>	<!--/.main-->

  @include('layouts.inc.lumino.footerjs')
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


@yield('extrajs', '');
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
