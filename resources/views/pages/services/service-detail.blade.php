@extends('layouts.guest')

@section('content')

{{-- PAGE TITLE --}}
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title split-text effect-right">{{ $service->name }}</h1>
      <div class="breadkcum">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <a href="{{ route('services') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Services</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">{{ $service->name }}</span>
      </div>
    </div>
  </div>
</div>

<div class="main-content position-relative">

  <div class="mask mask-service-4">
    <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
      <circle cx="400" cy="400" r="325" stroke="url(#sd1)" stroke-width="150" />
      <defs>
        <linearGradient id="sd1" x1="176" x2="569" y1="70.5" y2="674">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>

  {{-- ══════════════════════════════════════════
         1. HERO — two-column, image left / content right
    ══════════════════════════════════════════ --}}
  @if($service->hero)
  <section class="section-about p-services tf-spacing-3">
    <div class="tf-container">
      <div class="row align-items-center rg-50">

        @if($service->hero->image)
        <div class="col-12 col-lg-6">
          <div class="image tf-animate-2">
            <img src="{{ asset('storage/' . $service->hero->image) }}"
              data-src="{{ asset('storage/' . $service->hero->image) }}"
              alt="{{ $service->hero->headline }}"
              class="lazyload" style="border-radius:20px;width:100%;">
          </div>
        </div>
        @endif

        <div class="{{ $service->hero->image ? 'col-12 col-lg-6' : 'col-lg-9 offset-lg-1' }}">
          <div class="heading-section mb-40">
            <div class="sub-title body-2 fw-7 mb-17 title-animation">
              {{ $service->category->name }}
            </div>
            <h2 class="title fw-6 title-animation" style="line-height:1.2;">
              {{ $service->hero->headline }}
            </h2>
          </div>

          @if($service->hero->description)
          <div class="svc-rich-text mb-40 text-animation">
            {!! $service->hero->description !!}
          </div>
          @endif

          @if($service->hero->cta_primary_label || $service->hero->cta_secondary_label)
          <div class="flex flex-wrap align-items-center g-20 title-animation">
            @if($service->hero->cta_primary_label)
            <a href="{{ $service->hero->cta_primary_url ?? route('contact-us') }}" class="tf-btn">
              <span>{{ $service->hero->cta_primary_label }}</span>
              <i class="icon-arrow-right"></i>
            </a>
            @endif
            @if($service->hero->cta_secondary_label)
            <a href="{{ $service->hero->cta_secondary_url ?? route('contact-us') }}" class="tf-btn no-bg text-underline">
              <span>{{ $service->hero->cta_secondary_label }}</span>
              <i class="icon-arrow-right"></i>
            </a>
            @endif
          </div>
          @endif
        </div>

      </div>
    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         2. BENEFITS — clean numbered list, 2 columns
         Inspired by Peiko's service page layout
    ══════════════════════════════════════════ --}}
  @if($service->benefits->isNotEmpty())
  <section class="tf-spacing-2">
    <div class="tf-container">

      @if($service->benefits->first()->section_heading)
      <div class="svc-section-heading">
        <div class="title body-2 fw-7 mb-17 title-animation">
          <h3>
            {{ strtoupper($service->benefits->first()->section_heading) }}
          </h3>
        </div>
        @if($service->benefits->first()->section_subtitle)
        <h2 class="sub-title fw-6 title-animation">
          {{ $service->benefits->first()->section_subtitle }}
        </h2>
        @endif
      </div>
      @endif

      <ul class="svc-numbered-list svc-numbered-list--2col">
        @foreach($service->benefits as $benefit)
        <li class="svc-numbered-item">
          <div class="svc-numbered-item__num">
            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
          </div>
          <div>
            <div class="svc-numbered-item__title title-animation">{{ $benefit->title }}</div>
            @if($benefit->description)
            <div class="svc-numbered-item__desc svc-rich-text text-animation">
              {!! $benefit->description !!}
            </div>
            @endif
          </div>
        </li>
        @endforeach
      </ul>

    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         3. TALK TO US — full-width strip
    ══════════════════════════════════════════ --}}
  @if($service->talkToUs)
  @php $talk = $service->talkToUs; @endphp
  <section class="svc-cta-strip">
    <div class="tf-container">
      <div class="row align-items-center rg-40">

        {{-- Person --}}
        <div class="col-lg-3 col-md-4 text-center">
          @if($talk->person_avatar)
          <img src="{{ asset('storage/' . $talk->person_avatar) }}"
            alt="{{ $talk->person_name }}"
            style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid var(--primary);display:block;margin:0 auto 16px;">
          @else
          <div style="width:100px;height:100px;border-radius:50%;background:rgba(var(--primary-rgb),.15);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:36px;font-weight:700;color:var(--primary);">
            {{ strtoupper(substr($talk->person_name ?? 'T', 0, 1)) }}
          </div>
          @endif
          @if($talk->person_name)
          <div class="fw-7" style="font-size:16px;line-height:1.4;margin-bottom:5px;">{{ $talk->person_name }}</div>
          @endif
          @if($talk->person_role)
          <div style="font-size:13px;line-height:1.5;color:rgba(255,255,255,.45);">{{ $talk->person_role }}</div>
          @endif
        </div>

        {{-- Headline + subtext --}}
        <div class="col-lg-6 col-md-8">
          <h3 class="svc-talk-headline title-animation" style="font-size:clamp(22px,3vw,32px);font-weight:600;line-height:1.35;color:var(--white);margin-bottom:14px;">
            {{ $talk->headline }}
          </h3>
          @if($talk->subtext)
          <p class="text-animation" style="font-size:15px;line-height:1.75;color:rgba(255,255,255,.5);margin:0;">
            {{ $talk->subtext }}
          </p>
          @endif
        </div>

        {{-- CTA --}}
        <div class="col-lg-3 col-12 text-lg-end text-center">
          <a href="{{ $talk->cta_url }}" class="tf-btn">
            <span>{{ $talk->cta_label }}</span>
            <i class="icon-arrow-right"></i>
          </a>
        </div>

      </div>
    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         4. PROCESS STEPS — grid of bordered cells
    ══════════════════════════════════════════ --}}
  @if($service->processSteps->isNotEmpty())
  <section class="tf-spacing-2">
    <div class="tf-container">

      @if($service->processSteps->first()->section_heading)
      <div class="svc-section-heading" style="margin-bottom:48px;">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          <h3>{{ strtoupper($service->processSteps->first()->section_heading) }}</h3>
        </div>
        @if($service->processSteps->first()->section_subtitle)
        <h2 class="title fw-6 title-animation">
          {{ $service->processSteps->first()->section_subtitle }}
        </h2>
        @endif
      </div>
      @endif

      <div class="svc-process-grid">
        @foreach($service->processSteps as $step)
        <div class="svc-process-item">
          <span class="svc-process-item__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
          <div class="svc-process-item__title title-animation">{{ $step->title }}</div>
          @if($step->description)
          <div class="svc-process-item__desc svc-rich-text text-animation">
            {!! $step->description !!}
          </div>
          @endif
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         5. TECH STACK — tag clouds per group
    ══════════════════════════════════════════ --}}
  @if($service->techGroups->isNotEmpty())
  <section class="tf-spacing-2">
    <div class="tf-container">

      @if($service->techGroups->first()->section_heading)
      <div class="svc-section-heading">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          <h3> {{ strtoupper($service->techGroups->first()->section_heading) }}</h3>
        </div>
        @if($service->techGroups->first()->section_subtitle)
        <h2 class="title fw-6 title-animation">
          {{ $service->techGroups->first()->section_subtitle }}
        </h2>
        @endif
      </div>
      @endif

      <div class="row rg-30">
        @foreach($service->techGroups as $group)
        <div class="col-12 col-md-6 col-lg-4">
          <div class="svc-tech-card">
            <div class="svc-group-label">
              <span>{{ $group->group_name }}</span>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:10px;">
              @foreach($group->tags as $tag)
              <span class="svc-tag {{ $tag->is_featured ? 'svc-tag--featured' : 'svc-tag--normal' }} title-animation">
                {{ $tag->name }}
              </span>
              @endforeach
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         6. TESTIMONIALS — 3-col cards
    ══════════════════════════════════════════ --}}
  @if($service->testimonials->isNotEmpty())
  <section class="section-testimonial tf-spacing-2">
    <div class="mask mask-1">
      <svg xmlns="http://www.w3.org/2000/svg" width="700" height="700" fill="none">
        <circle cx="350" cy="350" r="285" stroke="url(#sd2)" stroke-width="130" />
        <defs>
          <linearGradient id="sd2" x1="154" x2="497.875" y1="61.688" y2="589.75">
            <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
            <stop offset="1" stop-color="#fff" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>
    </div>

    <div class="tf-container">

      @if($service->testimonials->first()->section_heading)
      <div class="svc-section-heading">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          <h3> {{ strtoupper($service->testimonials->first()->section_heading) }}</h3>
        </div>
        @if($service->testimonials->first()->section_subtitle)
        <h2 class="title fw-6 title-animation">
          {{ $service->testimonials->first()->section_subtitle }}
        </h2>
        @endif
      </div>
      @endif

      <div class="row rg-30">
        @foreach($service->testimonials as $testimonial)
        <div class="col-xl-4 col-md-6">
          <div class="testimonial-item style-2" style="display:flex;flex-direction:column;height:100%;">
            <div class="top-item">
              <div class="icon"><i class="icon-quote2"></i></div>
              <div class="image-avatar" style="display:flex;align-items:center;justify-content:center;background:rgba(var(--primary-rgb),.15);color:var(--primary);font-weight:700;font-size:22px;width:72px;height:72px;border-radius:50%;flex-shrink:0;">
                {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
              </div>
            </div>
            <div class="mb-20" style="display:flex;gap:5px;">
              @for($i = 1; $i <= 5; $i++)
                <span style="font-size:16px;color:{{ $i <= $testimonial->rating ? '#f5a623' : 'rgba(255,255,255,.15)' }};">★</span>
                @endfor
            </div>
            <div class="text" style="flex:1;font-size:15px;line-height:1.85;color:rgba(255,255,255,.7);">
              "{{ $testimonial->quote }}"
            </div>
            <div style="margin-top:28px;padding-top:20px;border-top:1px solid var(--stroke-2);">
              <span class="name-user body-2 fw-6 d-block">{{ $testimonial->client_name }}</span>
              @if($testimonial->client_role)
              <span class="position text-medium d-block" style="line-height:1.6;margin-top:4px;opacity:.5;">{{ $testimonial->client_role }}</span>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         7. FAQs — accordion left, image right
    ══════════════════════════════════════════ --}}
  @if($service->faqs->isNotEmpty())
  <section class="section-company tf-spacing-2">
    <div class="tf-container w-1810">
      <div class="section-company-inner">

        <div class="left-section">
          @if($service->faqs->first()->section_heading)
          <div class="heading-section mb-53">
            <div class="sub-title body-2 fw-7 mb-17 title-animation">
              <h3> {{ strtoupper($service->faqs->first()->section_heading) }}</h3>
            </div>
            @if($service->faqs->first()->section_subtitle)
            <h2 class="title fw-6 title-animation">
              {{ $service->faqs->first()->section_subtitle }}
            </h2>
            @endif
          </div>
          @endif

          <div class="wg-according" id="serviceFaqs">
            @foreach($service->faqs as $faq)
            <div class="according-item">
              <h5 class="fw-5">
                <a href="#faq-{{ $faq->id }}"
                  data-bs-toggle="collapse"
                  class="title-according {{ $loop->first ? '' : 'collapsed' }}">
                  {{ $faq->question }}<span></span>
                </a>
              </h5>
              <div id="faq-{{ $faq->id }}"
                class="collapse {{ $loop->first ? 'show' : '' }}"
                data-bs-parent="#serviceFaqs">
                <div class="according-content">
                  <div class="right">
                    <div class="svc-rich-text">{!! $faq->answer !!}</div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div class="right-section">
          <div class="image image-section tf-animate-1">
            <img src="{{ asset('image/section/img-section-company.jpg') }}"
              data-src="{{ asset('image/section/img-section-company.jpg') }}"
              alt="" class="lazyload">
          </div>
        </div>

      </div>
    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         8. RELATED SERVICES — theme service cards
    ══════════════════════════════════════════ --}}
  @if($service->relatedServices->isNotEmpty())
  <section class="section-services tf-spacing-2">
    <div class="tf-container">

      @if($service->relatedServices->first()->section_heading)
      <div class="svc-section-heading">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          <h3>{{ strtoupper($service->relatedServices->first()->section_heading) }}</h3>
        </div>
      </div>
      @endif

      <div class="list-services flex flex-wrap">
        @foreach($service->relatedServices as $related)
        @php $rel = $related->relatedService; @endphp
        <div class="services-item px-lg-15 no-img">
          <div class="icon">
            <i class="{{ $rel->category->icon ?? 'icon-custom-software' }}"></i>
          </div>
          <h5 class="lh-30 fw-6">
            <a href="{{ route('services.show', $rel->slug) }}" class="title-service">
              {{ $rel->name }}
            </a>
          </h5>
          @if($rel->short_description)
          <div class="desc" style="line-height:1.75;font-size:15px;">{{ $rel->short_description }}</div>
          @endif
          <div class="bottom-item">
            <a href="{{ route('services.show', $rel->slug) }}" class="tf-btn-readmore">
              <span class="plus">+</span>
              <span class="text">Read More</span>
            </a>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

</div>

@endsection
