@extends('layouts.lumino');
@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{ __('Hakkımızda Ayarlar') }}</h1>
			</div>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">

          </div>
					<div class="panel-body">
						<form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
							@csrf

							<ul class="nav nav-tabs" role="tablist">
							  <li class="nav-item active">
							    <a class="nav-link active" href="#trsite" role="tab" data-toggle="tab">Türkçe Site</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" href="#ensite" role="tab" data-toggle="tab">English Site</a>
							  </li>

							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
							  <div role="tabpanel" class="tab-pane fade in active" id="trsite">
										<div class="col-md-12">


											<div class="form-group">
												<label>{{ __('Gizlilik') }}</label>
												<textarea rows="7" name="settings_privacy_policy" class="form-control summernote_editor_small">{{ isset($settings_privacy_policy) ? $settings_privacy_policy:NULL }}</textarea>
											</div>
											<div class="form-group">
												<label>{{ __('Veri Güvenliği') }}</label>
												<textarea rows="7" name="settings_data_security" class="form-control summernote_editor_small">{{ isset($settings_data_security) ? $settings_data_security:NULL }}</textarea>
											</div>
											<div class="form-group">
												<label>{{ __('Kullanıcı Sözleşmesi') }}</label>
												<textarea rows="7" name="settings_user_policy" class="form-control summernote_editor_small">{{ isset($settings_user_policy) ? $settings_user_policy:NULL }}</textarea>
											</div>


											<button type="submit" style="width:100%;" class="btn btn-success btn-lg">{{ __('Kaydet') }}</button>
										</div>
								</div>
							  <div role="tabpanel" class="tab-pane fade" id="ensite">

										<div class="col-md-12">


										<div class="form-group">
											<label>{{ __('Gizlilik') }}[ EN ]</label>
											<textarea rows="7" name="settings_privacy_policy_en" class="form-control summernote_editor_small">{{ isset($settings_privacy_policy_en) ? $settings_privacy_policy_en:NULL }}</textarea>
										</div>
										<div class="form-group">
											<label>{{ __('Veri Güvenliği') }}[ EN ]</label>
											<textarea rows="7" name="settings_data_security_en" class="form-control summernote_editor_small">{{ isset($settings_data_security_en) ? $settings_data_security_en:NULL }}</textarea>
										</div>
										<div class="form-group">
											<label>{{ __('Kullanıcı Sözleşmesi') }}[ EN ]</label>
											<textarea rows="7" name="settings_user_policy_en" class="form-control summernote_editor_small">{{ isset($settings_user_policy_en) ? $settings_user_policy_en:NULL }}</textarea>
										</div>


										<button type="submit" style="width:100%;" class="btn btn-success btn-lg">{{ __('Kaydet') }}</button>
									</div>



								</div>
							</div>


						</form>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.panel-->
		</div><!-- /.panel-->




@endsection
