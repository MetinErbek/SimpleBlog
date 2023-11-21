@extends('layouts.lumino');
@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{ __('Bakım Soruları') }}</h1>
			</div>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#addnewquestion" class="btn btn-sm btn-success">{{ __('Yeni Soru Ekle') }}</a>
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

                      <th>{{ __('Soru') }}</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($Questions as $question)
                    <tr>

											<td>{{ $question->question }}<br>
												<small style="font-size:12px;">

													<b>{{ __('Dil') }} : <img style="width:12px;" src="{{ asset('site/'.$question->language.'.png') }}"></b>
													<br>
													<b>{{ __('Soru Tipi') }} : {{ $question->question_type == 'classic' ? __('Açık Uçlu'):__('Çoktan Seçmeli') }}</b>

												</small>

											</td>
                      <td class="text-right">
                        <a class="btn btn-primary btn-sm btn-rounded editdetails" data-question_id="{{ encrypt_sha_for_url($question->id) }}"  href="javascript:void(0)" data-target="#editquestion" data-toggle="modal" ><i class="fa fa-edit"></i> <?php echo __('Edit');?></a>

                        <form method="POST" action="{{ route('questions.destroy', encrypt_sha_for_url($question->id)) }}" style="display: inline;">
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
							  @include('layouts.inc.lumino.pagination', ['Element'=> $Questions])
						</div>
					</div>
				</div><!-- /.panel-->


<div class="modal fade" id="addnewquestion" tabindex="-1" role="dialog" aria-labelledby="addnewquestion" aria-hidden="true">
  <div class="modal-dialog" role="document">
		<form action="{{ route('questions.store') }}" method="POST">
			@csrf
    	<div class="modal-content">
      <div class="modal-header">
        <span class="h4" id="exampleModalLongTitle">{{ __('Yeni Soru Ekle') }}</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
					<label>{{ __('Dil') }}</label>
					<select class="form-control" name="language" required>
						<option value="tr">Türkçe</option>
						<option value="en">English</option>
					</select>
				</div>
        <div class="form-group">
					<label>{{ __('Soru') }}</label>
					<input type="text" name="question" class="form-control" autocomplete="off" required>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="form-group"><input type="radio" name="question_type" value="classic" id="classic"> <label for="classic">Açık Uçlu</label></div>
					</div>
					<!--
					<div class="col-md-4">
						<div class="form-group"><input type="radio" name="question_type" value="multiple" id="multiple"><label for="multiple">Çoklu Seçim</label></div>
					</div>
					--->
					<div class="col-md-6 col-xs-6">
						<div class="form-group"><input type="radio" name="question_type" value="options" id="options"> <label for="options">Çoktan Seçmeli</label></div>
					</div>

				</div>
				<div id="answers" style="display:none;">
					<div class="container" style="margin-bottom:3px;"><b>{{ __('Seçenekler') }}</b></div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_1" placeholder="{{ __('Seçenek') }} 1" class="form-control sm_form_control"></div>
					</div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_2" placeholder="{{ __('Seçenek') }} 2" class="form-control sm_form_control"></div>
					</div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_3" placeholder="{{ __('Seçenek') }} 3" class="form-control sm_form_control"></div>
					</div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_4" placeholder="{{ __('Seçenek') }} 4" class="form-control sm_form_control"></div>
					</div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_5" placeholder="{{ __('Seçenek') }} 5" class="form-control sm_form_control"></div>
					</div>

					<!--
					<div class="row">
						<div class="col-md-10"><input type="text" name="options[]" class="form-control"></div>
						<div class="col-md-2"><a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-times"></i></a></div>
					</div>

					<br>
					<a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('Yeni Seçenek Ekle') }}</a>
					--->
				</div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Kapat') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Yeni Soru Ekle') }}</button>
      </div>
    </div>
		</form>
	</div>
</div>

