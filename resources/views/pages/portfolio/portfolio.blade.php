@extends('layouts.guest')

@section('content')

<!-- Page-title -->
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title split-text effect-right">PORTFOLIO</h1>
      <div class="breadkcum">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">Portfolio</span>
      </div>
    </div>
  </div>
</div>

<!-- Main-content -->
<div class="main-content tf-spacing-2">

  @if ($portfolios->isEmpty() && $services->isEmpty())
  <div class="tf-container">
    <div class="text-center py-5 text-muted">
      <p>No portfolio items available yet.</p>
    </div>
  </div>
  @else

  {{-- Tab navigation --}}
  <div class="tf-container">
    <div class="flat-animate-tab mb-70">
      <div class="wg-tab style-2">
        <ul class="tab-product" role="tablist">
          <li class="nav-tab-item" role="presentation">
            <a href="#tab-all" data-bs-toggle="tab" role="tab"
              class="active fw-5 body-2 portfolio-tab"
              data-service="">Show All</a>
          </li>
          @foreach ($services as $service)
          <li class="nav-tab-item" role="presentation">
            <a href="#tab-{{ $service->id }}" data-bs-toggle="tab" role="tab"
              class="fw-5 body-2 portfolio-tab"
              data-service="{{ $service->id }}">{{ $service->name }}</a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="flat-animate-tab">
    <div class="tab-content">

      {{-- Show All tab — server-rendered first 6 --}}
      <div class="tab-pane active show" id="tab-all" role="tabpanel">
        <div class="tf-container">
          {{-- Cards grid --}}
          <div class="row rg-70" id="grid-all">
            @foreach ($portfolios as $p)
            <div class="col-sm-6 portfolio-card">
              <div class="project-gird-item project-item">
                <a href="{{ route('portfolio-details', $p->slug) }}" class="related-project-img-wrap">
                  @if ($p->cover_image)
                  <img src="{{ asset('storage/' . $p->cover_image) }}"
                    data-src="{{ asset('storage/' . $p->cover_image) }}"
                    alt="{{ $p->title }}" class="lazyload related-project-img"
                    style="height:320px;">
                  @else
                  <img src="{{ asset('image/project-item/project-item-2.jpg') }}"
                    data-src="{{ asset('image/project-item/project-item-2.jpg') }}"
                    alt="{{ $p->title }}" class="lazyload related-project-img"
                    style="height:320px;">
                  @endif
                  @if($p->service)
                  <span class="related-project-badge">{{ $p->service->name }}</span>
                  @endif
                </a>
                <div class="related-project-content item-content">
                  <h3 class="title-project related-project-title">
                    <a href="{{ route('portfolio-details', $p->slug) }}">{{ $p->title }}</a>
                  </h3>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          {{-- Prev / Next navigation --}}
          <div class="portfolio-nav d-flex justify-content-between align-items-center mt-60"
            id="nav-all"
            data-grid="grid-all"
            data-service=""
            data-current="{{ $portfolios->currentPage() }}"
            data-last="{{ $portfolios->lastPage() }}">
            <a class="arrow-btn style-border w-50 portfolio-prev
                               {{ $portfolios->onFirstPage() ? 'disabled opacity-50 pe-none' : '' }}"
              style="cursor:pointer;">
              <i class="icon-arrow-left2"></i>
            </a>
            <span class="text-muted fs-14">
              Page {{ $portfolios->currentPage() }} of {{ $portfolios->lastPage() }}
            </span>
            <a class="arrow-btn style-border w-50 portfolio-next
                               {{ !$portfolios->hasMorePages() ? 'disabled opacity-50 pe-none' : '' }}"
              style="cursor:pointer;">
              <i class="icon-arrow-right2"></i>
            </a>
          </div>
        </div>
      </div>

      {{-- Per-service tabs — loaded via AJAX on first click --}}
      @foreach ($services as $service)
      <div class="tab-pane" id="tab-{{ $service->id }}" role="tabpanel"
        data-loaded="0" data-service="{{ $service->id }}">
        <div class="tf-container">
          <div class="row rg-70" id="grid-{{ $service->id }}">
            <div class="col-12 text-center py-4 text-muted portfolio-loading">
              <span>Loading...</span>
            </div>
          </div>
          <div class="portfolio-nav d-flex justify-content-between align-items-center mt-60"
            id="nav-{{ $service->id }}"
            data-grid="grid-{{ $service->id }}"
            data-service="{{ $service->id }}"
            data-current="1"
            data-last="1"
            style="display:none !important;">
            <a class="arrow-btn style-border w-50 portfolio-prev disabled opacity-50 pe-none"
              style="cursor:pointer;">
              <i class="icon-arrow-left2"></i>
            </a>
            <span class="page-label text-muted fs-14">Page 1 of 1</span>
            <a class="arrow-btn style-border w-50 portfolio-next disabled opacity-50 pe-none"
              style="cursor:pointer;">
              <i class="icon-arrow-right2"></i>
            </a>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>

  @endif

