@extends('layouts.guest')

@section('content')

<!-- Page-title -->
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title split-text effect-right">CAREERS</h1>
      <div class="breadkcum">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">Vacancies</span>
      </div>
    </div>
  </div>
</div>
<!-- /.page-title -->

<!-- Main-content -->
<div class="main-content tf-spacing-2">

  <!-- ── Hero Tagline ──────────────────────────────────────── -->
  <div class="tf-container">
    <div class="text-center" style="max-width:720px; margin:0 auto 70px;">
      <h2 class="title fw-7 title-animation" style="font-size:clamp(28px,4vw,48px); line-height:1.25;">
        In Lonstack, we seek
        <em class="fw-3" style="color:var(--primary); font-style:italic;">soulmate</em>
        for the mission, not just
        <em class="fw-3" style="color:var(--primary); font-style:italic;">employee</em> for the position.
      </h2>
    </div>
  </div>

  <!-- ── Open Positions ────────────────────────────────────── -->
  <div class="tf-container">

    @if ($jobs->isNotEmpty())
    <!-- Count label -->
    <div class="sub-title body-2 fw-7 mb-30 title-animation"
      style="letter-spacing:.08em; text-transform:uppercase; color:rgba(255,255,255,0.45);">
      {{ $jobs->total() }} Available position(s){{ $jobs->total() !== 1 ? 's' : '' }}
    </div>

    <!-- Job rows -->
    <div style="border-top:1px solid var(--stroke-2);">
      @foreach ($jobs as $job)
      <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;
                            gap:16px; padding:28px 0; border-bottom:1px solid var(--stroke-2);">

        <!-- Left: title + meta -->
        <div>
          <h4 class="fw-6 mb-10" style="font-size:18px; line-height:1.4;">
            {{ $job->title }}
            @if ($job->is_featured)
            🔥
            @endif
          </h4>
          <div style="display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.45); font-size:13px;">
              <i class="icon-location-dot" style="color:var(--primary); font-size:14px;"></i>
              {{ $job->location }}
            </span>
            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.45); font-size:13px;">
              <i class="icon-briefcase" style="color:var(--primary); font-size:14px;"></i>
              {{ $job->employment_label }}
            </span>
            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.45); font-size:13px;">
              <i class="icon-globe" style="color:var(--primary); font-size:14px;"></i>
              {{ $job->work_type_label }}
            </span>
            @if ($job->experience_level)
            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.45); font-size:13px;">
              <i class="icon-chart-line" style="color:var(--primary); font-size:14px;"></i>
              {{ $job->experience_level }}
            </span>
            @endif
            @if ($job->deadline)
            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.35); font-size:12px;">
              <i class="icon-clock" style="font-size:13px;"></i>
              Closes {{ $job->deadline->format('d M Y') }}
            </span>
            @endif
          </div>
          @if ($job->excerpt)
          <p style="margin-top:8px; font-size:13px; color:rgba(255,255,255,0.4);
                                  line-height:1.6; max-width:560px;">
            {{ $job->excerpt }}
          </p>
          @endif
          @if ($job->tags)
          <div style="display:flex; flex-wrap:wrap; gap:6px; margin-top:10px;">
            @foreach ($job->tags as $tag)
            <span style="font-size:11px; font-weight:600; letter-spacing:.04em;
                                         padding:3px 10px; border-radius:20px;
                                         background:rgba(67,186,255,0.1);
                                         color:var(--primary); border:1px solid rgba(67,186,255,0.2);">
              {{ $tag }}
            </span>
            @endforeach
          </div>
          @endif
        </div>

        <!-- Right: CTA -->
        <a href="#apply-form"
          style="display:inline-flex; align-items:center; gap:8px;
                              font-size:13px; font-weight:700; letter-spacing:.06em;
                              text-transform:uppercase; color:var(--primary);
                              text-decoration:none; white-space:nowrap; flex-shrink:0;">
          APPLY NOW
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"
              stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>

      </div>
      @endforeach
    </div>
    {{-- ── Pagination ── --}}
    @if ($jobs->hasPages())
    <div class="wg-pagination flex justify-content-center" style="gap:12px; margin-top:50px;">

      {{-- Prev --}}
      @if ($jobs->onFirstPage())
      <span class="page-item disabled" style="opacity:0.35; pointer-events:none;">
        <span class="page-link" style="padding:10px 18px; font-size:16px;">&laquo;</span>
      </span>
      @else
      <a href="{{ $jobs->previousPageUrl() }}" class="page-item"
        style="padding:10px 18px; font-size:16px;">&laquo;</a>
      @endif

      {{-- Page numbers --}}
      @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
      @if ($page == $jobs->currentPage())
      <span class="page-item active"
        style="padding:10px 18px; font-size:15px; font-weight:600;">{{ $page }}</span>
      @else
      <a href="{{ $url }}" class="page-item"
        style="padding:10px 18px; font-size:15px;">{{ $page }}</a>
      @endif
      @endforeach

      {{-- Next --}}
      @if ($jobs->hasMorePages())
      <a href="{{ $jobs->nextPageUrl() }}" class="page-item"
        style="padding:10px 18px; font-size:16px;">&raquo;</a>
      @else
      <span class="page-item disabled" style="opacity:0.35; pointer-events:none;">
        <span class="page-link" style="padding:10px 18px; font-size:16px;">&raquo;</span>
      </span>
      @endif

    </div>
    @endif

    @else
    {{-- ── No open positions state ── --}}
    <div style="border:1px solid var(--stroke-2); border-radius:20px;
                        padding:70px 40px; text-align:center; margin-bottom:20px;">

      {{-- Animated icon --}}
      <div style="width:80px; height:80px; border-radius:50%;
                            background:rgba(67,186,255,0.08); border:1px solid rgba(67,186,255,0.2);
                            display:flex; align-items:center; justify-content:center;
                            margin:0 auto 28px;">
        <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
          <path d="M12 18h12M18 12v12" stroke="rgba(67,186,255,0.4)"
            stroke-width="2" stroke-linecap="round" />
          <rect x="2" y="8" width="32" height="22" rx="4"
            stroke="rgba(67,186,255,0.5)" stroke-width="1.5" fill="none" />
          <path d="M12 8V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"
            stroke="rgba(67,186,255,0.5)" stroke-width="1.5"
            stroke-linecap="round" />
        </svg>
      </div>

      <h3 class="fw-6 mb-15" style="font-size:22px;">
        No open positions right now
      </h3>
      <p style="color:rgba(255,255,255,0.45); font-size:15px; line-height:1.8;
                           max-width:480px; margin:0 auto 32px;">
        We're not actively hiring at the moment, but great talent is always welcome.
        Send us your profile and we'll reach out when the right opportunity opens up.
      </p>

      {{-- Bullet points --}}
      <div style="display:inline-flex; flex-direction:column; gap:12px;
                            text-align:left; margin-bottom:36px;">
        @foreach ([
        'Drop your CV and we\'ll keep it on file',
        'We\'ll notify you when a matching role opens',
        'No commitment — just a conversation',
        ] as $point)
        <div style="display:flex; align-items:center; gap:12px;">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0;">
            <circle cx="8" cy="8" r="7" stroke="rgba(67,186,255,0.4)" stroke-width="1.2" />
            <path d="M5 8l2.5 2.5L11 5.5" stroke="var(--primary)"
              stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <span style="font-size:14px; color:rgba(255,255,255,0.55);">{{ $point }}</span>
        </div>
        @endforeach
      </div>

      <br>
      <a href="#" class="tf-btn" data-bs-toggle="modal" data-bs-target="#cvModal" style="margin:0 auto;">
        <span>Submit Your CV</span>
        <i class="icon-arrow-right"></i>
      </a>
    </div>
    @endif

  </div>

  <!-- ── "Haven't found a vacancy?" strip ─────────────────── -->
  @if ($jobs->isNotEmpty())
  <div class="tf-container tf-spacing-3">
    <div class="text-center" style="padding:60px 0; border-top:1px solid var(--stroke-2);
                                            border-bottom:1px solid var(--stroke-2);">
      <p class="body-1 fw-5 mb-20" style="font-size:20px;">
        Haven't found a vacancy but want to join Lonstack?
      </p>
      <a href="#" data-bs-toggle="modal" data-bs-target="#cvModal"
        style="display:inline-flex; align-items:center; gap:8px; font-size:14px; font-weight:700;
                          letter-spacing:.06em; text-transform:uppercase; color:var(--primary);
                          text-decoration:none; border-bottom:1px solid var(--primary); padding-bottom:2px;">
        SUBMIT YOUR CV
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
          <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"
            stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </a>
    </div>
  </div>
  @endif

  <!-- ── Why Join Us ───────────────────────────────────────── -->
  {{-- <div class="tf-container tf-spacing-3">
            <div class="heading-section mb-60 text-center">
                <div class="sub-title body-2 fw-7 mb-17 title-animation">Why Lonstack</div>
                <h2 class="title fw-6 title-animation">
                    A Place Where You <span class="fw-3">Actually Grow</span>
                </h2>
            </div>
            <div class="row rg-30">
                @php
                $perks = [
                    ['icon' => 'icon-rocket',      'title' => 'Exciting Projects',  'desc' => 'Work on real-world blockchain, fintech, and SaaS products that ship to thousands of users.'],
                    ['icon' => 'icon-globe',        'title' => '100% Remote',        'desc' => 'Work from anywhere in the world. We care about output, not office hours.'],
                    ['icon' => 'icon-chart-line',   'title' => 'Career Growth',      'desc' => 'Regular 1-on-1s, clear promotion paths, and a budget for courses and conferences.'],
                    ['icon' => 'icon-users',        'title' => 'Great Team',         'desc' => 'Collaborate with senior engineers who love clean code, good docs, and honest feedback.'],
                    ['icon' => 'icon-clock',        'title' => 'Flexible Hours',     'desc' => 'Async-first culture. Overlap a few hours with the team and own the rest of your day.'],
                    ['icon' => 'icon-shield-check', 'title' => 'Competitive Pay',    'desc' => 'Market-rate salaries reviewed annually, plus performance bonuses for top contributors.'],
                ];
                @endphp
                @foreach ($perks as $perk)
                <div class="col-lg-4 col-md-6">
                    <div style="border:1px solid var(--stroke-2); border-radius:16px; padding:36px 30px; height:100%;">
                        <div style="width:52px; height:52px; border-radius:12px; background:rgba(67,186,255,0.1);
                                    display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                            <i class="{{ $perk['icon'] }}" style="font-size:22px; color:var(--primary);"></i>
</div>
<h5 class="fw-6 mb-12" style="font-size:17px;">{{ $perk['title'] }}</h5>
<p class="lh-30" style="color:rgba(255,255,255,0.55); font-size:14px;">{{ $perk['desc'] }}</p>
</div>
</div>
@endforeach
</div>
</div> --}}

