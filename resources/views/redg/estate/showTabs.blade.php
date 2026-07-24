@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      $crud->entity_name_plural => url($crud->route),
      trans('backpack::crud.preview') => false,
    ];

    $viewType = $crud->viewType;

    $estate = $entry;

    $images = $estate->estateDocuments;

    foreach ($images as $image) {
        $image->path = '/estate/photos/'.$estate->id.'/'.$image->path;
    }

    if ($estate->is_company_project) {
        $images = $images->merge($estate->project?->documents);
    }
    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;


@endphp

@section('header')
    <div class="container-fluid d-flex justify-content-between my-3">
        <section class="header-operation animated fadeIn d-flex mb-2 align-items-end d-print-none"
                 bp-section="page-header">
            <h1 class="text-capitalize mb-0"
                bp-section="page-heading">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</h1>
            <p class="ms-2 ml-2 mb-0"
               bp-section="page-subheading">{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name !!}</p>
            @if ($crud->hasAccess('list'))
                <p class="ms-2 ml-2 mb-0" bp-section="page-subheading-back-button">
                    <small><a href="{{ url($crud->route) }}" class="font-sm"><i
                                class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                            <span>{{ $crud->entity_name_plural }}</span></a></small>
                </p>
            @endif
        </section>
        <a href="javascript: window.print();" class="btn float-end float-right"><i class="la la-print"></i></a>
    </div>
@endsection

