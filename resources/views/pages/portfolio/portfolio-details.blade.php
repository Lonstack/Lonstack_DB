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

    {{-- Cover image --}}
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

    {{-- Two-column: description + metadata --}}
    <div class="row rg-40 mb-60">

      {{-- Left: title + description + tags --}}
      <div class="col-lg-8">
        <h2 class="title fw-6 mb-25" style="font-size:clamp(22px,3vw,34px); line-height:1.3;">
          {{ $portfolio->title }}
        </h2>

        @if ($portfolio->description)
        <div class="portfolio-rich-text mb-30">
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

    {{-- Challenge & Solution --}}
    @if ($portfolio->challenge || $portfolio->solution)
    <div class="row rg-40 mb-60">

      @if ($portfolio->challenge)
      <div class="col-lg-{{ $portfolio->solution ? '6' : '12' }}">
        <div style="height:100%; border:1px solid var(--stroke-2); border-radius:16px; padding:36px 32px;">
          <div style="display:flex; align-items:center; gap:14px; margin-bottom:20px;">
            <div style="width:44px; height:44px; border-radius:50%; background:rgba(67,186,255,0.12);
                        display:flex; align-items:center; justify-content:center; flex-shrink:0;">
              <i class="icon-puzzle" style="font-size:20px; color:var(--primary);"></i>
            </div>
            <h3 style="font-size:clamp(18px,2vw,22px); font-weight:700; margin:0;">The Challenge</h3>
          </div>
          <div class="portfolio-rich-text">
            {!! $portfolio->challenge !!}
          </div>
        </div>
      </div>
      @endif

      @if ($portfolio->solution)
      <div class="col-lg-{{ $portfolio->challenge ? '6' : '12' }}">
        <div style="height:100%; border:1px solid var(--stroke-2); border-radius:16px; padding:36px 32px;">
          <div style="display:flex; align-items:center; gap:14px; margin-bottom:20px;">
            <div style="width:44px; height:44px; border-radius:50%; background:rgba(67,186,255,0.12);
                        display:flex; align-items:center; justify-content:center; flex-shrink:0;">
              <i class="icon-lightbulb" style="font-size:20px; color:var(--primary);"></i>
            </div>
            <h3 style="font-size:clamp(18px,2vw,22px); font-weight:700; margin:0;">Our Solution</h3>
          </div>
          <div class="portfolio-rich-text">
            {!! $portfolio->solution !!}
          </div>
        </div>
      </div>
      @endif

    </div>
    @endif

    {{-- Technologies & Features --}}
    @if (($portfolio->technologies && count($portfolio->technologies)) || ($portfolio->features && count($portfolio->features)))
    <div class="row rg-40 mb-60">

      @if ($portfolio->technologies && count($portfolio->technologies))
      <div class="col-lg-{{ ($portfolio->features && count($portfolio->features)) ? '6' : '12' }}">
        <h3 style="font-size:clamp(18px,2vw,22px); font-weight:700; margin-bottom:20px;">Technologies Used</h3>
        <div class="d-flex flex-wrap gap-2">
          @foreach ($portfolio->technologies as $tech)
          <span style="padding:8px 20px; border-radius:50px; font-size:14px; font-weight:600;
                       background:rgba(67,186,255,0.1); border:1px solid rgba(67,186,255,0.3);
                       color:var(--primary);">
            {{ $tech }}
          </span>
          @endforeach
        </div>
      </div>
      @endif

      @if ($portfolio->features && count($portfolio->features))
      <div class="col-lg-{{ ($portfolio->technologies && count($portfolio->technologies)) ? '6' : '12' }}">
        <h3 style="font-size:clamp(18px,2vw,22px); font-weight:700; margin-bottom:20px;">Key Features</h3>
        <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:12px;">
          @foreach ($portfolio->features as $feature)
          <li style="display:flex; align-items:flex-start; gap:12px;">
            <span style="width:22px; height:22px; border-radius:50%; background:rgba(67,186,255,0.15);
                         display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px;">
              <i class="icon-check" style="font-size:11px; color:var(--primary);"></i>
            </span>
            <span style="font-size:15px; line-height:1.5;">{{ $feature }}</span>
          </li>
          @endforeach
        </ul>
      </div>
      @endif

    </div>
    @endif

    {{-- Gallery images --}}
    @if ($portfolio->gallery && count($portfolio->gallery))
    <div class="mb-60">
      <div class="sub-title body-2 fw-7 mb-30 title-animation"
        style="letter-spacing:.08em; text-transform:uppercase; color:rgba(255,255,255,0.4);">
        Project Gallery
      </div>

      {{-- Desktop: flex row --}}
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

    {{-- Project summary --}}
    @if ($portfolio->summary)
    <div class="mb-60">
      <h3 class="portfolio-section-title">Project Summary</h3>
      <div class="portfolio-rich-text">
        {!! $portfolio->summary !!}
      </div>
    </div>
    @endif

    {{-- Tags + Share row --}}
    <div class="tag-social flex justify-content-between align-items-center flex-wrap g-20 mb-40">
      @if ($portfolio->tags && count($portfolio->tags))
      <div class="left tags flex g-20 align-items-center">
        <span class="fw-5">Tags</span>
        <div class="tabs-list">
          @foreach ($portfolio->tags as $tag)
          <a href="{{ route('portfolio') }}" class="tabs-item fw-5">{{ $tag }}</a>
          @endforeach
        </div>
      </div>
      @endif
      <div class="right social flex g-20 align-items-center">
        <span class="fw-5">Share</span>
        <ul class="post-social style-radius-50 g-10">
          <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
              target="_blank" rel="noopener noreferrer" class="icon-social" title="Share on Facebook">
              <i class="icon-fb"></i>
            </a>
          </li>
          <li>
            <a href="https://x.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($portfolio->title) }}"
              target="_blank" rel="noopener noreferrer" class="icon-social" title="Share on X">
              <i class="icon-X"></i>
            </a>
          </li>
          <li>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
              target="_blank" rel="noopener noreferrer" class="icon-social" title="Share on LinkedIn">
              <i class="icon-linkedin"></i>
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/lonstacksoftware"
              target="_blank" rel="noopener noreferrer" class="icon-social" title="Follow on Instagram">
              <i class="icon-instagram"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>