<div class="modal fade" id="editquestion" tabindex="-1" role="dialog" aria-labelledby="editquestion" aria-hidden="true">
  <div class="modal-dialog" role="document">
		<form action="" id="edit_question_form" method="POST">
			{{ method_field('PATCH') }}
			@csrf
    	<div class="modal-content">
      <div class="modal-header">
        <span class="h4" id="exampleModalLongTitle">{{ __('Soruyu Güncelle') }}</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

				<div class="form-group">
					<label>{{ __('Dil') }}</label>
					<select class="form-control" name="language" id="edit_language" required>
						<option value="tr">Türkçe</option>
						<option value="en">English</option>
					</select>
				</div>
				<div class="form-group">
					<label>{{ __('Soru') }}</label>
					<input type="text" name="question" id="edit_question" class="form-control" autocomplete="off" required>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="form-group"><input type="radio" name="edit_question_type" value="classic" id="edit_classic"> <label for="edit_classic">{{ __('Açık Uçlu') }}</label></div>
					</div>
					<!--
					<div class="col-md-4">
						<div class="form-group"><input type="radio" name="question_type" value="multiple" id="multiple"><label for="multiple">Çoklu Seçim</label></div>
					</div>
					--->
					<div class="col-md-6 col-xs-6">
						<div class="form-group"><input type="radio" name="edit_question_type" value="options" id="edit_options"> <label for="edit_options">{{ __('Çoktan Seçmeli') }}</label></div>
					</div>

				</div>
				<div id="edit_answers" style="display:none;">
					<div class="container" style="margin-bottom:3px;"><b>{{ __('Seçenekler') }}</b></div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_1" id="edit_opt_1" placeholder="{{ __('Seçenek') }} 1" class="form-control sm_form_control"></div>
					</div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_2" id="edit_opt_2" placeholder="{{ __('Seçenek') }} 2" class="form-control sm_form_control"></div>
					</div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_3" id="edit_opt_3" placeholder="{{ __('Seçenek') }} 3" class="form-control sm_form_control"></div>
					</div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_4" id="edit_opt_4" placeholder="{{ __('Seçenek') }} 4" class="form-control sm_form_control"></div>
					</div>
					<div class="row" style="margin-bottom:3px;">
						<div class="col-md-12"><input type="text" name="opt_5" id="edit_opt_5" placeholder="{{ __('Seçenek') }} 5" class="form-control sm_form_control"></div>
					</div>

					<!--
					<div class="row">
						<div class="col-md-10"><input type="text" name="options[]" class="form-control"></div>
						<div class="col-md-2"><a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-times"></i></a></div>
					</div>

					<br>
					<a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('Yeni Seçenek Ekle') }}</a>
					--->
				</div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Kapat') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Soruyu Güncelle') }}</button>
      </div>
    </div>
		</form>
	</div>
</div>


@endsection
@section('extrajs')
<script type="text/javascript">




	$(document).ready(function(){

		$('[name="question_type"]').on('click', function(){
				if($(this).val() === 'options')
				{
					$('#answers').show();
				} else {
					$('#answers').hide();
				}
		});
		$('[name="edit_question_type"]').on('click', function(){
				if($(this).val() === 'options')
				{
					$('#edit_answers').show();
				} else {
					$('#edit_answers').hide();
				}
		});

		$('.editdetails').each(function(){
			$(this).on('click', function(){
				let question_id = $(this).data('question_id');

				$.get(site+'/webservice/getquestiondetails/'+question_id, function(data){
					let $data = eval('('+data+')');
					if($data['status'])
					{
						let Question = $data['result']['Question'];


						$('#edit_question').val(Question['question']);
						$('#edit_language').val(Question['language']);
						if(Question['question_type'] === 'options')
						{
								$('#edit_answers').show();
								$('#edit_options').attr('checked', true);
								//$('#edit_answers').attr('checked', false);
						} else {
								$('#edit_answers').hide();
								$('#edit_classic').attr('checked', true);
								//$('#edit_options').attr('checked', false);
						}

						$('#edit_opt_1').val(Question['opt_1']);
						$('#edit_opt_2').val(Question['opt_2']);
						$('#edit_opt_3').val(Question['opt_3']);
						$('#edit_opt_4').val(Question['opt_4']);
						$('#edit_opt_5').val(Question['opt_5']);


						$('#edit_question_form').attr('action', site+'/'+$role+'/questions/'+question_id);
					}

				})

			});

		})

	});

</script>


@endsection