<!-- ── Apply / Work Inquiry — section-form style ─────────── -->
<section id="apply-form" class="section-form tf-spacing-4">
  <div class="section-inner flex">

    <!-- Left panel: image + heading (hidden on mobile) -->
    <div class="left d-none d-lg-block">
      <div class="image tf-animate-1">
        <img src="{{ asset('image/section/img-section-form-1.jpg') }}"
          data-src="{{ asset('image/section/img-section-form-1.jpg') }}"
          alt="Work with Lonstack" class="lazyload">
      </div>
      <div class="section-content section-form-content tf-animate-2">
        <div class="sub-title body-2 fw-7 mb-17">Work Inquiry</div>
        <h2 class="title fw-6">
          Let's Work For your<br>Next Projects?
        </h2>
        <a href="{{ route('contact-us') }}" class="tf-btn style-bg-white hover-bg-main-dark">
          <span>Contact Us</span>
          <i class="icon-arrow-right"></i>
        </a>
      </div>
    </div>

    <!-- Right panel: form -->
    <div class="right">

      @if (session('success'))
      <div style="background:rgba(67,186,255,0.1); border:1px solid var(--primary);
                                border-radius:12px; padding:18px 24px; margin-bottom:30px;
                                display:flex; align-items:center; gap:12px;">
        <svg width="20" height="20" viewBox="0 0 22 22" fill="none">
          <circle cx="11" cy="11" r="10" stroke="var(--primary)" stroke-width="1.5" />
          <path d="M6.5 11l3 3 6-6" stroke="var(--primary)" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span style="color:var(--primary); font-size:14px; font-weight:600;">
          {{ session('success') }}
        </span>
      </div>
      @endif

      <form id="careerForm" class="form-contact-us px-md-15"
        method="POST" action="{{ route('career.apply') }}"
        enctype="multipart/form-data">
        @csrf

        <div class="heading-form text-center">
          <h3 class="title">Apply Now</h3>
          <div class="desc lh-30">Fill out the form below and we'll get back to you within 24 hours</div>
        </div>

        <!-- Row 0: Position applying for -->
        <div class="cols mb-20 g-20">
          <fieldset class="item">
            <input type="text" name="position" id="career_position"
              placeholder="Position you are applying for *" required>
            <i class="icon-briefcase"></i>
          </fieldset>
          <fieldset class="item">
            <input type="text" name="experience" id="career_experience"
              placeholder="Years of experience (e.g. 3 years)">
            <i class="icon-chart-line"></i>
          </fieldset>
        </div>

        <!-- Row 1: Name + Email -->
        <div class="cols mb-20 g-20">
          <fieldset class="item">
            <input type="text" name="name" id="career_name"
              placeholder="Name" required>
            <i class="icon-user"></i>
          </fieldset>
          <fieldset class="item">
            <input type="email" name="email" id="career_email"
              placeholder="Email" required>
            <i class="icon-email"></i>
          </fieldset>
        </div>

        <!-- Row 2: Phone with country code + Telegram -->
        <div class="cols mb-20 g-20">
          <!-- Phone with country-code dropdown -->
          <fieldset class="item" style="position:relative;">
            <div style="display:flex; align-items:stretch; gap:0;">
              <!-- Country code selector -->
              <div class="career-country-wrap" style="position:relative; flex-shrink:0;">
                <button type="button" id="countryBtn"
                  style="display:flex; align-items:center; gap:6px; height:100%;
                                                       padding:0 12px; background:rgba(22, 2, 2, 0.06);
                                                       border:none; border-right:1px solid rgba(255,255,255,0.12);
                                                       border-radius:8px 0 0 8px; cursor:pointer;
                                                       color:inherit; font-size:13px; font-weight:600;
                                                       white-space:nowrap; min-width:90px;">
                  <span id="countryFlag">🇺🇸</span>
                  <span id="countryCode">+1</span>
                  <svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                    <path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
                <!-- Dropdown list -->
                <div id="countryDropdown"
                  style="display:none; position:absolute; top:calc(100% + 4px); left:0;
                                                    background:#0d2535; border:1px solid rgba(255,255,255,0.12);
                                                    border-radius:10px; min-width:200px; max-height:220px;
                                                    overflow-y:auto; z-index:999; box-shadow:0 8px 24px rgba(0,0,0,0.4);">
                  @php
                  $countries = [
                  ['flag'=>'🇺🇸','code'=>'+1', 'name'=>'United States'],
                  ['flag'=>'🇬🇧','code'=>'+44', 'name'=>'United Kingdom'],
                  ['flag'=>'🇳🇬','code'=>'+234', 'name'=>'Nigeria'],
                  ['flag'=>'🇬🇭','code'=>'+233', 'name'=>'Ghana'],
                  ['flag'=>'🇿🇦','code'=>'+27', 'name'=>'South Africa'],
                  ['flag'=>'🇰🇪','code'=>'+254', 'name'=>'Kenya'],
                  ['flag'=>'🇨🇦','code'=>'+1', 'name'=>'Canada'],
                  ['flag'=>'🇦🇺','code'=>'+61', 'name'=>'Australia'],
                  ['flag'=>'🇩🇪','code'=>'+49', 'name'=>'Germany'],
                  ['flag'=>'🇫🇷','code'=>'+33', 'name'=>'France'],
                  ['flag'=>'🇮🇳','code'=>'+91', 'name'=>'India'],
                  ['flag'=>'🇧🇷','code'=>'+55', 'name'=>'Brazil'],
                  ['flag'=>'🇦🇪','code'=>'+971', 'name'=>'UAE'],
                  ['flag'=>'🇸🇬','code'=>'+65', 'name'=>'Singapore'],
                  ['flag'=>'🇵🇱','code'=>'+48', 'name'=>'Poland'],
                  ['flag'=>'🇺🇦','code'=>'+380', 'name'=>'Ukraine'],
                  ];
                  @endphp
                  @foreach ($countries as $c)
                  <div class="country-option"
                    data-flag="{{ $c['flag'] }}" data-code="{{ $c['code'] }}"
                    style="display:flex; align-items:center; gap:10px; padding:10px 14px;
                                                        cursor:pointer; font-size:13px; transition:background .15s;"
                    onmouseover="this.style.background='rgba(67,186,255,0.1)'"
                    onmouseout="this.style.background='transparent'">
                    <span>{{ $c['flag'] }}</span>
                    <span style="color:rgba(255,255,255,0.5);">{{ $c['code'] }}</span>
                    <span>{{ $c['name'] }}</span>
                  </div>
                  @endforeach
                </div>
                <input type="hidden" name="phone_code" id="phoneCode" value="+1">
              </div>
              <!-- Phone number input -->
              <input type="tel" name="phone" id="career_phone"
                placeholder="+1 912 345 678" required
                style="flex:1; border-radius:0 8px 8px 0; padding-left:14px;">
            </div>
          </fieldset>

          <!-- Telegram -->
          <fieldset class="item">
            <input type="text" name="telegram" id="career_telegram"
              placeholder="@username">
            <i class="icon-send" style="font-size:15px;"></i>
          </fieldset>
        </div>

        <!-- Row 3: Budget + How did you hear -->
        <div class="cols mb-20 g-20">
          <!-- Budget dropdown -->
          <div style="flex:1; position:relative;">
            <select name="budget" class="nice-select w-100" tabindex="0">
              <option value="">What is your budget?</option>
              <option value="lt5k">Less than $5,000</option>
              <option value="5k-15k">$5,000 – $15,000</option>
              <option value="15k-50k">$15,000 – $50,000</option>
              <option value="50k-100k">$50,000 – $100,000</option>
              <option value="100k+">$100,000+</option>
              <option value="unsure">Not sure yet</option>
            </select>
          </div>
          <!-- How did you hear -->
          <div style="flex:1; position:relative;">
            <select name="heard_from" class="nice-select w-100" tabindex="0">
              <option value="">How did you hear about us?</option>
              <option value="google">Google / Search Engine</option>
              <option value="linkedin">LinkedIn</option>
              <option value="twitter">Twitter / X</option>
              <option value="social">Facebook / Instagram</option>
              <option value="referral">Referral / Friend</option>
              <option value="blog">Blog / Article</option>
              <option value="other">Other</option>
            </select>
          </div>
        </div>

        <!-- Describe Your Idea textarea -->
        <fieldset class="mb-20">
          <textarea name="message" id="career_message" rows="4"
            placeholder="Describe your idea *" required></textarea>
        </fieldset>

        <!-- File upload (Drag & Drop) -->
        <div class="mb-20">
          <label for="career_file" id="dropZone"
            style="display:flex; align-items:center; gap:16px; cursor:pointer;
                                          border:1px dashed rgba(67,186,255,0.45); border-radius:10px;
                                          padding:20px 22px; transition:border-color .2s, background .2s;
                                          background:rgba(67,186,255,0.07);">
            <div style="width:42px; height:42px; border-radius:10px;
                                            background:rgba(67,186,255,0.1); display:flex;
                                            align-items:center; justify-content:center; flex-shrink:0;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="var(--primary)" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                <polyline points="17 8 12 3 7 8" />
                <line x1="12" y1="3" x2="12" y2="15" />
              </svg>
            </div>
            <div>
              <span style="font-size:14px; font-weight:600;">
                Drag &amp; Drop Your Files or
                <span style="color:var(--primary);">Browse</span>
              </span>
              <p style="font-size:12px; color:rgba(14, 13, 13, 0.4); margin:4px 0 0;">
                You can upload ZIP, PDF, PAGES, DOC, or DOCX up to 8 MB each.
              </p>
            </div>
            <input type="file" id="career_file" name="cv_file"
              accept=".pdf,.doc,.docx,.zip,.pages" style="display:none;">
          </label>
          <p id="file-name-display"
            style="font-size:12px; color:var(--primary); margin-top:6px; display:none;"></p>
        </div>

        <button type="submit" class="tf-btn mx-auto">
          <span>SEND</span>
          <i class="icon-arrow-right"></i>
        </button>

      </form>
    </div>
    <!-- /.right -->

  </div>