{{-- Related projects — same service only --}}
@if ($related->isNotEmpty())
<section class="section-project tf-spacing-2" style="overflow-x:clip;">
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

    <a class="arrow-btn style-border w-50 arrow-prev related-prev d-none d-md-flex"
      style="position:absolute; left:-25px; top:45%; transform:translateY(-50%); z-index:10; cursor:pointer;">
      <i class="icon-arrow-left2"></i>
    </a>

    <div class="swiper tf-swiper"
      data-swiper='{
                    "slidesPerView": 1,
                    "spaceBetween": 20,
                    "speed": 700,
                    "navigation": { "clickable": true, "nextEl": ".related-next", "prevEl": ".related-prev" },
                    "pagination": { "el": ".related-pagination", "clickable": true },
                    "breakpoints": {
                        "640":  { "slidesPerView": 2, "spaceBetween": 24 },
                        "1200": { "slidesPerView": 3, "spaceBetween": 30 }
                    }
                 }'>
      <div class="swiper-wrapper">
        @foreach ($related as $item)
        <div class="swiper-slide">
          <div class="project-gird-item project-item related-project-item">
            {{-- Image with category badge overlaid top-left --}}
            <a href="{{ route('portfolio-details', $item->slug) }}" class="related-project-img-wrap">
              @if ($item->cover_image)
              <img src="{{ asset('storage/' . $item->cover_image) }}"
                alt="{{ $item->title }}" class="lazyload related-project-img">
              @else
              <img src="{{ asset('image/project-item/project-item-2.jpg') }}"
                alt="{{ $item->title }}" class="lazyload related-project-img">
              @endif
              @if($item->service)
              <span class="related-project-badge">{{ $item->service->name }}</span>
              @endif
            </a>
            {{-- Title only below the image --}}
            <div class="related-project-content item-content">
              <h3 class="title-project related-project-title">
                <a href="{{ route('portfolio-details', $item->slug) }}">{{ $item->title }}</a>
              </h3>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <a class="arrow-btn style-border w-50 arrow-next related-next d-none d-md-flex"
      style="position:absolute; right:-25px; top:45%; transform:translateY(-50%); z-index:10; cursor:pointer;">
      <i class="icon-arrow-right2"></i>
    </a>
  </div>

  {{-- Pagination dots on mobile --}}
  <div class="related-pagination sw-pagination mt-30 justify-content-center d-md-none"></div>
</section>
@endif

@endsection
