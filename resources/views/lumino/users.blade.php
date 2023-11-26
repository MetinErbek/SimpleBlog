@extends('layouts.lumino')
@section('content') 
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">{{ __('Users') }}</h1>
  </div>
</div>
<!--/.row-->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row col-md-12">
          <form action="" method="GET">
            <div class="col-md-3">
              <div class="form-group">
                <label>{{ __('Search') }}</label>
                <input type="text" autocomplete="off" name="search_filter" class="form-control" value="{{ isset($_GET['search_filter']) ? $_GET['search_filter']:'' }}">
              </div>
            </div>
            <div class="col-md-3" style="padding-top:25px;">
              <input type="submit" class="btn btn-primary form-control" value="{{ __('Search') }}">
            </div>
          </form>
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr class="bg-primary">
                  <th>{{ __('Kullanıcı') }}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody> @foreach($Users as $user) <tr>
                  <td>{{ $user->name }}<br><small>{{ $user->email }}</small></td>
                  <td class="text-right">
                    <form method="POST" action="{{ route('users.destroy', ($user->id)) }}" style="display: inline;">
                      {{ csrf_field() }}
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-danger btn-sm btn-rounded verified_submit">
                        <i class="fa fa-times"></i> <?php echo __('Remove');?> </button>
                    </form>
                  </td>
                </tr> @endforeach </tbody>
            </table>
          </div> @include('layouts.inc.lumino.pagination', ['Element'=> $Users])
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.panel--> 
@endsection 
@section('extrajs') <script type="text/javascript">
	let site = "{{ url('/') }}";
	$(document).ready(function() {});
</script> 
@endsection