</section>
<!-- /.section-form -->

</div>
<!-- /.main-content -->

@push('scripts')
<script>
  (function() {
    // ── File name display ──────────────────────────────────
    var fileInput = document.getElementById('career_file');
    var fileDisplay = document.getElementById('file-name-display');
    var dropZone = document.getElementById('dropZone');

    fileInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        fileDisplay.textContent = '📎 ' + this.files[0].name;
        fileDisplay.style.display = 'block';
      }
    });

    // Drag-over highlight
    dropZone.addEventListener('dragover', function(e) {
      e.preventDefault();
      this.style.borderColor = 'var(--primary)';
      this.style.background = 'rgba(67,186,255,0.05)';
    });
    dropZone.addEventListener('dragleave', function() {
      this.style.borderColor = 'rgba(67,186,255,0.45)';
      this.style.background = 'rgba(67,186,255,0.07)';
    });
    dropZone.addEventListener('drop', function(e) {
      e.preventDefault();
      this.style.borderColor = 'rgba(67,186,255,0.45)';
      this.style.background = 'rgba(67,186,255,0.07)';
      var dt = e.dataTransfer;
      if (dt.files && dt.files[0]) {
        fileInput.files = dt.files;
        fileDisplay.textContent = '📎 ' + dt.files[0].name;
        fileDisplay.style.display = 'block';
      }
    });

    // ── Country code dropdown ──────────────────────────────
    var btn = document.getElementById('countryBtn');
    var dropdown = document.getElementById('countryDropdown');
    var flagEl = document.getElementById('countryFlag');
    var codeEl = document.getElementById('countryCode');
    var codeInput = document.getElementById('phoneCode');

    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });

    document.querySelectorAll('.country-option').forEach(function(opt) {
      opt.addEventListener('click', function() {
        flagEl.textContent = this.dataset.flag;
        codeEl.textContent = this.dataset.code;
        codeInput.value = this.dataset.code;
        dropdown.style.display = 'none';
      });
    });

    document.addEventListener('click', function() {
      dropdown.style.display = 'none';
    });
  })();
