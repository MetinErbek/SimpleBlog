@extends('layouts.site')
@section('content')
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="post-heading">
					<h1>{{ $Post->title }}</h1>
					<span class="meta">
						Posted by
						{{ $Post->user->name }}
						on {{ date('m/d/Y H:i:s', strtotime($Post->created_at)) }}
					</span>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- Post Content-->
<article class="mb-4">
	<div class="container px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				{!! $Post->details !!}
			</div>
		</div>
	</div>
</article>
        
@endsection