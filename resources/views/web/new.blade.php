@extends('layouts.web')

@section('title', $new->title)

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/jssocials/jssocials.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/jssocials/jssocials-theme-flat.css') }}">
@endsection

@section('content')

<section class="ftco-section py-5" id="banner-news">
	<div class="row mx-0">
		<div class="col-md-12 text-center">
			<span class="h5 text-uppercase font-weight-bold text-white position-relative m-0"><img src="{{ asset('/web/img/logoblanco.png') }}" alt="Logo"> {{ $new->categories[0]->name }}</span>
		</div>
	</div>
</section>

<section class="ftco-section bg-white pb-1 pt-2">
	<div class="row mx-0">
		<div class="col-12 pl-300">
			<p><a href="{{ route('home') }}" class="text-blue">Home</a> <i class="fa fa-angle-right"></i> <a href="{{ route('news') }}" class="text-blue">Noticias</a> <i class="fa fa-angle-right"></i> <a href="{{ route('news', ['category' => $new->categories[0]->slug]) }}" class="text-blue">{{ $new->categories[0]->name }}</a> <i class="fa fa-angle-right"></i> {{ $new->title }}</p>
		</div>

		<div class="col-xl-9 col-lg-8 col-12 pl-300">
			<div class="card shadow mb-2">
				<div class="card-body">
					<h5 class="card-title text-blue font-arial notice-title">{{ $new->title }}</h5>

					<div class="d-md-flex justify-content-md-between font-arial notice-social">
						<p class="w-sm-100 pt-2"><i class="fa fa-calendar"></i> Publicado el {{ $new->created_at->format('d/m/Y') }}</p>

						<div class="w-sm-100 d-flex">
							<p class="text-md-right py-2 pr-2">Compartir esta Noticia:</p>
							<div id="social"></div>
						</div>
					</div>

					<img src="{{ image_exist('/admins/img/news/', $new->image) }}" class="w-100 mb-2" alt="{{ $new->title }}">

					<p class="card-text font-arial notice-content">{!! $new->content !!}</p>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-4 col-12">
			@if(count($related_news)>0)
			<p class="h5 font-weight-bold border-bottom">También te puede interesar</p>

			@foreach($related_news as $new)
			<div class="card border-0 mt-3 mb-2">
				<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}">
					<img src="{{ image_exist('/admins/img/news/', $new->image, false, false) }}" class="card-img-top rounded-0" alt="{{ $new->title }}">
				</a>
				<div class="card-body px-0 pt-2">
					<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}"><h5 class="card-title font-weight-bold">{{ $new->title }}</h5></a>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/jssocials/jssocials.js') }}"></script>
@endsection