</script>
@endpush

{{-- ── CV Upload Modal ── --}}
<div class="modal fade cv-modal" id="cvModal" tabindex="-1" aria-labelledby="cvModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content cv-modal__content">

      {{-- Header --}}
      <div class="cv-modal__header">
        <div class="cv-modal__icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
            <line x1="12" y1="12" x2="12" y2="18" />
            <polyline points="9 15 12 18 15 15" />
          </svg>
        </div>
        <div>
          <h4 class="cv-modal__title" id="cvModalLabel">Submit Your CV</h4>
          <p class="cv-modal__subtitle">We accept PDF, DOC, and DOCX files up to 8 MB</p>
        </div>
        <button type="button" class="cv-modal__close" data-bs-dismiss="modal" aria-label="Close">
          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <line x1="1" y1="1" x2="17" y2="17" />
            <line x1="17" y1="1" x2="1" y2="17" />
          </svg>
        </button>
      </div>

      {{-- Success state (hidden by default) --}}
      <div id="cv-success" class="cv-modal__success" style="display:none;">
        <div class="cv-modal__success-icon">
          <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
            <circle cx="18" cy="18" r="17" stroke="var(--primary)" stroke-width="1.5" />
            <path d="M10 18l5.5 5.5L26 12" stroke="var(--primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <h5 class="cv-modal__success-title">CV Submitted!</h5>
        <p class="cv-modal__success-msg">Thank you! We've received your CV and will reach out when the right opportunity arises.</p>
        <button type="button" class="tf-btn" data-bs-dismiss="modal" style="margin:0 auto;">
          <span>Close</span><i class="icon-arrow-right"></i>
        </button>
      </div>

      {{-- Form --}}
      <form id="cvForm" class="cv-modal__form" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="cv-modal__row">
          <div class="cv-modal__field">
            <label>Full Name <span style="color:var(--primary);">*</span></label>
            <input type="text" name="name" placeholder="Your full name" required>
          </div>
          <div class="cv-modal__field">
            <label>Email Address <span style="color:var(--primary);">*</span></label>
            <input type="email" name="email" placeholder="your@email.com" required>
          </div>
        </div>

        <div class="cv-modal__row">
          <div class="cv-modal__field">
            <label>Phone <span style="color:rgba(255,255,255,0.35);">(optional)</span></label>
            <input type="tel" name="phone" placeholder="+1 234 567 890">
          </div>
          <div class="cv-modal__field">
            <label>Position <span style="color:rgba(255,255,255,0.35);">(optional)</span></label>
            <input type="text" name="position" placeholder="Role you're interested in">
          </div>
        </div>

        <div class="cv-modal__field">
          <label>Cover Note <span style="color:rgba(255,255,255,0.35);">(optional)</span></label>
          <textarea name="message" rows="3" placeholder="Briefly tell us about yourself and what you're looking for..."></textarea>
        </div>

        {{-- Drop zone --}}
        <div class="cv-modal__field">
          <label>Your CV <span style="color:var(--primary);">*</span></label>
          <div id="cvDropZone" class="cv-dropzone">
            <input type="file" id="cvFileInput" name="cv_file" accept=".pdf,.doc,.docx" required style="display:none;">
            <div class="cv-dropzone__inner" id="cvDropInner">
              <div class="cv-dropzone__icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                  <polyline points="17 8 12 3 7 8" />
                  <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
              </div>
              <div class="cv-dropzone__text">
                <span>Drag & drop your CV here or <span class="cv-dropzone__browse">Browse</span></span>
                <small>PDF, DOC, DOCX — max 8 MB</small>
              </div>
            </div>
            <div class="cv-dropzone__preview" id="cvPreview" style="display:none;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
              </svg>
              <span id="cvFileName" class="cv-dropzone__filename"></span>
              <button type="button" id="cvRemoveBtn" class="cv-dropzone__remove">✕</button>
            </div>
          </div>
          <div id="cvFileError" class="cv-modal__error" style="display:none;"></div>
        </div>

        <div id="cvFormError" class="cv-modal__error" style="display:none;"></div>

        <div class="cv-modal__footer">
          <button type="button" class="cv-modal__cancel" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="cvSubmitBtn" class="tf-btn">
            <span>Submit CV</span>
            <i class="icon-arrow-right"></i>
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

