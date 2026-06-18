@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      $crud->entity_name_plural => url($crud->route),
      trans('backpack::crud.preview') => false,
    ];

    $professional = $entry;

@endphp

@section('header')
    <div class="container-fluid d-flex justify-content-between my-3">
        <section class="header-operation animated fadeIn d-flex mb-2 align-items-end d-print-none"
                 bp-section="page-header">
            <h1 class="text-capitalize mb-0"
                bp-section="page-heading">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</h1>

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
            <div class="col-md-3 pt-16">

                <img width="100%"
                     src="{{
                isset($professional->profile_picture_path) ?  Storage::disk('S3Public')->url('/estate/photos/'.$professional->profile_picture_path) : ''
     }}"
                />
            </div>
            <div class="col-md-4 pt-16 pl-16 text-left  border-l border-solid">
                <h1 class="text-2xl mb-4 ">{{ isset($professional->contact) ? $professional->contact->fullName : '' }}</h1>
                <h3 class="mb-4">Գործակալ</h3>
                @if(isset( $professional->average_rating))
                    <div class="flex items-center space-x-1 text-left flex justify-left mb-8">
                        @for ($i = 0; $i < $professional->average_rating; $i++)
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                        @endfor

                        @for ($i = $professional->average_rating; $i < 5; $i++)
                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                        @endfor
                    </div>
                @endif
                <p class="mb-4"><i class="las la-envelope mr-2"></i> {{ isset($professional->contact) ? $professional->contact->email : '' }}</p>
                <p class="mb-4"><i class="las la-phone-volume mr-2"></i>
                    {{ isset($professional->contact) ? $professional->contact->phone_mobile_1 : '' }} ,
                    {{ isset($professional->contact) ? $professional->contact->phone_mobile_2 : '' }} ,
                    {{ isset($professional->contact) ? $professional->contact->phone_mobile_2 : '' }}
                </p>

                <p>Համայնք:
                    @foreach ($professional->locationCommunities as $community)
                        {{ $community->name_arm }},
                    @endforeach
                </p>




            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-12">
                <p class="text-sm ">{{ isset($professional->contact->comment_arm) ? $professional->contact->comment_arm : '' }}</p>
            </div>
            <div class="col-md-12">
                <a class="btn bg-light" href="{{backpack_url('estate?agents='.$professional->id)}}">Անշարժ գույքեր ({{count($professional->broker_estates)}})</a>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-md-12 mt-12">
        <div class="tab-container mb-2">

            <div class="nav-tabs-custom"  id="form_tabs">
                <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="nav-item">
                            <a href="#tab_reviews"
                               aria-controls="tab_reviews"
                               role="tab"
                               data-toggle="tab"
                               tab_name="reviews"
                               data-name="reviews"
                               data-bs-toggle="tab"
                               class="nav-link active"
                            >Հաճախորդների գնահատականներ</a>
                        </li>
                </ul>

                <div class="tab-content p-0">
                        <div role="tabpanel" class="tab-pane p-0 border-none active" id="tab_reviews">

                                @foreach ($professional->reviews as $review)
                                <p class="mb-2 ">  {{ $review->sender_name }} | {{ $review->sent_on }}</p>
                                @if(isset( $review->overall_rating))
                                    <p class="flex items-center space-x-1 text-left flex justify-left mb-8">
                                        @for ($i = 0; $i < $review->overall_rating; $i++)
                                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                 fill="currentColor" viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                        @endfor

                                        @for ($i = $review->overall_rating; $i < 5; $i++)
                                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                        @endfor
                                    </p>
                                @endif
                                <p class="mb-8 pb-4 border-b">  {{ $review->message_text }} </p>
                                @endforeach

                        </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row" bp-section="crud-operation-show">
        <div class="{{ $crud->getShowContentClass() }}">

            {{-- Default box --}}
            <div class="">
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

                effect: 'fade',
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
            height: 500px;
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


