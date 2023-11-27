@extends('layouts.lumino');
@section('content')


<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">{{ __('Edit Article') }}</h1>
   </div>
</div>
<!--/.row-->
<div class="col-md-12">
   <div class="panel panel-default">
      <form action="{{ route('posts.update', encrypt_sha_for_url($Post->id)) }}" method="POST">
         {{ method_field('PUT') }}
         @csrf
         <div class="panel-body">
            <div class="form-group ">
               <label>{{ __('Title') }}</label>
               <input type="text" class="form-control form-control-lg" value="{{ $Post->title }}"  autocomplete="off" placeholder="{{ __('Title') }}" name="title" required>
            </div>
            <div class="form-group " style="padding-top:5px;">
               <label>{{ __('Content') }}</label>
               <textarea class="form-control summernote" rows="5" name="details">{!! $Post->details !!}</textarea>
            </div>
         </div>
         <div class="panel-footer text-right">
            <input type="submit" class="btn btn-success " value="{{ __('Save Article') }}">
         </div>
      </form>
   </div>
</div>




@endsection
@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">




	$(document).ready(function(){

		$( ".summernote" ).summernote({height:300});

	});

</script>


@endsection
@section('extracss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
