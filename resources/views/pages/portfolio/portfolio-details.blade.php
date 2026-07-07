@extends('layouts.guest')

@section('content')

    <!-- Page-title -->
    <div class="page-title">
        <div class="tf-container">
            <div class="page-title-content text-center">
                <h1 class="title ml-11 split-text effect-right">Project Details</h1>
                <div class="breadkcum">
                    <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
                    <span class="dot"></span>
                    <a href="{{ route('portfolio') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Portfolio</a>
                    <span class="dot"></span>
                    <span class="page-breadkcum body-2 fw-7 split-text effect-right">{{ Str::limit($portfolio->title, 40) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="main-content tf-spacing-2">
        <div class="tf-container">

            {{-- ── Cover image ── --}}
            <div style="overflow:hidden; border-radius:12px; margin-bottom:50px;">
                @if ($portfolio->cover_image)
                    <img src="{{ asset('storage/' . $portfolio->cover_image) }}"
                         alt="{{ $portfolio->title }}"
                         style="width:100%; max-height:480px; object-fit:cover; display:block;">
                @else
                    <img src="{{ asset('image/section/project-details-1.jpg') }}"
                         alt="{{ $portfolio->title }}"
                         style="width:100%; max-height:480px; object-fit:cover; display:block;">
                @endif
            </div>

            {{-- ── Two-column: description + metadata ── --}}
            <div class="row rg-40 mb-60">

                {{-- Left: title + description + tags --}}
                <div class="col-lg-8">
                    <h2 class="title fw-6 mb-25" style="font-size:clamp(22px,3vw,34px); line-height:1.3;">
                        {{ $portfolio->title }}
                    </h2>

                    @if ($portfolio->description)
                    <div class="desc lh-30 mb-30" style="color:rgba(255,255,255,0.75); font-size:15px;">
                        {!! $portfolio->description !!}
                    </div>
                    @endif

                    @if ($portfolio->tags && count($portfolio->tags))
                    <div class="d-flex flex-wrap gap-2 mt-20">
                        @foreach ($portfolio->tags as $tag)
                        <span style="padding:6px 16px; border-radius:50px; font-size:13px; font-weight:600;
                                     background:rgba(67,186,255,0.1); border:1px solid rgba(67,186,255,0.25);
                                     color:var(--primary);">
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Right: metadata card --}}
                <div class="col-lg-4">
                    <div style="border:1px solid var(--stroke-2); border-radius:16px; padding:32px 28px;">
                        @if ($portfolio->service)
                        <div style="padding-bottom:18px; margin-bottom:18px; border-bottom:1px solid var(--stroke-2);">
                            <div style="font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
                                        color:var(--primary); margin-bottom:6px;">Service</div>
                            <div style="font-size:15px; font-weight:600;">{{ $portfolio->service->name }}</div>
                        </div>
                        @endif

                        @if ($portfolio->client)
                        <div style="padding-bottom:18px; margin-bottom:18px; border-bottom:1px solid var(--stroke-2);">
                            <div style="font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
                                        color:var(--primary); margin-bottom:6px;">Client</div>
                            <div style="font-size:15px; font-weight:600;">{{ $portfolio->client }}</div>
                        </div>
                        @endif

                        @if ($portfolio->location)
                        <div style="padding-bottom:18px; margin-bottom:18px; border-bottom:1px solid var(--stroke-2);">
                            <div style="font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
                                        color:var(--primary); margin-bottom:6px;">Location</div>
                            <div style="font-size:15px; font-weight:600;">{{ $portfolio->location }}</div>
                        </div>
                        @endif

                        @if ($portfolio->published_at)
                        <div>
                            <div style="font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
                                        color:var(--primary); margin-bottom:6px;">Published</div>
                            <div style="font-size:15px; font-weight:600;">{{ $portfolio->published_at->format('F d, Y') }}</div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ── Gallery images ── --}}
            @if ($portfolio->gallery && count($portfolio->gallery))
            <div class="mb-60">
                <div class="sub-title body-2 fw-7 mb-30 title-animation"
                     style="letter-spacing:.08em; text-transform:uppercase; color:rgba(255,255,255,0.4);">
                    Project Gallery
                </div>

                {{-- Desktop: clean grid --}}
                <div class="d-none d-md-flex" style="gap:16px;">
                    @foreach ($portfolio->gallery as $image)
                    <div style="flex:1; overflow:hidden; border-radius:10px;">
                        <img src="{{ asset('storage/' . $image) }}"
                             alt="{{ $portfolio->title }}"
                             style="width:100%; height:260px; object-fit:cover; display:block;
                                    transition:transform .4s;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                    </div>
                    @endforeach
                </div>

                {{-- Mobile: swiper --}}
                <div class="d-md-none">
                    <div class="swiper tf-swiper"
                         data-swiper='{
                            "slidesPerView": 1.15,
                            "spaceBetween": 12,
                            "speed": 600,
                            "pagination": { "el": ".gallery-pagination", "clickable": true }
                         }'>
                        <div class="swiper-wrapper">
                            @foreach ($portfolio->gallery as $image)
                            <div class="swiper-slide">
                                <div style="overflow:hidden; border-radius:10px;">
                                    <img src="{{ asset('storage/' . $image) }}"
                                         alt="{{ $portfolio->title }}"
                                         style="width:100%; height:220px; object-fit:cover; display:block;">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="gallery-pagination sw-pagination mt-20 justify-content-center"></div>
                </div>
            </div>
            @endif

            {{-- ── Project summary ── --}}
            @if ($portfolio->summary)
            <div class="mb-60">
                <h3 class="title fw-6 mb-25" style="font-size:clamp(20px,2.5vw,28px);">Project Summary</h3>
                <div class="desc lh-30" style="color:rgba(255,255,255,0.75); font-size:15px;">
                    {!! $portfolio->summary !!}
                </div>
            </div>
            @endif

            {{-- ── Share row ── --}}
            @if ($portfolio->tags && count($portfolio->tags))
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;
                        gap:20px; padding:28px 0; border-top:1px solid var(--stroke-2);
                        border-bottom:1px solid var(--stroke-2); margin-bottom:60px;">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <span class="body-2 fw-5">Tags</span>
                    @foreach ($portfolio->tags as $tag)
                    <a href="{{ route('portfolio') }}" class="tabs-item fw-5">{{ $tag }}</a>
                    @endforeach
                </div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <span class="body-2 fw-5">Share</span>
                    <ul class="post-social style-radius-50 g-10">
                        <li><a href="#" class="icon-social"><i class="icon-fb"></i></a></li>
                        <li><a href="#" class="icon-social"><i class="icon-X"></i></a></li>
                        <li><a href="#" class="icon-social"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#" class="icon-social"><i class="icon-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            @endif

        </div>

        {{-- ── Prev / Next navigation ── --}}
        @if ($prev || $next)
        <div class="next-prev-details tf-spacing-2">
            <div class="tf-container">
                <div class="row rg-50">
                    @if ($prev)
                    <div class="col-sm-6">
                        <div class="prev-details next-prev-item">
                            <a href="{{ route('portfolio-details', $prev->slug) }}" class="link">
                                <i class="icon-arrow-left"></i> Previous
                            </a>
                            <h4 class="title">
                                <a href="{{ route('portfolio-details', $prev->slug) }}">{{ $prev->title }}</a>
                            </h4>
                            @if ($prev->cover_image)
                            <a href="{{ route('portfolio-details', $prev->slug) }}" class="image">
                                <img src="{{ asset('storage/' . $prev->cover_image) }}"
                                     alt="{{ $prev->title }}" class="lazyload">
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if ($next)
                    <div class="col-sm-6">
                        <div class="next-details next-prev-item">
                            <a href="{{ route('portfolio-details', $next->slug) }}" class="link">
                                Next <i class="icon-arrow-right"></i>
                            </a>
                            <h4 class="title">
                                <a href="{{ route('portfolio-details', $next->slug) }}">{{ $next->title }}</a>
                            </h4>
                            @if ($next->cover_image)
                            <a href="{{ route('portfolio-details', $next->slug) }}" class="image">
                                <img src="{{ asset('storage/' . $next->cover_image) }}"
                                     alt="{{ $next->title }}" class="lazyload">
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- ── Related projects ── --}}
    @if ($related->isNotEmpty())
    <section class="section-project tf-spacing-2">
        <div class="tf-container">
            <div class="heading-section mb-60 text-center">
                <div class="sub-title body-2 fw-7 mb-17 title-animation">Related Projects</div>
                <h2 class="title fw-6 title-animation">
                    More From
                    <span class="fw-3">{{ $portfolio->service->name ?? 'This Service' }}</span>
                </h2>
            </div>
        </div>

        <div class="tf-container" style="position:relative;">
            <a class="arrow-btn style-border w-50 arrow-prev related-prev"
               style="position:absolute; left:-25px; top:50%; transform:translateY(-50%); z-index:10; cursor:pointer;">
                <i class="icon-arrow-left2"></i>
            </a>

            <div class="swiper tf-swiper sw-related-project"
                 data-swiper='{
                    "slidesPerView": 1,
                    "spaceBetween": 30,
                    "speed": 800,
                    "navigation": { "clickable": true, "nextEl": ".related-next", "prevEl": ".related-prev" },
                    "breakpoints": {
                        "768": { "slidesPerView": 2, "slidesPerGroup": 1 }
                    }
                 }'>
                <div class="swiper-wrapper">
                    @foreach ($related as $item)
                    <div class="swiper-slide">
                        <div class="project-gird-item project-item">
                            <a href="{{ route('portfolio-details', $item->slug) }}" class="image"
                               style="display:block; overflow:hidden; border-radius:8px;">
                                @if ($item->cover_image)
                                    <img src="{{ asset('storage/' . $item->cover_image) }}"
                                         alt="{{ $item->title }}" class="lazyload"
                                         style="width:100%; height:280px; object-fit:cover; display:block;">
                                @else
                                    <img src="{{ asset('image/project-item/project-item-2.jpg') }}"
                                         alt="{{ $item->title }}" class="lazyload"
                                         style="width:100%; height:280px; object-fit:cover; display:block;">
                                @endif
                            </a>
                            <div class="item-content">
                                <div class="sub-title body-2 fw-7">{{ $item->service->name ?? '' }}</div>
                                <h3 class="title-project">
                                    <a href="{{ route('portfolio-details', $item->slug) }}">{{ $item->title }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <a class="arrow-btn style-border w-50 arrow-next related-next"
               style="position:absolute; right:-25px; top:50%; transform:translateY(-50%); z-index:10; cursor:pointer;">
                <i class="icon-arrow-right2"></i>
            </a>
        </div>
    </section>
    @endif

@endsection
