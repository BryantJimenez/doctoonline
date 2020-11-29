@extends('layouts.web')

@section('title', 'Doctoonline')

@section('content')

@if(count($carousels)>0)
<section class="ftco-section py-0 mb-3" id="banner">
    <div class="main-banner">
        <div class="bg-white px-0">
            <div id="carousel" class="carousel slide" data-ride="carousel">
                @if(count($carousels)>1)
                <ol class="carousel-indicators">
                    @foreach($carousels as $carousel)
                    <li data-target="#carousel" data-slide-to="{{ $num++ }}" @if($loop->first) class="active" @endif></li>
                    @endforeach
                </ol>
                @endif
                <div class="carousel-inner">
                    @foreach($carousels as $carousel)
                    <div class="carousel-item @if($loop->first) active @endif">
                        <img src="{{ image_exist('/admins/img/banners/', $carousel->image) }}" class="w-100" alt="{{ $carousel->title }}">
                        <div class="card-img-overlay">
                            <div class="row">
                                @if(!is_null($carousel->title) || !is_null($carousel->text) || $carousel->button==1)
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 text-center text-lg-left px-4">
                                    @if(!is_null($carousel->title))
                                    <h1 class="text-uppercase text-white font-weight-bold pt-4"><img src="{{ asset('/web/img/logoblanco.png') }}" class="mr-3" alt="Logo"> {{ $carousel->title }}</h1>
                                    @endif
                                    @if(!is_null($carousel->text))
                                    <h4 class="text-white pt-4">{{ $carousel->text }}</h4>
                                    @endif
                                    @if($carousel->button==1)
                                    <div class="text-center pt-2 pt-md-5 mt-3">
                                        @empty($carousel->url)
                                        <a href="javascript:void(0);" class="btn btn-lg btn-orange text-uppercase text-white font-weight-bold rounded px-5"><i class="fa fa-angle-right mr-3"></i> {{ $carousel->button_text }}</a>
                                        @else
                                        <a href="{{ $carousel->pre_url.$carousel->url }}" @if($carousel->target==2) target="_blank" @endif class="btn btn-lg btn-orange text-uppercase text-white font-weight-bold rounded px-5"><i class="fa fa-angle-right mr-3"></i> {{ $carousel->button_text }}</a>
                                        @endempty
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if(count($carousels)>1)
                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if(count($services->where("featured", 1))>0)
<section class="ftco-section bg-white py-0 px-xl-4">
    <div class="row mx-0">
        @foreach($services->where("featured", 1) as $service)
        <div class="col-lg-4 col-md-6 col-12 card-services">
            <div class="card text-white border-0 rounded-0 overflow-hidden">
                <img src="{{ image_exist('/admins/img/services/', $service->image) }}" class="card-img zoom" alt="{{ $service->name }}">
                <div class="card-img-overlay p-0">
                    <span class="card-text bg-blue font-weight-bold text-white text-center text-uppercase position-absolute left-0 right-0 py-2 px-3">{{ $service->name }}</span>
                    {{-- @if($loop->index==2)
                    <span class="card-text bg-blue font-weight-bold text-white text-uppercase position-absolute py-2 px-3">{{ $service->name }}</span>
                    @else
                    <span class="card-text bg-blue font-weight-bold text-white text-uppercase position-absolute abosulute-left-unset right-0 py-2 px-3">{{ $service->name }}</span>
                    @endif --}}
                    
                    @if($loop->index==2 || $loop->index==1)
                    <div class="position-absolute abosulute-top-unset abosulute-left-unset right-0 bottom-0 p-0">
                        <a href="{{ route('services', ['slug' => $service->slug]) }}" class="btn btn-red font-weight-bold text-white rounded-0 px-4 mr-4 mb-3">Leer Más</a>
                    </div>
                    @else
                    <div class="position-absolute abosulute-top-unset bottom-0 p-0">
                        <a href="{{ route('services', ['slug' => $service->slug]) }}" class="btn btn-red font-weight-bold text-white rounded-0 px-4 ml-5 mb-3">Leer Más</a>
                    </div>
                    @endif
                </div>
            </div>
            @if(!is_null($service->line) && !empty($service->line))
            <div class="d-flex py-4">
                <img src="{{ image_exist('/admins/img/services/', $service->icon) }}" width="48" height="43" class="mr-3">
                <h3 class="text-blue font-weight-bold lh-28">{{ $service->line }}</h3>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</section>
@endif

@if(!is_null($banner))
<section class="ftco-section bg-white py-0" id="second-banner">
    <div class="secondary-banner" style="background-image: url('{{ image_exist('/admins/img/banners/', $banner->image) }}');">
        <div class="container">
            <div class="row">
                @if(!is_null($banner->title) || !is_null($banner->text) || $banner->button==1)
                <div class="offset-lg-6 offset-xl-6 col-xl-5 col-lg-5 col-12 text-center text-lg-left">
                    @if(!is_null($banner->title))
                    <h1 class="text-uppercase text-title-red font-weight-bold pt-4 pt-md-5">{{ $banner->title }}</h1>
                    @endif
                    @if(!is_null($banner->text))
                    <h5 class="h5 text-dark pt-2">{{ $banner->text }}</h5>
                    @endif
                    @if($banner->button==1)
                        @empty($banner->url)
                        <a href="javascript:void(0);" class="btn btn-orange text-uppercase text-white font-weight-bold rounded px-5 mt-4 mt-lg-5"><i class="fa fa-angle-right mr-3"></i> {{ $banner->button_text }}</a>
                        @else
                        <a href="{{ $banner->pre_url.$banner->url }}" @if($banner->target==2) target="_blank" @endif class="btn btn-orange text-uppercase text-white font-weight-bold rounded px-5 mt-4 mt-lg-5"><i class="fa fa-angle-right mr-3"></i> {{ $banner->button_text }}</a>
                        @endempty
                    @endif
                </div>
                @endif
            </div>
        </div>      
    </div>
</section>
@endif

<section class="ftco-section bg-white py-3">
    <div class="row justify-content-center mx-0">
        <div class="col-12 heading-section text-center">
            <img src="{{ asset('/web/img/novedades.png') }}" alt="Novedades" width="240" height="80">
        </div>
    </div>
</section>

<section class="ftco-section bg-white py-0 px-xl-4">
    <div class="row mx-0">
        @foreach($news as $new)
        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
            <div class="card card-news border-0">
                <div class="card-body p-0">
                    <h2 class="h5 card-title bg-blue text-dark py-3 px-2 px-lg-3 mb-0">{{ $new->title }}</h2>
                    <div class="overflow-hidden">
                        <img src="{{ image_exist('/admins/img/news/', $new->image, false, false) }}" class="w-100 zoom" alt="{{ $new->title }}">
                    </div>
                    <div class="text-right">
                        <a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}" class="btn btn-red font-weight-bold text-white rounded-0 px-4 mt-2 mb-4">Leer Más</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection