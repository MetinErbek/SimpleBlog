@extends('layouts.lumino');
@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><span style="color:red">{{ $Car->car_name }}</span> {{ __('Bakımları') }}</h1>
			</div>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#addnewmaintenance" class="btn btn-sm btn-success">{{ __('Yeni Bakım Raporu Ekle') }}</a>
						&nbsp;<a href="{{ url($role.'/cars') }}"  class="btn btn-sm btn-primary">{{ __('Araçlar Listesi') }}</a>
					</div>
					<div class="panel-body">

						<div class="row col-md-12">
							<form action="" method="GET">
								<div class="col-md-3">
									<div class="form-group">
										<label>{{ __('Ara') }}</label>
										<input type="text" autocomplete="off" name="search_filter" class="form-control sm_form_control" value="{{ isset($_GET['search_filter']) ? $_GET['search_filter']:'' }}">
									</div>
								</div>
								<div class="col-md-3"  style="padding-top:25px;">
								<input type="submit" class="btn btn-primary sm_form_control form-control" value="{{ __('Ara') }}">
								</div>

							</form>
						</div>


						<div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr class="bg-primary">

                      <th>{{ __('Araç') }}</th>
											@if($role == 'admin')
                      <th>{{ __('Sahibi') }}</th>
											@endif
											<th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($Maintenances as $maintenance)
                    <tr>

											<td>{{ $maintenance->maintenance_date.__(' Tarihli Bakım') }}<br>
												<small>
													<b>{{ __('Araç') }}:</b> <i>{{ $maintenance->car->car_name }}</i>

												</small>

											</td>
											@if($role == 'admin')
											<td>{{ $maintenance->created_at }}</td>
											@endif
                      <td class="text-right">

												<a class="btn btn-primary btn-sm btn-rounded editdetails" data-maintenance_id="{{ encrypt_sha_for_url($maintenance->id) }}"  href="javascript:void(0)" data-target="#editcar" data-toggle="modal" ><i class="fa fa-edit"></i> <?php echo __('Edit');?></a>

                        <form method="POST" action="{{ route('maintenances.destroy', encrypt_sha_for_url($maintenance->id)) }}" style="display: inline;">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-danger btn-sm btn-rounded verified_submit" ><i class="fa fa-times"></i> <?php echo __('Remove');?></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
						  </div>
							  @include('layouts.inc.lumino.pagination', ['Element'=> $Maintenances])
						</div>
					</div>
				</div><!-- /.panel-->


<div class="modal fade" id="addnewmaintenance" tabindex="-1" role="dialog" aria-labelledby="addnewmaintenance" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
		<form action="{{ route('maintenances.store') }}" method="POST">
			<input type="hidden" name="maintenance_car_id" id="car_id" value="{{ encrypt_sha_for_url($Car->id) }}">
			@csrf
    	<div class="modal-content">
      <div class="modal-header">
        <span class="h4" id="exampleModalLongTitle">{{ __('Yeni Bakım Ekle') }}</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="form-group">
					<label>{{ __('Maintenance Date') }}</label>
					<!--<textarea class="form-control" rows="2"></textarea>-->
					<input type="text" name="maintenance_date" class="form-control datepicker" autocomplete="off" required>
				</div>
				@foreach($Questions as $question)

					@if($question->question_type == 'classic')
		        <div class="form-group">
							<label>{{ __($question->question) }}</label>
							<!--<textarea class="form-control" rows="2"></textarea>-->
							<input type="text" name="val_{{ $question->id }}" autocomplete="off" class="form-control">
						</div>
					@else
					<div class="form-group">
						<label>{{ __($question->question) }}</label>

					</div>
					<div class="row ml_3">
						@for($i = 1;$i< 6;$i++)
						<div class="five_in_row " style="">
							<div class="form-group"><input type="checkbox" name="val_{{ $question->id }}[]" value="{{ $question->{'opt_'.$i} }}" id="opt_{{ $i }}_{{ $question->id }}"> <label for="opt_{{ $i }}_{{ $question->id }}">{{ $question->{'opt_'.$i} }}</label></div>
						</div>
						@endfor
					</div>


					@endif
				@endforeach




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Kapat') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Yeni Rapor Ekle') }}</button>
      </div>
    </div>
		</form>
	</div>