@section('content')

    <section class="main-container__main b-shadow bg-white p-4 mb-4">
        <div class="row">
            <div class="col-md-10">
                <h1 class="text-2xl">{{ $estate->short_description ?? '' }}</h1>
            </div>
            <div class="col-md-2">
                @include('crud::inc.button_stack', ['stack' => 'line'])
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 main-container__main--left slider-container">
                <div class="swiper EstatesSlider swiper-container">
                    <!-- Slider main container -->
                    <div class="swiper-wrapper">
                        @foreach($images as $image)
                            @if ($viewType !== 'viewOnly' || $image->is_public)
                                <div class="swiper-slide">
                                    <div class="swiper-zoom-container">
                                        <div class="image_info">
                                        @if($estate->main_image_file_path === $image->path)
                                        <span class="main_image"><i class="las la-star"></i></span>
                                        @else
                                        <span class="main_image text-danger"><i class="lar la-star"></i></span>
                                        @endif
                                        @if($image->is_public)
                                                <span class="is_public"><i class="las la-eye"></i></span>
                                        @else
                                                <span class="is_private text-danger"><i class="las la-eye-slash"></i></span>
                                        @endif
                                        </div>
                                        <img src="{{ Storage::disk('S3Public')->url($image->path) }}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next bg-light"></div>
                    <div class="swiper-button-prev bg-light"></div>
                </div>

                <div class="swiper SwiperThumbs">
                    <div class="swiper-wrapper">
                        @foreach($images as $image)
                            @if ($viewType !== 'viewOnly' || $image->is_public)
                            <div class="swiper-slide mr-2">
                                <img src="{{ Storage::disk('S3Public')->url($image->path) }}">
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="col-md-5 pt-16">
                <p class="text-xl mb-12 flex flex-row flex-wrap  justify-start align-items-center pr-16" style="gap: 20px">

                    <span  class="bg-green text-white p-4 mr-4">{{ isset($estate->contract_type) ? $estate->contract_type->name_arm : '' }}
                    </span>
                    <span class="mr-4">{{ isset($estate->code) ? $estate->code : '' }}</span>



                    <span class="ml-auto"><i class="las la-desktop"></i> {{ isset($estate->visits_count) ? $estate->visits_count : '' }}</span>
                </p>

                <p class="text-sm">{{ isset($estate->public_text_arm) ? $estate->public_text_arm : '' }}</p>

                <div class="flex flex-wrap justify-content-left mt-10 flex-row" style="gap: 10px">
                    @if($viewType !='viewOnly')
                    <div class="p-4  bg-slate-100">
                        {{ $estate->estate_type_id !== 4 ? "Շենք" : "Հող" }}: {{ isset($estate->address_building) ? $estate->address_building : '' }}
                    </div>
                    @endif

                        @if($estate->is_separate_building)
                            <div class="p-4  bg-slate-100">
                                Առանձին շինություն: <i class="la la-check-circle"></i></div>
                        @endif
                        @if(isset($estate->floor))
                    <div class="p-4 bg-slate-100">Հարկ: {{ isset($estate->floor) ? $estate->floor : '' }}
                        {{ isset($estate->building_floor_count) ? '/'.$estate->building_floor_count : '' }}
                    </div>
                        @endif

                        @if(isset($estate->room_count))
                    <div class="p-4 bg-slate-100">
                        {{ $estate->estate_type_id == 3 ? 'Սրահներ' : 'Սենյակներ' }}: {{ isset($estate->room_count) ? $estate->room_count : '' }}  {{ $estate->room_count_modified > 0 ? '/'.$estate->room_count_modified : '' }}
                    </div>
                        @endif

                    @if(isset($estate->ceiling_height_type))
                    <div class="p-4 bg-slate-100">Առաստաղի
                        բարձրություն: {{ isset($estate->ceiling_height_type) ? $estate->ceiling_height_type->name_arm : '' }}
                    </div>
                    @endif
                        @if(isset($estate->area_total))
                    <div class="p-4 bg-slate-100">Ընդհանուր
                        մակերես: {{ isset($estate->area_total) ? $estate->area_total : '' }}
                    </div>
                        @endif


                    <div class="p-4 bg-slate-100">1քմ
                        արժեք: {{ isset($estate->price_per_square) ? $estate->price_per_square : '' }}</div>
                    <div class="p-4 bg-slate-100">
                        Գին: {{ isset($estate->full_price) ? $estate->full_price : '' }}</div>
                    @if($estate->refund_display)
                        <div class="p-4 bg-slate-100">
                            {{ trans('estate.refund') }}: {{ $estate->refund_display }}
                        </div>
                    @endif
                </div>
            </div>

            @if(isset( $estate->agent))
            <div class="col-md-2 pt-16 pl-16 text-center  border-l border-solid">
                <h3 class="mb-4">Գործակալ</h3>
                @if(isset( $estate->agent->average_rating))
                    <div class="flex items-center space-x-1 text-center flex justify-center mb-8">
                        @for ($i = 0; $i < $estate->agent->average_rating; $i++)
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                        @endfor

                        @for ($i = $estate->agent->average_rating; $i < 5; $i++)
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        @endfor
                    </div>
                @endif
                <p class="text-sm ">{{ isset($estate->agent->contact) ? $estate->agent->contact->fullName : '' }}</p>



                <p class="text-sm mt-4 mb-4">
                    <a href="{{backpack_url('professional/' . $estate->agent->id . '/show')}}">
                    <img class="m-auto" width="150px"
                         src="{{
                isset($estate->agent->profile_picture_path) ?  Storage::disk('S3Public')->url('/estate/photos/'.$estate->agent->profile_picture_path) : ''
     }}"
                    />
                    </a>

                </p>
                <p class="text-sm ">{{ isset($estate->agent->contact) ? $estate->agent->contact->email : '' }}</p>
                <p class="text-sm ">{{ isset($estate->agent->contact) ? $estate->agent->contact->phone_mobile_1 : '' }}</p>

            </div>
            @else
                @php
                $redAgent = \App\Models\RealtorUser::find(217);
                @endphp
                <div class="col-md-2 pt-16 pl-16 text-center  border-l border-solid">
                    <h3 class="mb-4">Գործակալ</h3>
                    @if(isset( $redAgent->average_rating))
                        <div class="flex items-center space-x-1 text-center flex justify-center mb-8">
                            @for ($i = 0; $i < $redAgent->average_rating; $i++)
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                            @endfor

                            @for ($i = $redAgent->average_rating; $i < 5; $i++)
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            @endfor
                        </div>
                    @endif
                    <p class="text-sm ">{{ isset($redAgent->contact) ? $redAgent->contact->fullName : '' }}</p>



                    <p class="text-sm mt-4 mb-4">
                        <a href="{{backpack_url('professional/' . $redAgent->id . '/show')}}">
                            <img class="m-auto" width="150px"
                                 src="{{
                isset($redAgent->profile_picture_path) ?  Storage::disk('S3Public')->url('/estate/photos/'.$redAgent->profile_picture_path) : ''
     }}"
                            />
                        </a>

                    </p>
                    <p class="text-sm ">{{ isset($redAgent->contact) ? $redAgent->contact->email : '' }}</p>
                    <p class="text-sm ">{{ isset($redAgent->contact) ? $redAgent->contact->phone_mobile_1 : '' }}</p>

                </div>
            @endif


        </div>
    </section>
    <div class="row" bp-section="crud-operation-show">
        <div class="{{ $crud->getShowContentClass() }}">

            {{-- Default box --}}
            <div class="estate_main_view">
                @if ($crud->model->translationEnabled())
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            {{-- Change translation button group --}}
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                        data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    {{trans('backpack::crud.language')}}
                                    : {{ $crud->model->getAvailableLocales()[request()->input('_locale')?request()->input('_locale'):App::getLocale()] }}
                                    &nbsp; <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                                        <a class="dropdown-item"
                                           href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}?_locale={{ $key }}">{{ $locale }}</a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                @if($crud->tabsEnabled() && count($crud->getUniqueTabNames('columns')))
                    @include('crud::inc.show_tabbed_table')
                @else
                    <div class="card no-padding no-border mb-0">
                        @include('crud::inc.show_table', ['columns' => $crud->columns()])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@push('after_scripts')
    <script>
        $(document).ready(function () {
            var SwiperThumbs = new Swiper(".SwiperThumbs", {
                spaceBetween: 2,
                slidesPerView: 5,
                freeMode: true,
                watchSlidesProgress: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            var swiper = new Swiper(".EstatesSlider", {

                effect: 'fade',
                spaceBetween: 10,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                keyboard: {
                    enabled: true,
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                thumbs: {
                    swiper: SwiperThumbs,
                },

                zoom: {
                    maxRatio: 5,
                },
            });


            var swiperSlides = Array.from(swiper.slides);

            console.log(swiperSlides)

            swiperSlides.forEach(function(slide) {
                console.log('foreach');
                openFullscreenSliderHandler(slide);
                closeFullscreenSliderHandler(slide);
            });

            function openFullscreenSliderHandler(slide) {
                var slideImage = slide.querySelector('img');

                slideImage.addEventListener('click', function() {
                    var slideNumber = slide.dataset.swiperSlideIndex;
                    openFullscreenSwiper(slideNumber);
                });
            }

            function openFullscreenSwiper(slideNumber) {
                swiper.el.classList.add('fullscreen');
                swiper.params.slidesPerView = 1;
                swiper.update();
                swiper.slideToLoop(parseInt(slideNumber, 10), 0);
            }

            function closeFullscreenSliderHandler(slide) {
                var slideNumber = slide.dataset.swiperSlideIndex;
                var backdrop = document.createElement('div');
                var closeButton = document.createElement('div');

                slide.appendChild(backdrop);
                slide.appendChild(closeButton);
                backdrop.classList.add('backdrop');
                closeButton.classList.add('close-button');
                closeButton.innerHTML = 'Փակել';

                backdrop.addEventListener('click', function() {
                    closeFullscreenSwiper(slideNumber);
                });

                closeButton.addEventListener('click', function() {
                    closeFullscreenSwiper(slideNumber);
                });
            }

            function closeFullscreenSwiper(slideNumber) {
                swiper.el.classList.remove('fullscreen');
                swiper.params.slidesPerView = 1;
                swiper.update();
                swiper.slideToLoop(parseInt(slideNumber, 10), 0);
            }



        })

    </script>
@endpush
@section('after_styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            important: true,
        }
    </script>
    <link rel="stylesheet" href="{{ asset('assets/css/views.css') }}">
@endsection
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
        }

        .SwiperThumbs .swiper-slide img {
            display: block;
            width: 120px;
        }


        .swiper {
            width: 100%;
            height: 800px;
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
            height: 700px;
            box-sizing: border-box;
            padding: 10px 0;
        }


        .Swiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .swiper-container {
            height: 600px;
        }
        .swiper-container.fullscreen {
            height: 90vh;
            width: 90%;
            top:5vh;
            position: fixed;
            left: 5%;
            z-index: 14800;
            background: #333;
        }
        .swiper-slide {
            background: #555;
            text-align: center;
            /* Center slide text vertically */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .swiper-slide img {
            position: absolute;
            max-width: 100%;
            z-index: 2;
            cursor: pointer;
        }
        .swiper-slide figcaption {
            position: absolute;
            bottom: 15%;
            z-index: 3;
        }
        .swiper-slide a {
            background: #000;
            color: #fff;
        }
        .fullscreen .swiper-slide img {
            pointer-events: none;
        }
        .fullscreen .swiper-slide .backdrop {
            background: #000;
            opacity: .7;
            width: 100vw;
            height: 100vh;
            position: absolute;
            top: 0;
            z-index: 1;
            cursor: pointer;
        }

        .close-button {
            display: none;
        }

        .fullscreen .swiper-slide .close-button {
            background: #fff;
            border: 2px solid #000;
            color: #000;
            font-size: 20px;
            font-family: sans-serif;
            padding: 10px 18px;
            position: absolute;
            display: block;
            top: 0;
            right: 0;
            z-index: 4;
            cursor: pointer;
        }

        .fullscreen .swiper-button-next, .fullscreen .swiper-button-prev {
            width: 80px;
            height: 80px;
        }

        .image_info {
            position: absolute;
            top: 0;
            left: 15px;
            color: green;
            z-index: 1500;
            font-size: 30px;
            background: #fff;
            display: flex;
            flex-direction: row;
            column-gap: 15px;
            padding: 15px;
        }



    </style>
@endpush


