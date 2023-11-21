@extends('layouts.lumino');
@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{ __('Ayarlar') }}</h1>
			</div>
		</div><!--/.row-->


		<div class="row">

			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Sınırlar
         			 </div>
					<div class="panel-body">
						<form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="col-md-12">
								<div class="form-group">
									<label>Kesin Alım İçin Satın Alma Fiyatı Yüzde</label>
									<input type="text" class="form-control" name="settings_to_buy" value="{{ isset($settings_to_buy) ? $settings_to_buy:0 }}">
								</div>
								<div class="form-group">
									<label>Kesin Alım İçin Satma Fiyatı Yüzde</label>
									<input type="text" class="form-control" name="settings_from_sell" value="{{ isset($settings_from_sell) ? $settings_from_sell:0 }}">
								</div>
								<div class="form-group">
									<label>Min Kazanç Yüzde</label>
									<input type="text" class="form-control" name="settings_min_earn" value="{{ isset($settings_min_earn) ? $settings_min_earn:0 }}">
								</div>
								<button type="submit" style="width:100%;" class="btn btn-success btn-lg">{{ __('Kaydet') }}</button>
							
							</div>
						</form>
					</div>
				</div><!-- /.panel-->
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Hesapla
         			 </div>
					<div class="panel-body">
						<form action="#" method="post" enctype="multipart/form-data">
							@csrf
							<div class="col-md-12">
								
								<div class="form-group">
									<label>Alım Fiyatını Girin</label>
									<input type="text" class="form-control" name="buying_price" id="buying_price">
								</div>
								<br>
								<div id="sell_price"></div>
							
							</div>
						</form>
					</div>
				</div><!-- /.panel-->
			</div>

		</div>




@endsection
@section('extrajs')
<script type="text/javascript">
	var buy_times = parseFloat({{ $settings_to_buy }});
	var sell_times = parseFloat({{ $settings_from_sell }});
	var min_earn_times = parseFloat({{ $settings_min_earn }});
	function round(value, precision = 0) {
	let factor = Math.pow(10, precision);
	return Math.round(value * factor) / factor;
	}
	$(document).ready(function(){
		$('#buying_price').on('keyup', function(){
			let val = parseFloat($(this).val());
			let sell_price  = 0;
			let buy_side = (val*buy_times/100);
			let sell_side = (val*sell_times/100);
			let earn_side = (val*min_earn_times/100);
			sell_price = parseFloat(val+buy_side+sell_side+earn_side);
			$('#sell_price').html('<b>Min Satış Fiyatı : </b> '+ round(sell_price,7)+'<br><br>Min Adet :'+round((1/val)),1);

		})
	});

</script>
@endsection