		

			<div class="col-lg-6">
				<div class="panel panel-default">
				
					<div class="panel-heading" style="display:flex;justify-content: space-between;">
						<span>
							Toplamlar
						</span>
						<span class="">
							
							<a href="{{ url('admin/sellbotearncoins') }}" class="btn btn-sm btn-success">Kazananları Sat</a> &nbsp;
							<a href="javascript:void(0)" data-target="#addnewtask" data-toggle="modal" class="btn btn-sm btn-primary">EKle</a> &nbsp;

						</span>
          			</div>
					<div class="panel-body text-center">
						<table class="table table-bordered" style="font-size:20px">
							<tr>
								<td>Toplam Anlık Kazanç</td>
								<td><b>{{ $TotalEarn }}</b></td>
							</tr>
							
								<tr>
								<td>Elde Kazanan Coin</td>
								<td><b>{{ $liveCountEarn }}</b></td>
							</tr>								
							<tr>
								<td>Elde Kaybeden Coin</td>
								<td><b>{{ $liveCountLost }}</b></td>
							</tr>
							
							
							<tr>
								<td>Toplam Coin</td>
								<td><b>{{ $BotTasks->count() }}</b></td>
							</tr>								
							<tr>
								<td>Kazanan Coin</td>
								<td><b>{{ $countEarn }}</b></td>
							</tr>								
							<tr>
								<td>Kaybeden Coin</td>
								<td><b>{{ $countLost }}</b></td>
							</tr>	

						</table>
					</div>
				</div><!-- /.panel-->
			</div>
			
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Eldeki Coinler
         			 </div>
					<!--<div class="panel-body" style="overflow-y:scroll;max-height:600px;">-->
					<div class="panel-body">

						<div class="col-md-12">
							<table class="table table-bordered">

								@foreach($ActiveTasks as $task)
								<tr>
									<td >
									<b><a  style="font-size:16px" href="https://www.gate.io/tr/trade/{{ strtoupper($task['coin']) }}_USDT" target="_blank">{{ strtoupper($task['coin']) }}</a></b>
									<br>
									<b>Şuan:</b> {{ ($task['now']) }}<br>
									<b>Alış:</b> {{ ($task['buy']) }}<br>
									<b>Sat:</b> {{ ($task['sell']) }}<br>
									<b>Kayıplı Sat:</b> {{ ($task['direct_sell']) }}<br>
									<b>Earn:</b> {{ ($task['earn']) }}<br>
									<a href="{{ url('admin/sellonecoin/'.$task['coin']) }}" >Sat</a>
									</td>
									
								</tr>
								@endforeach
							</table>
						
						</div>

					</div>
				</div><!-- /.panel-->
			</div>

		