@push('styles')
<style>
  /* ── CV Modal ── */
  .cv-modal .modal-dialog {
    max-width: 560px;
  }

  .cv-modal__content {
    background: #19272b;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    overflow: hidden;
    color: #fff;
  }

  .cv-modal__header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 24px 28px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
  }

  .cv-modal__icon {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: rgba(67, 186, 255, 0.12);
    border: 1px solid rgba(67, 186, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .cv-modal__title {
    font-size: 17px;
    font-weight: 700;
    color: #fff;
    margin: 0 0 4px;
  }

  .cv-modal__subtitle {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.4);
    margin: 0;
  }

  .cv-modal__close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    padding: 6px;
    border-radius: 6px;
    line-height: 1;
    transition: color 0.2s;
  }

  .cv-modal__close:hover {
    color: #fff;
  }

  /* Form body */
  .cv-modal__form {
    padding: 24px 28px;
  }

  .cv-modal__row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
  }

  .cv-modal__field {
    display: flex;
    flex-direction: column;
    gap: 7px;
    margin-bottom: 16px;
  }

  .cv-modal__field label {
    font-size: 13px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.7);
  }

  .cv-modal__field input,
  .cv-modal__field textarea {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 14px;
    color: #fff;
    outline: none;
    transition: border-color 0.2s;
    width: 100%;
  }

  .cv-modal__field input:focus,
  .cv-modal__field textarea:focus {
    border-color: rgba(67, 186, 255, 0.5);
  }

  .cv-modal__field textarea {
    resize: vertical;
    min-height: 80px;
  }

  .cv-modal__field input::placeholder,
  .cv-modal__field textarea::placeholder {
    color: rgba(255, 255, 255, 0.25);
  }

  /* Drop zone */
  .cv-dropzone {
    border: 1.5px dashed rgba(67, 186, 255, 0.4);
    border-radius: 12px;
    background: rgba(67, 186, 255, 0.04);
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    overflow: hidden;
  }

  .cv-dropzone:hover,
  .cv-dropzone.drag-over {
    border-color: var(--primary);
    background: rgba(67, 186, 255, 0.08);
  }

  .cv-dropzone__inner {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px 20px;
  }

  .cv-dropzone__icon {
    flex-shrink: 0;
  }

  .cv-dropzone__text {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .cv-dropzone__text span {
    font-size: 14px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.7);
  }

  .cv-dropzone__text small {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.35);
  }

  .cv-dropzone__browse {
    color: var(--primary);
    text-decoration: underline;
    cursor: pointer;
  }

  .cv-dropzone__preview {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    background: rgba(67, 186, 255, 0.06);
  }

  .cv-dropzone__filename {
    flex: 1;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .cv-dropzone__remove {
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    font-size: 16px;
    line-height: 1;
    padding: 0;
    transition: color 0.2s;
  }

  .cv-dropzone__remove:hover {
    color: #ff6b6b;
  }

  .cv-modal__error {
    font-size: 13px;
    color: #ff6b6b;
    margin-top: 6px;
    line-height: 1.5;
  }

  .cv-modal__footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 8px;
  }

  .cv-modal__cancel {
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.45);
    font-size: 14px;
    cursor: pointer;
    padding: 0;
    transition: color 0.2s;
  }

  .cv-modal__cancel:hover {
    color: rgba(255, 255, 255, 0.8);
  }

  /* Success */
  .cv-modal__success {
    padding: 48px 32px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
  }

  .cv-modal__success-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(67, 186, 255, 0.1);
    border: 1px solid rgba(67, 186, 255, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .cv-modal__success-title {
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    margin: 0;
  }

  .cv-modal__success-msg {
    font-size: 14px;
    line-height: 1.7;
    color: rgba(255, 255, 255, 0.55);
    margin: 0;
    max-width: 340px;
  }

  @media (max-width: 575px) {
    .cv-modal__row {
      grid-template-columns: 1fr;
    }

    .cv-modal__form {
      padding: 20px 20px;
    }

    .cv-modal__header {
      padding: 20px 20px 16px;
    }
  }
</style>
@endpush

@push('scripts')
<script>
  (function() {
    const form = document.getElementById('cvForm');
    const dropZone = document.getElementById('cvDropZone');
    const fileInput = document.getElementById('cvFileInput');
    const preview = document.getElementById('cvPreview');
    const inner = document.getElementById('cvDropInner');
    const fileName = document.getElementById('cvFileName');
    const removeBtn = document.getElementById('cvRemoveBtn');
    const fileError = document.getElementById('cvFileError');
    const formError = document.getElementById('cvFormError');
    const submitBtn = document.getElementById('cvSubmitBtn');
    const successDiv = document.getElementById('cv-success');

    // Click on dropzone opens file picker
    dropZone.addEventListener('click', function(e) {
      if (e.target === removeBtn) return;
      fileInput.click();
    });

    // Drag over
    dropZone.addEventListener('dragover', function(e) {
      e.preventDefault();
      dropZone.classList.add('drag-over');
    });
    dropZone.addEventListener('dragleave', function() {
      dropZone.classList.remove('drag-over');
    });
    dropZone.addEventListener('drop', function(e) {
      e.preventDefault();
      dropZone.classList.remove('drag-over');
      const f = e.dataTransfer.files[0];
      if (f) handleFile(f);
    });

    // File selected
    fileInput.addEventListener('change', function() {
      if (this.files[0]) handleFile(this.files[0]);
    });

    function handleFile(f) {
      const allowed = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
      if (!allowed.includes(f.type) && !f.name.match(/\.(pdf|doc|docx)$/i)) {
        showFileError('Only PDF, DOC, or DOCX files are accepted.');
        return;
      }
      if (f.size > 8 * 1024 * 1024) {
        showFileError('File is too large. Maximum size is 8 MB.');
        return;
      }
      fileError.style.display = 'none';
      fileName.textContent = f.name;
      inner.style.display = 'none';
      preview.style.display = 'flex';

      // Create a DataTransfer to assign to the input
      const dt = new DataTransfer();
      dt.items.add(f);
      fileInput.files = dt.files;
    }

    function showFileError(msg) {
      fileError.textContent = msg;
      fileError.style.display = 'block';
      inner.style.display = 'flex';
      preview.style.display = 'none';
      fileInput.value = '';
    }

    // Remove file
    removeBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      fileInput.value = '';
      inner.style.display = 'flex';
      preview.style.display = 'none';
      fileError.style.display = 'none';
    });

    // Reset on modal close
    document.getElementById('cvModal').addEventListener('hidden.bs.modal', function() {
      form.reset();
      inner.style.display = 'flex';
      preview.style.display = 'none';
      fileError.style.display = 'none';
      formError.style.display = 'none';
      form.style.display = '';
      successDiv.style.display = 'none';
      submitBtn.disabled = false;
      submitBtn.querySelector('span').textContent = 'Submit CV';
    });

    // Submit
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      formError.style.display = 'none';

      if (!fileInput.files || !fileInput.files[0]) {
        showFileError('Please attach your CV before submitting.');
        return;
      }

      submitBtn.disabled = true;
      submitBtn.querySelector('span').textContent = 'Submitting...';

      const fd = new FormData(form);

      fetch("{{ route('cv.submit') }}", {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: fd,
        })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            form.style.display = 'none';
            successDiv.style.display = 'flex';
          } else {
            submitBtn.disabled = false;
            submitBtn.querySelector('span').textContent = 'Submit CV';
            formError.textContent = data.message || 'Something went wrong. Please try again.';
            formError.style.display = 'block';
          }
        })
        .catch(() => {
          submitBtn.disabled = false;
          submitBtn.querySelector('span').textContent = 'Submit CV';
          formError.textContent = 'Network error. Please check your connection and try again.';
          formError.style.display = 'block';
        });
    });
  })();
</script>
@endpush

@endsection
