@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      $entry->full_name => false //TODO: refactor breadcrumbs comment
    ];

    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
    $estate = $entry;

    $images = $estate->estateDocuments;


@endphp

@section('after_styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            important: true,
        }
    </script>
    <link rel="stylesheet" href="{{ asset('assets/css/views.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="main-container">
            <section class="main-container__main b-shadow">
                <div class="row">
                    <div class="col-md-12">
                        {{ $estate->short_description }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 main-container__main--left slider-container">
                        <div class="swiper EstatesSlider">
                            <!-- Slider main container -->
                            <div class="swiper-wrapper">
                                @foreach($images as $image)
                                    <div class="swiper-slide">
                                        <div class="swiper-zoom-container">
                                        <img src="{{ Storage::disk('S3Public')->url('/estate/photos/'.$image->path) }}">
                                            </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next bg-light"></div>
                            <div class="swiper-button-prev bg-light"></div>
                        </div>

                        <div class="swiper SwiperThumbs">
                            <div class="swiper-wrapper">
                                @foreach($images as $image)
                                    <div class="swiper-slide mr-2">
                                        <img src="{{ Storage::disk('S3Public')->url('/estate/photos/'.$image->path_thumb) }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="main-container__main--info">
                            <h2 class="hospital-name">
                                {{  $estate->name_prefix ?? $estate->refer }}
                                {{  $estate->full_name }}
                                <span>ID: {{ $estate->id }}</span>
                            </h2>
                            <ul class="info-list">

                                <li>{{ $estate->location_province?->name_arm }}</li>
                            </ul>
                        </div>
                        <div class="main-container__main--actions-date">
                            Created: {{ $estate->created_at }}
                        </div>
                        <div class="main-container__main--status">
                            @can('expert.create')
                                Status: <span
                                    class="{{ $estate->published ? 'text-green' : 'text-orange' }}">{{ $estate->published ? 'Published' : 'Draft' }}</span>
                            @endcan
                        </div>
                        <div class="main-container__main--actions-wrapper">


                        </div>
                    </div>
                </div>
            </section> <!-- End main -->

            <section class="b-shadow block">
                <h2 class="block__title">User Information</h2>
                <div class="block__container">
                    <div class="block__item b-shadow">
                        <h3 class="block__item--title">Contacts</h3>
                        <div class="block__item--body">
                            <ul class="block__item--body__info-list">
                                <li><strong>Տիպ:</strong> {{ $estate->contract_type?->name_arm }}</li>
                                <li><strong>visits count:</strong> {{ $estate->visits_count }}</li>
                                <li><strong>Կոդ:</strong> {{ $estate->code }}</li>
                                <li><strong>desc:</strong> {{ $estate->public_text_arm }}</li>
                                <li><strong>Շենք:</strong> {{ $estate->address_building }}</li>
                                <li><strong>Հարկ:</strong> {{ $estate->floor }}/{{ $estate->building_floor_count }}</li>
                                <li><strong>Սենյակներ:</strong> {{ $estate->room_count }}</li>
                                <li><strong>Սենյակներ mod:</strong> {{ $estate->room_count_modified }}</li>
                                <li><strong>Ընդհանուր մակերես:</strong> {{ $estate->area_total }}</li>
                                <li><strong>1քմ արժեք:</strong> {{ $estate->price_per_square }}</li>
                                <li><strong>Գին:</strong> {{ $estate->full_price }}</li>
                                <li><strong>Առաստաղի բարձրություն:</strong> {{ $estate->ceiling_height_type?->name_arm }}
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </section>

        </div><!-- End main-container -->
    </div>
@endsection



@push('after_scripts')
    <script>
        $(document).ready(function () {
            var swiper = new Swiper(".SwiperThumbs", {
                spaceBetween: 2,
                slidesPerView: 5,
                freeMode: true,
                watchSlidesProgress: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
            var SwiperThumbs = new Swiper(".EstatesSlider", {
                spaceBetween: 10,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                thumbs: {
                    swiper: swiper,
                },

                zoom: {
                    maxRatio: 5,
                },
            });
        })

    </script>
@endpush

@push('after_styles')
    <style>

        .slider-container {
            flex-direction: column;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .SwiperThumbs .swiper-slide img {
            display: block;
            width: 120px;
            height: 70px;
            object-fit: cover;
        }


        .swiper {
            width: 600px;
            height: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .SwiperThumbs {
            height: 120px;
            width: 100%;
        }

        .EstatesSlider {
            height:500px;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .Swiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .Swiper .swiper-slide-thumb-active {
            opacity: 1;
        }




    </style>
@endpush



