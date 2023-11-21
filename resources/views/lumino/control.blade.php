@extends('layouts.lumino');
@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{ __('Kontrol') }} 
					<a href="javascript:void(0)" id="refreshbtn" class="btn btn-sm btn-small btn-success">Yenile</a> &nbsp;&nbsp;
					<a href="{{ url('admin/bot') }}" class="btn btn-sm btn-small btn-primary">Bot</a>
				
				</h1>
			
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6" >
				<div class="panel panel-default">
					<div class="panel-heading">
						Toplamlar
          			</div>
					<div class="panel-body">
					
						<div class="col-md-12 text-center " id="totals_content" style="display:none;margin-top:20px;">
							<b>Toplam Varlık</b>
							<br>
							<b><h2 id="all_total_usdt"></h2></b>
							<br>
							<b>Eldeki USDT</b>
							<br>
							<b><h3 id="inourhandusdt"></h3></b>
							<!--
							<b>Sistemin Toplam Kazancı</b>
							<br>
							<b><h3 id="all_earn_total_usdt"></h3></b>
							<br>
							//-->
							<br>
							<small><a href="{{ url('resetall') }}">Sistem Kazancını Sıfırla</a></small>

						
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading" style="display:flex;justify-content: space-between;">
						<span>
							Son Durumlar
						</span>
						<span class="">
							
							<a href="javascript:void(0)" data-toggle="modal" data-target="#buy_new_coin" class="btn btn-sm btn-success buynewcoinbtn">Yeni Al</a>
							&nbsp;
							<a href="javascript:void(0)" data-toggle="modal" data-target="#sell_coin" class="btn btn-sm btn-warning sellcoinbtn">Sat</a>
														
														&nbsp;
							
						</span>
          			</div>
					<div class="panel-body" style="overflow-y:scroll;max-height:300px;">
						@csrf
						<div class="col-md-12">
							<div id="balances" style="display:none;">
								<table class="table table-striped table-bordered" >
									<thead>
										<tr class="info">
											<th>COIN</th>
											<th>MİKTAR</th>
										</tr>
										
									</thead>
									<tbody id="balances_table"></tbody>

								</table>

							</div>


							<!--
							<button type="submit" style="width:100%;" class="btn btn-success btn-lg">{{ __('Kaydet') }}</button>
							--->
						
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading" style="display:flex;justify-content: space-between;">
						<span>
							Emirler
						</span>
						<span class="">
													<a href="javascript:void(0)" data-toggle="modal" data-target="#should_cut_coin" class="btn btn-sm btn-primary ">Emir</a>

						</span>
          			</div>
					<div class="panel-body" id="">
						@csrf
						<div class="col-md-12">
							<div id="" >
							<div id="waiting_processes" style="display:none;">
								<table class="table table-striped table-bordered" >
									<thead>
										<tr class="info">
											<th>COIN</th>
											<th></th>
											
										</tr>
										
									</thead>
									<tbody id="waiting_orders"></tbody>

								</table>

							</div>

							</div>

							<!--
							<button type="submit" style="width:100%;" class="btn btn-success btn-lg">{{ __('Kaydet') }}</button>
							--->
						
						</div>
					</div>
				</div>
			</div>			
			
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading" style="display:flex;justify-content: space-between;">
						<span>
							Takip Edilenler
						</span>
						<span class="">
							<a href="javascript:void(0)" class="btn btn-success btn-sm btn-small" data-toggle="modal" data-target="#addnewfollow">Ekle</a>
						</span>
          			</div>
					<div class="panel-body" id="follows" style="display:none;">
						@csrf
						<div class="col-md-12">
							<div id="" >
								<table class="table table-striped table-bordered" >
									<thead>
										<tr class="info">
											<th>COIN</th>
											
											
											<th></th>
										</tr>
										
									</thead>
									<tbody id="price_follows">

									</tbody>

								</table>

							</div>

							<!--
							<button type="submit" style="width:100%;" class="btn btn-success btn-lg">{{ __('Kaydet') }}</button>
							--->
						
						</div>
					</div>
				</div>
			</div>
		</div>


<!-- Modal -->
<div class="modal fade" id="addnewfollow" tabindex="-1" aria-labelledby="addNewFollowModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewFollowModalLabel">Yeni Takip Ekle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST" action="{{ route('tasks.store') }}">
		@csrf
      <div class="modal-body">

          <div class="form-group">
            <label for="coinInput">Coin</label>
			<select id="add_coin_name" name="coin" class="form-control coins_list"></select>
          </div>
          <div class="form-group">
            <label for="buyInput">Alım Fiyatı</label>
            <input type="text" class="form-control" id="buyInput" name="buy" placeholder="Alım fiyatı" autocomplete="off" >
          </div>
          <div class="form-group">
            <label for="sellInput">Satım Fiyatı</label>
            <input type="text" class="form-control" id="sellInput" name="sell" placeholder="Satım fiyatı" autocomplete="off" >
          </div>
          <div class="form-group">
            <label for="qtyInput">Adet</label>
            <input type="text" class="form-control" id="qtyInput" name="qty" placeholder="Adet" autocomplete="off" >
          </div>
          <div class="form-group">
            <label for="edit_qty">Durum</label>
			<select class="form-control" name="task_status" id="task_status">
				<option value="stop">Durdur</option>
				<option value="passive">Pasif</option>
				<option value="active">Aktif</option>
			</select>
  		  </div>
		  <!--
          <div class="form-group">
            <label for="exactSellInput">Kesin Satış Fiyatı</label>
            <input type="text" class="form-control" id="exactSellInput" name="exact_sell" placeholder="Kesin satış fiyatı">
          </div>
		  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-primary">Oluştur</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<div class="modal fade" id="showcoinolddetails" tabindex="-1" aria-labelledby="addNewFollowModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST" action="{{ route('tasks.store') }}">
		@csrf
      <div class="modal-body" id="coinhistory">
	  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

      </div>
	  </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editfollow" tabindex="-1" aria-labelledby="editFollowModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editFollowModalLabel">Takip Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST" action="{{ url('tasks.store') }}" id="edit_form">
		@csrf
		{{ method_field('PATCH') }}
      <div class="modal-body">

          <div class="form-group">
            <label for="edit_coin">Coin</label>
			<select id="edit_coin" name="edit_coin" class="form-control coins_list"></select>
          </div>
          <div class="form-group">
            <label for="edit_buy">Alım Fiyatı</label>
            <input type="text" class="form-control" id="edit_buy" name="buy" placeholder="Alım fiyatı" autocomplete="off" >
          </div>
          <div class="form-group">
            <label for="edit_sell">Satım Fiyatı</label>
            <input type="text" class="form-control" id="edit_sell" name="sell" placeholder="Satım fiyatı" autocomplete="off" >
          </div>
          <div class="form-group">
            <label for="edit_qty">Adet</label>
            <input type="text" class="form-control" id="edit_qty" name="qty" placeholder="Adet" autocomplete="off" >
          </div>
          <div class="form-group">
            <label for="edit_qty">Durum</label>
			<select class="form-control" name="task_status" id="edit_task_status">
				<option value="stop">Durdur</option>
				<option value="passive">Pasif</option>
				<option value="active">Aktif</option>
			</select>
  		  </div>
		  <!--
          <div class="form-group">
            <label for="edit_exact_sell">Kesin Satış Fiyatı</label>
            <input type="text" class="form-control" id="edit_exact_sell" name="exact_sell" placeholder="Kesin satış fiyatı">
          </div>
		  -->
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>--->
		<input type="hidden" name="reset_or_not" id="reset_or_not">
        <button type="button" class="btn btn-primary edit_coin_submit" data-type="reset">Sıfırlayarak Düzenle</button>
        <button type="button" class="btn btn-success edit_coin_submit" data-type="wo_reset">Düzenle</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="buy_new_coin" tabindex="-1" aria-labelledby="buy_new_coin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editFollowModalLabel">Yeni Satın Al</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST" action="{{ route('buycoin') }}" id="buy_form">
		@csrf

      <div class="modal-body">

          <div class="form-group">
            <label for="buy_coin">Coin</label>
			<select  name="coin" class="form-control coins_list " id="buy_coins_select"></select>

		</div>
          <div class="form-group">
            <label for="buy">Alım Adedi <a href="" id=""></a></label>
            <input type="text" class="form-control" id="buy_coin_qty" autocomplete="off"  name="qty" value="0" placeholder="Alım Adedi">
          </div>
			<br>
		  <div id="estimated_buying_price"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-primary">Al</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sell_coin" tabindex="-1" aria-labelledby="buy_new_coin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editFollowModalLabel">Coin Sat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST" action="{{ route('sellcoin') }}" id="sell_form">
		@csrf

      <div class="modal-body">

          <div class="form-group">
            <label for="sell_coins_select">Coin</label>
			<select  name="coin" class="form-control coins_list " id="sell_coins_select"></select>

		</div>
          <div class="form-group">
            <label for="buy">Satım Adedi <a href="" id=""></a></label>
            <input type="text" class="form-control" id="sell_coin_qty" autocomplete="off"  name="qty" value="0" placeholder="Alım Adedi">
          </div>
			<br>
		  <div id="estimated_selling_price"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-primary">Sat</button>
      </div>
	  </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="should_cut_coin" tabindex="-1" aria-labelledby="buy_new_coin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editFollowModalLabel">Emir Oluştur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST" id="createcommandform" action="{{ url('createcommand') }}" id="">
		@csrf

      <div class="modal-body">

          <div class="form-group">
            <label for="sell_coins_select">Coin</label>
			<select  name="coin" class="form-control coins_list " id="sell_coins_select"></select>

			</div>          
			
			<div class="form-group">
				<label for="sell_coins_select">Al/Sat</label>
				<select  name="buy_or_sell" class="form-control  " id="">
					<option value="sell">Sat</option>
					<option value="buy">Al</option>
				</select>

			</div>
          <div class="form-group">
            <label for="buy">Dolar Karşılığı<a href="" id=""></a></label>
            <input type="text" class="form-control" autocomplete="off"  name="dollar_qty" value="0" placeholder="Dolar Karşılığı">
          </div>
		  
          <div class="form-group">
            <label for="buy">Hedef Fiyat<a href="" id=""></a></label>
            <input type="text" class="form-control" autocomplete="off"  name="target_price" value="0" placeholder="Hedef Fiyat">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-primary">Oluştur</button>
      </div>
	  </form>
    </div>
  </div>
</div>

@endsection
@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script type="text/javascript">
			var buy_times = {{ $settings_to_buy }};
			var sell_times = {{ $settings_from_sell }};
			var min_earn_times = {{ $settings_min_earn }};
			
			var gotPricesCoins = [];

			function addOrUpdateCoinPrice(coin, price) 
			{
				// Find the index of the existing object with the given 'coin'
				const index = gotPricesCoins.findIndex(obj => obj.coin === coin);

				if (index !== -1) {
					// If the 'coin' already exists, update the 'price'
					gotPricesCoins[index].price = price;
				} else {
					// If the 'coin' doesn't exist, add a new object
					gotPricesCoins.push({ coin, price });
				}
			}

			function getPriceByCoin(coin) 
			{
				// Find the object with the given 'coin'
				const coinObj = gotPricesCoins.find(obj => obj.coin === coin);

				if (coinObj) {
					// If the object exists, return the price
					return coinObj.price;
				} else {
					// If the object doesn't exist, return null or any default value you prefer
					return null;
				}
			}

			function round(value, precision = 0) {
				let roundedValue = Math.round(value * Math.pow(10, precision)) / Math.pow(10, precision);
				return roundedValue.toFixed(precision);
			}

			function editCalcEstimatedLevels()
			{
				let coin = $('#edit_coin').val();
				let qty = $('#edit_qty').val();
				getCurrentValueCoin(coin, 'edit_task', qty)
			}

			function addCalcEstimatedLevels()
			{
				$('#add_coin_name').on('change', function(){
					let coin = $(this).val();
					let currentVal = getPriceByCoin(coin.toUpperCase());
					if(currentVal !== null)
					{
							$('#buyInput').val(currentVal)
							let levels = minEarningLevels();
							$('#sellInput').val(levels.min_sell);
							$('#qtyInput').val(levels.min_qty);
					} else {
						getCurrentValueCoin(coin, 'add_task')
					}
					
				})

			}
			function minEarningLevels()
			{
				let val = parseFloat($('#buyInput').val());
				let sell_price  = 0;
				let buy_side = (val*buy_times/100);
				let sell_side = (val*sell_times/100);
				let earn_side = (val*min_earn_times/100);
				sell_price = parseFloat(val+buy_side+sell_side+earn_side);
				return {
					'min_sell':sell_price,
					'min_qty' : round((1/val),1)
				};
				///$('#sell_price').html('<b>Min Satış Fiyatı : </b> '+ round(sell_price,7)+'<br><br>Min Adet :'+round((1/val)),1);

			}
			var checking = 0;
			var ALLCoins = [];
			function getCurrentValueCoin(coin, type, qty) 
			{
			  axios.get(site + '/followcurrent/' + coin.toLowerCase())
				.then(function(response) {
				  var data = response.data;
				  var current = data.result.data.last;

				  if (type === 'new_buy') {
					$('#estimated_buying_price').html('<b>Fiyat:</b> &nbsp;' + round(current, 9) + '<br><br><b>Toplam Fiyat :</b> &nbsp;' + round(qty * current, 2));
				  } else if (type === 'new_sell') {
					$('#estimated_selling_price').html('<b>Fiyat:</b> &nbsp;' + round(current, 9) + '<br><br><b>Toplam Fiyat :</b> &nbsp;' + round(qty * current, 2));
				  } else if (type === 'add_task') {
					// İşlem yapılacaksa burada gerekli kodu ekleyin
				  }
				})
				.catch(function(error) {
				  console.error('Error fetching coin data:', error);
				});
			}


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


			function getCoinNames()
			{
				$('#buy_coin_qty').on('keyup', function(){
					let $qty = $(this).val();
					let $coin = $('#buy_coins_select').val();

					let currentVal = getPriceByCoin($coin.toUpperCase());
					if(currentVal !== null)
					{
						$('#estimated_buying_price').html('<b>Fiyat:</b> &nbsp;'+round(currentVal,9)+'<br><br><b>Toplam Fiyat :</b> &nbsp;'+round($qty*currentVal, 2))

					} else {

						getCurrentValueCoin($coin, 'new_buy', $qty)
					
					}



					
				})
				$('#sell_coin_qty').on('keyup', function(){
					let $qty = $(this).val();
					let $coin = $('#sell_coins_select').val();
					let currentVal = getPriceByCoin($coin.toUpperCase());
					if(currentVal !== null)
					{
						$('#estimated_selling_price').html('<b>Fiyat:</b> &nbsp;'+round(currentVal,7)+'<br><br><b>Toplam Fiyat :</b> &nbsp;'+round($qty*currentVal, 2))

						
					} else {
						getCurrentValueCoin($coin, 'new_sell', $qty)
					}
				})
				$('#buy_coins_select').on('change',function(){

					getCurrentValueCoin($('#buy_coin_qty').val(), 'new_buy', $('#buy_coins_select').val());
				
				});
				$('.buynewcoinbtn').on('click', function(){
					
					if(ALLCoins.length)
					{

					} else {

					}
				});
			}

			function getWaitingOrders() 
			{
			  axios.get(site + '/waitingorders')
				.then(function(response) {
				  var data = response.data;
				  if (data.status) {
					var inHand = data.result.data.available;

					$('#balances_table').html('');
					for (var k in inHand) {
					  if (inHand.hasOwnProperty(k)) {
						$('#balances_table').append('<tr><td><b>' + k + '</b></td><td>' + inHand[k] + '</td></tr>');
					  }
					}
					$('#balances').show();
				  }
				})
				.catch(function(error) {
				  console.error('Error fetching waiting orders:', error);
				});
			}
			
			var wentBringCurrents = 0;
			function getMyCurrents()
			{
				if(wentBringCurrents === 1){return true;}
				wentBringCurrents = 1;
				$.get(site+'/mybalances', function(d){
					let $data = eval('('+d+')');
					if($data['status'])
					{

						wentBringCurrents = 0;
						//let inHand = $data['result']['data']['available'];
						let inHand = $data['result']['totals']['availables'];
				
			
						$('#balances').show();

						$('#balances_table').html('');
						let mybalancestxt = '';
						$.each(inHand, function($k, $val){
							mybalancestxt = '<tr><td><b><a href="https://www.gate.io/tr/trade/'+$val['coin'].toUpperCase()+'_USDT" target="_blank">'+$val['coin']+'</a></b><br><small><i>Elimizde :</i>'+$val['usd_based']+'$ <br><i>Şuan Fiyat :</i>'+$val['current']+'<br><a href="javascript:void(0)" data-coin="'+$val['coin']+'" class="coindetails" style="font-size:10px;" data-target="#showcoinolddetails" data-toggle="modal">Alım Satımlar</a></small></td>'
							+'<td>'+($val['my_count']);
							if($val['coin'].toUpperCase() === 'USDT')
							{
								$('#inourhandusdt').html($val['usd_based']+'$');
							}
							if($k !== 'USDT')
							{
								mybalancestxt +=' <small>[ <a href="{{ url("sellfromcurrentall") }}/'+$val['coin'].toLowerCase()+'"  class="">Sat</a> ]</small>'
							}
							mybalancestxt +='</td></tr>';
							if($val['my_count'] !== 0 && $val['my_count'] !=='0')
							{
								$('#balances_table').append(mybalancestxt);
							}
							addOrUpdateCoinPrice($val['coin'].toUpperCase(), $val['current']);

						});


						let Waitings =  $data['result']['Waitings']['orders'];
						if(Waitings.length)
						{
							
							$('#waiting_orders').html('');
							let mywaitingtxt = '';

							$.each(Waitings, function($k, $val){
								mywaitingtxt = '<tr><td>'+($val.type === 'buy' ? 'Alış':'Satış')+'<br><b>'+$val.currencyPair.split("_")[0].toUpperCase()+'</b>'
								+'</b><small><br><b>Fiyat :</b>'+$val.rate
								+'<br><b>Adet :</b>'+$val.amount
								+'</small></td>'
								+'<td>';
								
								if($k !== 'USDT')
								{
									mywaitingtxt +=' <small><a class="btn btn-sm btn-danger" href="{{ url("cancelorder") }}/'+$val.orderNumber+'/'+$val.currencyPair+'"  class="">İptal</a> </small>'
								}
								mywaitingtxt +='</td></tr>';
								if($val !== 0 && $val !=='0')
								{
									$('#waiting_orders').append(mywaitingtxt);
								}
								

							});


							$('#waiting_processes').show();
						} else {
							$('#waiting_processes').hide();
						}


						$('#all_total_usdt').html($data['result']['totals']['total_balance_usdt_format']+' USDT');
						$('#all_earn_total_usdt').html($data['result']['totals']['total_earn_format']+' USDT');
						$('#balances').show();
						$('#totals_content').show();
						checkingMyCurrents = 0;
						coinDetails();
					}
				})
			}

			function getFollowCurrents() 
			{
			  axios.get(site + '/tasks')
				.then(function(response) {
				  var data = response.data;
				  if (data.status) {
					var Tasks = data.result.Tasks;
					var Prices;
					$('#price_follows').html('');
					Tasks.forEach(function(task) {
					  Prices = task.prices;
					  var taskStatus = task.status === 'waiting_down' ? 'Alış Bekliyor' : 'Satış Bekliyor';
					  var taskStatusLabel = task.task_status === 'active' ? 'Aktif' : 'Pasif';
					  $('#price_follows').append('<tr>' +
						'<td><b><a href="https://www.gate.io/tr/trade/' + task.coin.toUpperCase() + '_USDT" target="_blank">' + task.coin.toUpperCase() + '</a></b>' +
						'<br><small style="font-size:15px"><b>Şuan :</b> ' + Prices.last + '</small>' +
						'<br><small><b>Al :</b> ' + task.buy + '</small>' +
						'<br><small><b>Sat :</b> ' + task.sell + '</small>' +
						'<br><small><b>Cycle :</b> ' + task.cycle + '</small>' +
						'<br><small><b>İşlem :</b> ' + taskStatus + '</small>' +
						'<br><small><b>Durum :</b> ' + taskStatusLabel + '</small>' +
						'<br><small><b>Kazanç :</b> ' + task.earning + '</small>' +
						'<br><small><b>Son Alım :</b> ' + task.last_buy + '</small>' +
						'</td>' +
						'<td>' +
						'<a href="javascript:void(0)" data-task_id="' + task.id + '" class="edittaskcoin btn btn-primary btn-sm">Düzenle</a>' +
						'<br><br><a href="' + site + '/removetaskcoin/' + task.id + '" class="btn btn-danger btn-sm">Sil</a></td>' +
						'</tr>');
					});
					$('#follows').show();
					setEditTaskCoins();
					checkingFollowCurrents = 0;
					
				  }
				})
				.catch(function(error) {
				  console.error('Error fetching tasks:', error);
				});
			}

			function setEditTaskCoins() 
			{
			  $('.edittaskcoin').each(function() {
				$(this).on('click', function() {
				  var task_id = $(this).data('task_id');

				  axios.get(site + '/gettaskdetails/' + task_id)
					.then(function(response) {
					  var data = response.data;
					  if (data.status) {
						var Task = data.result.Task;
						Object.keys(Task).forEach(function(key) {
						  if ($('#edit_' + key).length) {
							$('#edit_' + key).val(Task[key].toUpperCase());
						  }
						});
						$('#edit_coin').selectpicker('refresh');
						$('#edit_form').attr('action', site + '/tasks/' + task_id);
						$('.edit_coin_submit').each(function() {
						  $(this).on('click', function() {
							var edit_type = $(this).data('type');
							$('#reset_or_not').val(edit_type);
							$('#edit_form').submit();
						  });
						});
						$('#editfollow').modal('show');
					  }
					})
					.catch(function(error) {
					  console.error('Error fetching task details:', error);
					});
				});
			  });
			}


			function refreshOurTasks()
			{
				//return 1;
				$.get(site+'/cron/check', function(){

				});
			}
			
			function coinDetails()
			{
				$('.coindetails').each(function(){
					$(this).on('click', function(){
						$('#coinhistory').html('');
						let coin = $(this).data('coin');
						$.get(site+'/history/'+coin, function(d){
							$('#coinhistory').html(d);
							
						});
					});

				})
			}
			
			
			var checkingMyCurrents = 0;
			var checkingFollowCurrents = 0;
			$(document).ready(function(){
				
				coinDetails();
				
				$('#createcommandform').on('submit', function(){
					
					$.post(site+'/createcommand',$('#createcommandform').serialize(), function(d){
						let $data = eval('('+d+')');
						if($data['status'])
						{
							$('#createcommandform')[0].reset();
							$('#should_cut_coin').modal('hide')
							Swal.fire($data['result']['message']);
							checkingMyCurrents = 0;
							checkingFollowCurrents = 0;
							getMyCurrents();

						}
					});
					return false;
				});
				
				$('#refreshbtn').on('click', function(){
					checkingMyCurrents = 0;
					checkingFollowCurrents = 0;
					getMyCurrents();
					getFollowCurrents();
				})
				getJustAllCoins();
				getCoinNames();
				addCalcEstimatedLevels()
				
				getMyCurrents();
				setInterval(() => {
					if(checkingMyCurrents === 0)
					{
						getMyCurrents();
						checkingMyCurrents = 1;
					}

				}, 1500);

				getFollowCurrents();
				setInterval(() => {
					if(checkingFollowCurrents === 0)
					{
						getFollowCurrents();
						refreshOurTasks();
						checkingFollowCurrents = 1;
					}
				}, 20000);

			});

		
	</script>

@endsection
@section('extracss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection