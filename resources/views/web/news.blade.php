@extends('layouts.web')

@section('title', 'Noticias')

@section('content')

<section class="ftco-section py-5" id="banner-news">
	<div class="row mx-0">
		<div class="col-md-12 text-center">
			<span class="h5 text-uppercase font-weight-bold text-white position-relative m-0"><img src="{{ asset('/web/img/logoblanco.png') }}" alt="Logo"> Noticias</span>
		</div>
	</div>
</section>

<section class="ftco-section bg-white pb-1 pt-2">
	<div class="row mx-0">
		<div class="col-12">
			<div class="card border-0 mb-2">
				<div class="card-body">
					<div class="row">
						<div class="col-12 mb-4">
							<p class="h5 text-blue-dark font-weight-bold">
								<span class="pr-3 py-3"><img src="{{ asset('/web/img/categorias.png') }}" class="mr-2" alt="categorias" width="35">Categorías:</span> 
								<a href="{{ route('news') }}" class="btn @if(is_null($selected)) btn-blue text-white active @else btn-blue text-blue-dark @endif text-uppercase font-weight-bold mr-3 mt-2">Todas</a>
								@foreach($categories as $category)
								@if(count($category->news)>0)
								<a href="{{ route('news', ['category' => $category->slug]) }}" class="btn @if(!is_null($selected) && $selected==$category->slug) btn-blue text-white active @else btn-blue text-blue-dark @endif text-uppercase font-weight-bold mr-3 mt-2">{{ $category->name }}</a>
								@endif
								@endforeach
							</p>
						</div>

						@forelse($news as $new)
						<div class="col-xl-4 col-lg-6 col-md-6 col-12">
							<div class="card card-news border-0">
								<div class="card-body p-0">
									<h2 class="h5 card-title bg-blue text-dark py-3 px-2 px-lg-3 mb-0">{{ $new->title }}</h2>
									<div class="overflow-hidden">
										<img src="{{ image_exist('/admins/img/news/', $new->image, false, false) }}" class="w-100 zoom" alt="{{ $new->title }}">
									</div>
									<div class="text-right">
										@if(is_null($search))
										<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}" class="btn btn-red font-weight-bold text-white rounded-0 px-4 mt-2 mb-4">Leer Más</a>
										@else
										<a href="{{ route('new', ['category' => $search['slug'], 'slug' => $new->slug]) }}" class="btn btn-red font-weight-bold text-white rounded-0 px-4 mt-2 mb-4">Leer Más</a>
										@endif
									</div>
								</div>
							</div>
						</div>
						@empty
						<div class="col-12">
							<p class="h3 text-center text-danger">No hay ninguna noticia</p>
						</div>
						@endforelse

						<div class="col-12">
							<nav class="mt-5">
								{{ $pagination->links() }}
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection