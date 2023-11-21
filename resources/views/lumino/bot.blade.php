@extends('layouts.lumino');
@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{ __('Bot') }} <a href="javascript:void(0)" id="refreshbtn" class="btn btn-sm btn-small btn-success">Yenile</a></h1>
			</div>
		</div><!--/.row-->

		<div class="row" id="botdetailsrow">
			@include('lumino.botdetails')
		</div>
		
		
		<div class="row">

			
			
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Ayarlar
         			 </div>
					<div class="panel-body">
						<form action="{{ url('admin/savebotsettings') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="col-md-12">
								<table class="table table-bordered">
								@foreach($BotSettings as $setting)
								<tr>
									<td>{{ $setting->settings_desc }}</td>
									<td><input type="text" class="form-control" name="{{ $setting->setting }}" value="{{ $setting->value }}"></td>
								</tr>
								@endforeach
								</table>
							<br>
							<input type="submit" class="btn btn-success" value="Kaydet">
							
							</div>

						</form>
					</div>
				</div><!-- /.panel-->
			</div>

			<div class="col-lg-6">

			</div>
		</div>


<div class="modal fade" id="addnewtask" tabindex="-1" aria-labelledby="addNewFollowModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewFollowModalLabel">Yeni Ekle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST" action="{{ url('newcoinaddtobot') }}">
		@csrf
      <div class="modal-body">

          <div class="form-group">
            <label for="coinInput">Coin</label>
			<select id="add_coin_name" name="coin" class="form-control coins_list"></select>
          </div>
          <div class="form-group">
            <label for="qtyInput">Miktar ( USD )</label>
            <input type="text" class="form-control" id="qtyInput" name="qty" placeholder="Miktar" autocomplete="off" >
          </div>               
		  <div class="form-group">
            <label for="qtyInput">Karlı Sat ( % )</label>
            <input type="text" class="form-control" id="qtyInput" value="{{ $coinEarnLimit }}" name="sell_percent" placeholder="Karlı Sat ( % )" autocomplete="off" >
          </div>      		  
		  <div class="form-group">
            <label for="qtyInput">Zararda Direkt Sat ( % )</label>
            <input type="text" class="form-control" id="qtyInput" value="{{ $coinDirectSellLimit }}" name="direct_sell_percent" placeholder="Zararda Direkt Sat ( % )" autocomplete="off" >
          </div>          


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-primary">Ekle</button>
      </div>
	  </form>
    </div>
  </div>
</div>

@endsection
@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">

			function getJustAllCoins()
			{
				$.get(site+'/getcoinnames', function(d){
							let $data = eval('('+d+')');
							if($data['status'])
							{

								let inHand = $data['result']['data'];
								ALLCoins = inHand;
								$('.coins_list').each(function(){
									let coininpt = $(this);
									$(coininpt).html('');
									$(coininpt).append('<option value="">-- Seçiniz --</option>');

									$.each(inHand, function($k, $val){
										$(coininpt).append('<option value="'+$val+'">'+$val+'</option>')
									});
									$(coininpt).selectpicker({
										liveSearch: true
									});
								})
							}
						});
			}

			function getBotDetails() 
			{
			  axios.get(site + '/getbotprocess')
				.then(function(response) {
				  var data = response.data;
				  $('#botdetailsrow').html(data);
				  checkingBotCurrents = 0;
				})
				.catch(function(error) {
				  console.error('Error fetching tasks:', error);
				});
			}


	function round(value, precision = 0) {
	let factor = Math.pow(10, precision);
	return Math.round(value * factor) / factor;
	}
	
	var checkingBotCurrents = 0;
	$(document).ready(function(){
		getJustAllCoins();
		
		$('#refreshbtn').on('click', function(){
			document.location.reload();
		});
		
		setInterval(() => {
			if(checkingBotCurrents === 0)
			{
				getBotDetails();
				checkingBotCurrents = 1;
			}

		}, 3000);
		
		

	});

</script>
@endsection
@section('extracss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection