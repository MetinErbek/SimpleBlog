@extends('layouts.site')
@section('content')
<!-- Page Header-->
<header class="masthead" style="background-image: url('{{ asset('assets/img/home-bg.jpg') }}')">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="site-heading">
					<h1>Blog</h1>
					<span class="subheading">All Blog Articles</span>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
	<div class="row gx-4 gx-lg-5 justify-content-center">
		<div class="col-md-10 col-lg-8 col-xl-7">
			@foreach($Posts as $Post)
			<!-- Post preview-->
			<div class="post-preview">
				<a href="{{ url('post/'.$Post->slug) }}">
					<h2 class="post-title">{{ $Post->title }}</h2>
					<h3 class="post-subtitle">{{ substr($Post->details, 0, 50) }}</h3>
				</a>
				<p class="post-meta">
					Posted by
					{{ $Post->user->name }}
					on {{ date('m/d/Y H:i:s', strtotime($Post->created_at)) }}
				</p>
			</div>
			<!-- Divider-->
			<hr class="my-4" />
			@endforeach

		</div>
	</div>
</div>
        
@endsection