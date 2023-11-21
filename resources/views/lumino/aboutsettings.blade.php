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
						<div class="col-md-12">

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
									<div class="form-group">
										<label>{{ __('Hakkımızda') }}</label>
										<textarea rows="7" name="settings_about_us" class="form-control summernote_editor_small">{{ isset($settings_about_us) ? $settings_about_us:NULL }}</textarea>
									</div>
								</div>
							  <div role="tabpanel" class="tab-pane fade in" id="ensite">
									<div class="form-group">
										<label>{{ __('Hakkımızda') }}[EN]</label>
										<textarea rows="7" name="settings_about_us_en" class="form-control summernote_editor_small">{{ isset($settings_about_us_en) ? $settings_about_us_en:NULL }}</textarea>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>{{ __('Logonuz') }}</label>
								<br><img src="{{ isset($settings_site_logo) ? asset($settings_site_logo):NULL }}" style="width:100px;height:100px;">
							</div>
							<div class="form-group">
								<label>{{ __('Yeni Logo') }}</label>
								<input type="file" name="input_settings_site_logo" class="form-control" >
							</div>
							<button type="submit" style="width:100%;" class="btn btn-success btn-lg">{{ __('Kaydet') }}</button>
						</div>
						</form>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.panel-->
		</div><!-- /.panel-->




@endsection