</div>
<!-- /.main-content -->

@endsection

@push('scripts')
<script>
  const PORTFOLIO_LOAD_URL = "{{ route('portfolio.load') }}";

  // ── Fetch a page and replace the grid ────────────────────────────────────────
  function loadPage(serviceId, page, navEl) {
    var gridId = navEl.dataset.grid;
    var grid = document.getElementById(gridId);

    grid.innerHTML = '<div class="col-12 text-center py-4 text-muted"><span>Loading...</span></div>';

    // Scroll to the top of the tab content area
    var tabContent = grid.closest('.tf-container');
    if (tabContent) {
      var offset = tabContent.getBoundingClientRect().top + window.pageYOffset - 100;
      window.scrollTo({
        top: offset,
        behavior: 'smooth'
      });
    }

    var url = PORTFOLIO_LOAD_URL + '?page=' + page + (serviceId ? '&service_id=' + serviceId : '');

    fetch(url)
      .then(function(r) {
        return r.json();
      })
      .then(function(data) {
        grid.innerHTML = data.html;

        var lastPage = data.lastPage;
        navEl.dataset.current = page;
        navEl.dataset.last = lastPage;

        // Update page label
        var label = navEl.querySelector('.page-label');
        if (label) label.textContent = 'Page ' + page + ' of ' + lastPage;

        // Prev button
        var prevBtn = navEl.querySelector('.portfolio-prev');
        if (page <= 1) {
          prevBtn.classList.add('disabled', 'opacity-50', 'pe-none');
        } else {
          prevBtn.classList.remove('disabled', 'opacity-50', 'pe-none');
        }

        // Next button
        var nextBtn = navEl.querySelector('.portfolio-next');
        if (!data.hasMore) {
          nextBtn.classList.add('disabled', 'opacity-50', 'pe-none');
        } else {
          nextBtn.classList.remove('disabled', 'opacity-50', 'pe-none');
        }

        // Show nav if more than one page
        if (lastPage > 1) {
          navEl.style.removeProperty('display');
        }
      });
  }

  // ── Prev / Next click delegation ─────────────────────────────────────────────
  document.addEventListener('click', function(e) {
    var btn = e.target.closest('.portfolio-prev, .portfolio-next');
    if (!btn) return;

    var navEl = btn.closest('.portfolio-nav');
    var current = parseInt(navEl.dataset.current, 10);
    var last = parseInt(navEl.dataset.last, 10);
    var serviceId = navEl.dataset.service;
    var newPage;

    if (btn.classList.contains('portfolio-prev')) {
      newPage = Math.max(1, current - 1);
    } else {
      newPage = Math.min(last, current + 1);
    }

    if (newPage === current) return;
    loadPage(serviceId, newPage, navEl);
  });

  // ── Load first page of a service tab on first click ───────────────────────────
  document.querySelectorAll('.portfolio-tab').forEach(function(tab) {
    tab.addEventListener('shown.bs.tab', function() {
      var serviceId = this.dataset.service;
      if (!serviceId) return;

      var pane = document.getElementById('tab-' + serviceId);
      if (pane.dataset.loaded === '1') return;
      pane.dataset.loaded = '1';

      var navEl = document.getElementById('nav-' + serviceId);
      loadPage(serviceId, 1, navEl);
    });
  });
</script>
@endpush
