@extends('layouts.lumino');
@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{ $User->name.' '.__('Profili') }}</h1>
			</div>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
				<form action="{{ route('users.update', encrypt_sha_for_url($User->id)) }}" method="POST">
					{{ method_field('PUT') }}
					@csrf
					<div class="panel-heading">{{ __('Kullanıcı Profili') }}</div>
					<div class="panel-body">

						<div class="form-group ">
							<label>{{ __('İsim Soyisim') }}</label>
							<input type="text" class="form-control form-control-lg" value="{{ $User->name }}" autocomplete="off" placeholder="{{ __('İsim Soyisim') }}" name="name" required>
						</div>
						<div class="form-group " style="padding-top:5px;">
							<label>{{ __('Email') }}</label>
							<input type="email" class="form-control form-control-lg" value="{{ $User->email }}"  autocomplete="off" placeholder="{{ __('Email') }}" name="email" required>
						</div>
						<div class="form-group " style="padding-top:5px;">
							<label>{{ __('Yeni Şifre') }} &nbsp;<small>( Şifreyi değiştirmeyecekseniz boş bırakınız )</small></label>
							<input type="password" class="form-control form-control-lg" autocomplete="off" placeholder="{{ __('Şifre') }}" name="new_password" >
						</div>

						<div class="form-group " style="padding-top:5px;">
							<label>{{ __('Akfit / Pasif') }}</label>
							<select class="form-control form-control-lg" name="user_verify_status">
								<option value="passive" {{ $User->user_verify_status == 'passive' ? 'selected':NULL }}>{{ __('Pasif') }}</option>
								<option value="active" {{ $User->user_verify_status == 'active' ? 'selected':NULL }}>{{ __('Aktif') }}</option>
							</select>

						</div>
						<div class="form-group " style="padding-top:5px;">
							<label>{{ __('Üyelik Bitiş Tarihi') }}</label>
							<input type="text" class="form-control form-control-lg datepicker" value="{{ $User->user_expire_date }}"  autocomplete="off" placeholder="{{ __('Üyelik Bitiş Tarihi') }}" name="user_expire_date">
						</div>

					</div>
					<div class="panel-footer text-right">
						<input type="submit" class="btn btn-success" value="{{ __('Kaydet') }}">

					</div>

				</form>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">{{ __('Satın Aldığı Paketler') }}</div>
					<div class="panel-body">

						<table class="table table-hovered">
							@foreach($User->userPackets as $packet)
							<tr>
								<td>{{ $packet->packet->packet_name }}
									<br>
									<small>{{ getFormattedDate($packet->packet->created_at) }}</small>
								</td>

								<td class="text-right"><a href="javascript:void(0)" onclick="alert('Gelecek')" class="btn btn-info">{{ __('Detaylar') }}</a></td>
							</tr>
							@endforeach
						</table>

					</div>
				</div>
			</div>



	 </div>





@endsection
@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">




	$(document).ready(function(){

		$( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

	});

</script>


@endsection
@section('extracss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