</div>

<div class="modal fade" id="editcar" tabindex="-1" role="dialog" aria-labelledby="addnewpacket" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
		<form action="" id="edit_maintenance_form" method="POST">
			<input type="hidden" name="maintenance_car_id" id="car_id" value="{{ encrypt_sha_for_url($Car->id) }}">
			{{ method_field('PATCH') }}
			@csrf
    	<div class="modal-content">
      <div class="modal-header">
        <span class="h4" id="exampleModalLongTitle">{{ __('Raporu Düzenle') }}</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

				<div class="form-group">
					<label>{{ __('Maintenance Date') }}</label>
					<input type="text" name="maintenance_date" id="edit_maintenance_date" class="form-control datepicker" autocomplete="off" required>
				</div>

				@foreach($Questions as $question)

					@if($question->question_type == 'classic')
		        <div class="form-group">
							<label>{{ __($question->question) }}</label>
							<!--<textarea class="form-control" rows="2"></textarea>-->
							<input type="text" name="val_{{ $question->id }}" id="edit_val_{{ $question->id }}" autocomplete="off" class="form-control">
						</div>
					@else
					<div class="form-group">
						<label>{{ __($question->question) }}</label>

					</div>
					<div class="row ml_3">
						@for($i = 1;$i< 6;$i++)
						<div class="five_in_row " style="">
							<div class="form-group"><input type="checkbox" name="val_{{ $question->id }}[]" value="{{ $question->{'opt_'.$i} }}" id="opt_{{ $i }}_{{ $question->id }}"> <label for="opt_{{ $i }}_{{ $question->id }}">{{ $question->{'opt_'.$i} }}</label></div>
						</div>
						@endfor
					</div>


					@endif
				@endforeach


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Kapat') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Raporu Güncelle') }}</button>
      </div>
    </div>
		</form>
	</div>
</div>


@endsection
@section('extrajs')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">

$('.datepicker').each(function(){
	$(this).datepicker({'dateFormat':'dd-mm-yy'});
})




	$(document).ready(function(){

		$('.editdetails').each(function(){
			$(this).on('click', function(){



				let maintenance_id = $(this).data('maintenance_id')
				$.get(site+'/webservice/getmaintenancedetails/'+maintenance_id, function(data){
					let $data = eval('('+data+')');
					if($data['status'])
					{

						$('[type="checkbox"]').each(function(){
						    $(this).prop('checked', false)
						})

						let Maintenance = $data['result']['Maintenance'];
						let ALLAnswers = Object.entries(Maintenance['allAnswers']);
						$('#edit_maintenance_date').val(Maintenance['maintenance_date']);
						console.log(ALLAnswers.length)
					  for(var $i = 0;$i<(ALLAnswers.length);$i++)
						{
								let Answers = ALLAnswers[$i][1];
								console.log(Answers)
								if(Answers.length > 1)
								{
									for(var $j = 0;$j<(Answers.length);$j++)
									{
										 let PartAnswer = Answers[$j];
										 $('[value="'+PartAnswer['answer']+'"]').prop('checked', true);
									}
								} else {

									let Answer = Answers[0];
									if(Answer['question']['question_type'] === 'classic')
									{
											$('#edit_val_'+Answer['question_id']).val(Answer['answer']);
									} else {
										$('[value="'+Answer['answer']+'"]').prop('checked', true);
									}

								}
						}
						$('#edit_maintenance_form').attr('action', site+'/'+$role+'/maintenances/'+maintenance_id);
					}

				})

			});

		})

	});

</script>


@endsection
@section('extracss')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style type="text/css">
.five_in_row
{
		float:left ;
		width:20%;
}
.ml_3{margin-left:3px !important}
@media (max-width:801px) {
	.five_in_row
	{
			clear:both;width:100% !important;
	}

}

</style>
@endsection
