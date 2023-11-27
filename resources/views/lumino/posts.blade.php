@extends('layouts.lumino');
@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Blog Articles</h1>
			</div>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">

					<div class="panel-heading">
						<a href="{{ route('posts.create') }}" class="btn btn-sm btn-success">{{ __('Yeni Blog Yazısı Ekle') }}</a>
					</div>

					<div class="panel-body">

						<div class="row col-md-12">
							<form action="" method="GET">
								<div class="col-md-3">
									<div class="form-group">
										<label>{{ __('Search') }}</label>
										<input type="text" autocomplete="off" name="search_filter" class="form-control sm_form_control" value="{{ isset($_GET['search_filter']) ? $_GET['search_filter']:'' }}">
									</div>
								</div>
								<div class="col-md-3"  style="padding-top:25px;">
								<input type="submit" class="btn btn-primary sm_form_control form-control" value="{{ __('Search') }}">
								</div>

							</form>
						</div>


						<div class="col-md-12">
						  <div class="table-responsive">
							<table class="table table-striped table-bordered">
							  <thead>
								<tr class="bg-primary">

								  <th><input type="checkbox" name="" id="selectallcheckbox"></th>
								  <th>{{ __('Article') }}</th>
								  <th>{{ __('Publisher') }}</th>
								  <th>{{ __('Status') }}</th>
								  
								  <th></th>
								</tr>
							  </thead>
							  <tbody>
								@foreach($Posts as $post)
								<tr>
									<td style="width:15px;">
										<input type="checkbox" class="check_line_id" value="{{ encrypt_sha_for_url($post->id) }}"  name="check_line_ids[]">

									</td>
									<td>{{ $post->title }}</td>
									<td>{{ $post->user->name }}</td>
									<td>
										<span class="label label-{{ postStatus($post->status)['class'] }}">
											{{ postStatus($post->status)['name'] }}
										</span>
									</td>
									<td class="text-right">
										@if(Auth::user()->role_id == 1)
											@if($post->status == 'publish')
												<a class="btn btn-warning btn-sm btn-rounded"  href="{{ url('admin/poststatuschange/'.encrypt_sha_for_url($post->id).'/draft') }}">{{  __('UnPublish') }}</a>
											@else
												<a class="btn btn-success btn-sm btn-rounded"  href="{{ url('admin/poststatuschange/'.encrypt_sha_for_url($post->id).'/publish') }}">{{  __('Publish') }}</a>

											@endif
										@endif
										<a class="btn btn-primary btn-sm btn-rounded"  href="{{ route('posts.edit', encrypt_sha_for_url($post->id) ) }}"><i class="fa fa-edit"></i>{{  __('Edit') }}</a>
										
										@if(Auth::user()->role_id == 1)
										<form method="POST" action="{{ route('posts.destroy', encrypt_sha_for_url($post->id)) }}" style="display: inline;">
											{{ csrf_field() }}
											{{ method_field('delete') }}
											<button type="submit" class="btn btn-danger btn-sm btn-rounded verified_submit" ><i class="fa fa-times"></i> <?php echo __('Remove');?></button>
										</form>
										@endif
									</td>
								</tr>
								@endforeach
							  </tbody>
							</table>

							<div  id="selecteds_area" style="display:none;">
								<div class="checkeds_form" style="">				
									<select name="selected_sactions" class="form-control" id="selected_saction">
										<option value="" disabled selected>Seçilenleri</option>
										<option value="remove">Sil</option>
									</select>&nbsp;
									<button id="selected_action_btn" class="btn  btn-success">Uygula</button>
								</div><br>
							</div>

							</div>
							@include('layouts.inc.lumino.pagination', ['Element'=>$Posts])
						</div>
					</div>
				</div><!-- /.panel-->
			</div>
		</div>



@endsection
@section('extrajs')
<script type="text/javascript">

var checkeds = [];

function bulkPostRemove()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post(site+'/admin/bulkremovepost', { checkeds: checkeds }, function(data) {
		let $data = eval('('+data+')');
		if($data['status'])
		{
			
			window.location.reload();
		} else {
			alert($data['result']['message']);
		}

	});
}
	$(document).ready(function(){
		$('#selected_action_btn').on('click', function(){
			if($('#selected_saction').val() === 'remove')
			{
				bulkPostRemove()
			} 
		});


	});

</script>


@endsection
@section('extracss')

@endsection