@php
    $title = trim((string) ($estate->meta_title_arm ?: $estate->short_description ?: 'Անշարժ գույք'));
    $metaDescription = trim((string) ($estate->meta_description_arm ?: $estate->public_text_arm ?: $title));
    $currency = session('currency', 'AMD');
    $images = $estate->estateDocuments;
    $location = $estate->public_full_address;
@endphp
<!doctype html>
<html lang="hy">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ route('estates.show', ['estate' => $estate->id]) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/public-estate.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <header class="site-header">
        <div class="site-header__inner">
            <span class="brand">MLS Armenia</span>
        </div>
    </header>

    <main class="estate-page">
        <article class="estate">
            <header class="estate__header">
                <p class="estate__eyebrow">
                    @if($estate->estate_type?->name_arm)
                        {{ $estate->estate_type->name_arm }}
                    @else
                        Անշարժ գույք
                    @endif
                    @if($estate->code)
                        <span aria-hidden="true">·</span> Կոդ՝ {{ $estate->code }}
                    @endif
                </p>
                <h1>{{ $title }}</h1>
                @if($location)
                    <p class="estate__location">{{ $location }}</p>
                @endif
            </header>

            <div class="estate__main">
                <section class="gallery" aria-label="Գույքի լուսանկարներ" data-gallery>
                    @if($images->isNotEmpty())
                        <div class="gallery__stage">
                            @foreach($images as $image)
                                <figure class="gallery__slide" data-gallery-slide @if(!$loop->first) hidden @endif>
                                    <img
                                        src="{{ Storage::disk('S3Public')->url($image->storage_path) }}"
                                        alt="{{ $image->comment_arm ?: $title }}"
                                        @if(!$loop->first) loading="lazy" @else fetchpriority="high" @endif
                                    >
                                </figure>
                            @endforeach

                            @if($images->count() > 1)
                                <button class="gallery__control gallery__control--previous" type="button" data-gallery-previous aria-label="Նախորդ լուսանկարը" title="Նախորդ լուսանկարը">‹</button>
                                <button class="gallery__control gallery__control--next" type="button" data-gallery-next aria-label="Հաջորդ լուսանկարը" title="Հաջորդ լուսանկարը">›</button>
                                <span class="gallery__counter" aria-live="polite"><span data-gallery-current>1</span> / {{ $images->count() }}</span>
                            @endif
                        </div>

                        @if($images->count() > 1)
                            <div class="gallery__thumbnails" aria-label="Լուսանկարների ցանկ">
                                @foreach($images as $image)
                                    <button
                                        class="gallery__thumbnail @if($loop->first) is-active @endif"
                                        type="button"
                                        data-gallery-thumbnail="{{ $loop->index }}"
                                        aria-label="Բացել {{ $loop->iteration }}-րդ լուսանկարը"
                                        aria-pressed="{{ $loop->first ? 'true' : 'false' }}"
                                    >
                                        <img src="{{ Storage::disk('S3Public')->url($image->storage_path) }}" alt="" loading="lazy">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="gallery__empty">Լուսանկարներ դեռ չկան</div>
                    @endif
                </section>

                <section class="estate__summary" aria-label="Գույքի հիմնական տվյալներ">
                    <div class="estate__summary-heading">
                        @if($estate->contract_type?->name_arm)
                            <span class="estate__contract">{{ $estate->contract_type->name_arm }}</span>
                        @endif
                        @if($estate->full_price)
                            <p class="estate__price">{{ $estate->full_price }}</p>
                        @endif
                    </div>

                    <dl class="estate__facts">
                        @if($estate->area_total)
                            <div class="estate__fact">
                                <dt>Ընդհանուր մակերես</dt>
                                <dd>{{ $estate->area_total }} մ²</dd>
                            </div>
                        @endif

                        @if($estate->price_per_square)
                            <div class="estate__fact">
                                <dt>1 մ² արժեք</dt>
                                <dd>{{ number_format($estate->price_per_square, 0, '.', ' ') }} {{ $currency }}</dd>
                            </div>
                        @endif

                        @if($estate->room_count)
                            <div class="estate__fact">
                                <dt>{{ $estate->estate_type_id === 3 ? 'Սրահներ' : 'Սենյակներ' }}</dt>
                                <dd>
                                    {{ $estate->room_count }}
                                    @if($estate->room_count_modified)
                                        / {{ $estate->room_count_modified }}
                                    @endif
                                </dd>
                            </div>
                        @endif

                        @if($estate->floor || $estate->building_floor_count)
                            <div class="estate__fact">
                                <dt>Հարկ</dt>
                                <dd>{{ $estate->floor ?: '—' }}@if($estate->building_floor_count) / {{ $estate->building_floor_count }}@endif</dd>
                            </div>
                        @endif

                        @if($estate->ceiling_height_type?->name_arm)
                            <div class="estate__fact">
                                <dt>Առաստաղի բարձրություն</dt>
                                <dd>{{ $estate->ceiling_height_type->name_arm }}</dd>
                            </div>
                        @endif

                        @if($estate->is_separate_building)
                            <div class="estate__fact">
                                <dt>Շինություն</dt>
                                <dd>Առանձին</dd>
                            </div>
                        @endif
                    </dl>
                </section>
            </div>

            @if($estate->public_text_arm)
                <section class="estate__description" aria-labelledby="estate-description-title">
                    <h2 id="estate-description-title">Նկարագրություն</h2>
                    <div>{!! nl2br(e($estate->public_text_arm)) !!}</div>
                </section>
            @endif
        </article>
    </main>

    <script>
        document.querySelectorAll('[data-gallery]').forEach(function (gallery) {
            var slides = Array.from(gallery.querySelectorAll('[data-gallery-slide]'));
            var thumbnails = Array.from(gallery.querySelectorAll('[data-gallery-thumbnail]'));
            var current = gallery.querySelector('[data-gallery-current]');
            var activeIndex = 0;

            if (slides.length < 2) {
                return;
            }

            function showSlide(index) {
                activeIndex = (index + slides.length) % slides.length;

                slides.forEach(function (slide, slideIndex) {
                    slide.hidden = slideIndex !== activeIndex;
                });

                thumbnails.forEach(function (thumbnail, thumbnailIndex) {
                    var isActive = thumbnailIndex === activeIndex;
                    thumbnail.classList.toggle('is-active', isActive);
                    thumbnail.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });

                current.textContent = String(activeIndex + 1);
            }

            gallery.querySelector('[data-gallery-previous]').addEventListener('click', function () {
                showSlide(activeIndex - 1);
            });

            gallery.querySelector('[data-gallery-next]').addEventListener('click', function () {
                showSlide(activeIndex + 1);
            });

            thumbnails.forEach(function (thumbnail) {
                thumbnail.addEventListener('click', function () {
                    showSlide(Number(thumbnail.dataset.galleryThumbnail));
                });
            });
        });
    </script>
</body>
</html>
