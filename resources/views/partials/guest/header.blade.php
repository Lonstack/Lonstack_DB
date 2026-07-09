<header class="header header-sticky" id="header">
  <div class="header-content flex justify-content-between align-items-center">
    <div class="header-left flex align-items-center">
      <div class="logo logo-header">
        <a href="{{ route('home') }}">
          <img src="{{ asset('image/logo/logo.png') }}" alt="Logo">
        </a>
      </div>
      <nav class="main-menu">
        <ul class="menu-primary-menu">

          {{-- ── SERVICES — dynamic from DB ── --}}
          <li class="menu-item menu-item-has-children position-relative">
            <a href="{{ route('services') }}" class="item-link body-2"><span>Services</span></a>

            <div class="sub-menu sub-menu-large">
              <div class="mega-menu-inner">

                {{-- Left sidebar: category list --}}
                <div class="mega-menu-sidebar">
                  <ul class="mega-menu-categories">
                    @foreach ($navCategories as $index => $category)
                    <li class="mega-cat-item {{ $index === 0 ? 'active' : '' }}"
                      data-tab="cat-{{ $category->id }}">
                      <span>{{ $category->name }}</span>
                      <i class="icon-arrow-right"></i>
                    </li>
                    @endforeach
                  </ul>
                </div>

                {{-- Right content: services per category --}}
                <div class="mega-menu-content">
                  @foreach ($navCategories as $index => $category)
                  <div class="mega-tab {{ $index === 0 ? 'active' : '' }}"
                    id="cat-{{ $category->id }}">
                    <div class="header-desktop--services-list">
                      @foreach ($category->activeServices as $service)
                      <a href="{{ route('services.show', $service->slug) }}"
                        class="mega-service-item">
                        <div class="mega-service-text">
                          <span class="mega-service-title">
                            {{ $service->name }}
                            @if ($service->badge === 'hot')
                            <span class="badge-hot">HOT 🔥</span>
                            @elseif($service->badge === 'new')
                            <span class="badge-new">NEW</span>
                            @endif
                          </span>
                          <span class="mega-service-desc">
                            {{ $service->short_description }}
                          </span>
                        </div>
                      </a>
                      @endforeach
                    </div>
                  </div>
                  @endforeach
                </div>

              </div>
            </div>
          </li>

          {{-- ── COMPANY ── --}}
          <li class="menu-item menu-item-has-children position-relative">
            <a href="javascript:void(0)" class="item-link body-2"><span>Company</span></a>

            <div class="sub-menu sub-menu-large">
              <div class="mega-menu-inner">
                <div class="mega-menu-sidebar mega-menu-sidebar--awards">
                  <div class="awards-grid">

                    <div class="award-item">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 80" width="100%"
                        height="100%">
                        <rect width="120" height="80" rx="8" fill="#1a1f2e" />
                        <polygon
                          points="60,14 65,30 82,30 68,40 73,56 60,46 47,56 52,40 38,30 55,30"
                          fill="#f59e0b" opacity="0.9" />
                        <rect x="20" y="62" width="80" height="5" rx="2.5"
                          fill="#374151" />
                        <rect x="30" y="70" width="60" height="4" rx="2"
                          fill="#2d3748" />
                      </svg>
                    </div>

                    <div class="award-item">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 80" width="100%"
                        height="100%">
                        <rect width="120" height="80" rx="8" fill="#1a1f2e" />
                        <circle cx="60" cy="32" r="16" fill="none"
                          stroke="#3b82f6" stroke-width="2.5" />
                        <polygon
                          points="60,20 63,28 72,28 65,33 68,42 60,37 52,42 55,33 48,28 57,28"
                          fill="#3b82f6" />
                        <rect x="20" y="56" width="80" height="5" rx="2.5"
                          fill="#374151" />
                        <rect x="30" y="64" width="60" height="4" rx="2"
                          fill="#2d3748" />
                        <rect x="42" y="70" width="36" height="4" rx="2"
                          fill="#2d3748" />
                      </svg>
                    </div>

                    <div class="award-item">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 80" width="100%"
                        height="100%">
                        <rect width="120" height="80" rx="8" fill="#1a1f2e" />
                        <rect x="44" y="14" width="32" height="32" rx="4"
                          fill="none" stroke="#10b981" stroke-width="2" />
                        <polyline points="50,30 57,37 70,24" fill="none" stroke="#10b981"
                          stroke-width="2.5" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <rect x="20" y="56" width="80" height="5" rx="2.5"
                          fill="#374151" />
                        <rect x="30" y="64" width="60" height="4" rx="2"
                          fill="#2d3748" />
                        <rect x="42" y="70" width="36" height="4" rx="2"
                          fill="#2d3748" />
                      </svg>
                    </div>

                    <div class="award-item">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 80"
                        width="100%" height="100%">
                        <rect width="120" height="80" rx="8" fill="#1a1f2e" />
                        <path d="M60 14 L74 22 L74 38 L60 46 L46 38 L46 22 Z" fill="none"
                          stroke="#a78bfa" stroke-width="2.2" />
                        <path d="M60 20 L70 26 L70 36 L60 42 L50 36 L50 26 Z" fill="#a78bfa"
                          opacity="0.15" />
                        <text x="60" y="34" text-anchor="middle" font-size="10"
                          font-weight="bold" fill="#a78bfa"
                          font-family="sans-serif">1st</text>
                        <rect x="20" y="56" width="80" height="5" rx="2.5"
                          fill="#374151" />
                        <rect x="30" y="64" width="60" height="4" rx="2"
                          fill="#2d3748" />
                        <rect x="42" y="70" width="36" height="4" rx="2"
                          fill="#2d3748" />
                      </svg>
                    </div>

                  </div>
                </div>
                <div class="mega-menu-content">
                  <div class="header-desktop--services-list">
                    <a href="{{ route('about') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-building"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">About Us</span>
                        <span class="mega-service-desc">Learn who we are, what we do, and why
                          clients trust us</span>
                      </div>
                    </a>
                    <a href="{{ route('career') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-briefcase"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">Career</span>
                        <span class="mega-service-desc">We are looking for a soulmate, not just
                          an employee</span>
                      </div>
                    </a>
                    {{-- <a href="{{ route('faq') }}" class="mega-service-item">
                    <div class="mega-service-icon"><i class="ti ti-message-question"></i>
                    </div>
                    <div class="mega-service-text">
                      <span class="mega-service-title">FAQ</span>
                      <span class="mega-service-desc">Answers to the most frequently asked
                        questions</span>
                    </div>
                    </a> --}}
                    {{-- <a href="{{ route('press') }}" class="mega-service-item">
                    <div class="mega-service-icon"><i class="ti ti-news"></i></div>
                    <div class="mega-service-text">
                      <span class="mega-service-title">Press</span>
                      <span class="mega-service-desc">Media features, interviews and industry
                        coverage</span>
                    </div>
                    </a> --}}
                    <a href="{{ route('testimonials') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-quote"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">Testimonials</span>
                        <span class="mega-service-desc">See what our clients say about working
                          with us</span>
                      </div>
                    </a>
                    {{-- <a href="{{ route('awards') }}" class="mega-service-item">
                    <div class="mega-service-icon"><i class="ti ti-trophy"></i></div>
                    <div class="mega-service-text">
                      <span class="mega-service-title">Awards</span>
                      <span class="mega-service-desc">World-renowned awards we have earned
                        over the years</span>
                    </div>
                    </a> --}}
                  </div>
                </div>
              </div>
            </div>
          </li>

          {{-- ── TECHNOLOGIES ── --}}
          <li class="menu-item menu-item-has-children position-relative">
            <a href="javascript:void(0)" class="item-link body-2"><span>Technologies</span></a>

            <div class="sub-menu sub-menu-large">
              <div class="mega-menu-inner">
                <div class="mega-menu-sidebar mega-menu-sidebar--promo">
                  <div class="promo-card">
                    <div class="promo-card-image">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 180"
                        width="100%" height="180"
                        style="border-radius:8px;display:block;">
                        <rect width="320" height="180" fill="#0d1f2d" />
                        <!-- Grid lines -->
                        <line x1="0" y1="45" x2="320" y2="45" stroke="rgba(67,186,255,0.06)" stroke-width="1" />
                        <line x1="0" y1="90" x2="320" y2="90" stroke="rgba(67,186,255,0.06)" stroke-width="1" />
                        <line x1="0" y1="135" x2="320" y2="135" stroke="rgba(67,186,255,0.06)" stroke-width="1" />
                        <line x1="80" y1="0" x2="80" y2="180" stroke="rgba(67,186,255,0.06)" stroke-width="1" />
                        <line x1="160" y1="0" x2="160" y2="180" stroke="rgba(67,186,255,0.06)" stroke-width="1" />
                        <line x1="240" y1="0" x2="240" y2="180" stroke="rgba(67,186,255,0.06)" stroke-width="1" />
                        <!-- Tech stack pill chips -->
                        <rect x="16" y="18" width="64" height="22" rx="11" fill="rgba(67,186,255,0.12)" stroke="rgba(67,186,255,0.3)" stroke-width="1" />
                        <text x="48" y="33" font-size="9" font-weight="700" text-anchor="middle" fill="#43baff" font-family="system-ui,sans-serif">React</text>
                        <rect x="90" y="18" width="64" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="122" y="33" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">Laravel</text>
                        <rect x="164" y="18" width="64" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="196" y="33" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">Node.js</text>
                        <rect x="238" y="18" width="66" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="271" y="33" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">Python</text>
                        <!-- Row 2 -->
                        <rect x="16" y="50" width="74" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="53" y="65" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">Next.js</text>
                        <rect x="100" y="50" width="64" height="22" rx="11" fill="rgba(99,102,241,0.2)" stroke="rgba(99,102,241,0.4)" stroke-width="1" />
                        <text x="132" y="65" font-size="9" font-weight="700" text-anchor="middle" fill="#818cf8" font-family="system-ui,sans-serif">Solidity</text>
                        <rect x="174" y="50" width="74" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="211" y="65" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">Docker</text>
                        <rect x="258" y="50" width="46" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="281" y="65" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">Rust</text>
                        <!-- Row 3 -->
                        <rect x="16" y="82" width="56" height="22" rx="11" fill="rgba(16,185,129,0.15)" stroke="rgba(16,185,129,0.35)" stroke-width="1" />
                        <text x="44" y="97" font-size="9" font-weight="700" text-anchor="middle" fill="#34d399" font-family="system-ui,sans-serif">AWS</text>
                        <rect x="82" y="82" width="74" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="119" y="97" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">Flutter</text>
                        <rect x="166" y="82" width="80" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="206" y="97" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">MongoDB</text>
                        <rect x="256" y="82" width="48" height="22" rx="11" fill="rgba(67,186,255,0.07)" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="280" y="97" font-size="9" font-weight="600" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="system-ui,sans-serif">Vue</text>
                        <!-- Divider -->
                        <line x1="16" y1="120" x2="304" y2="120" stroke="rgba(255,255,255,0.06)" stroke-width="1" />
                        <!-- Code lines -->
                        <rect x="16" y="130" width="40" height="5" rx="2.5" fill="rgba(67,186,255,0.4)" />
                        <rect x="62" y="130" width="80" height="5" rx="2.5" fill="rgba(255,255,255,0.12)" />
                        <rect x="16" y="142" width="24" height="5" rx="2.5" fill="rgba(99,102,241,0.5)" />
                        <rect x="46" y="142" width="100" height="5" rx="2.5" fill="rgba(255,255,255,0.08)" />
                        <rect x="16" y="154" width="56" height="5" rx="2.5" fill="rgba(16,185,129,0.4)" />
                        <rect x="78" y="154" width="60" height="5" rx="2.5" fill="rgba(255,255,255,0.08)" />
                        <!-- Accent dot -->
                        <circle cx="296" cy="155" r="10" fill="rgba(67,186,255,0.15)" stroke="rgba(67,186,255,0.4)" stroke-width="1" />
                        <text x="296" y="160" font-size="11" font-weight="800" text-anchor="middle" fill="#43baff" font-family="system-ui,sans-serif">&lt;/&gt;</text>
                      </svg>
                    </div>
                    <h4 class="promo-card-title">Technologies We Use</h4>
                    <p class="promo-card-desc">From React and Laravel to Solidity and AWS - we build with the right tools for every challenge.</p>
                  </div>
                </div>
                {{-- Technologies — dynamic from DB --}}
                <div class="mega-menu-content">
                  <div class="header-desktop--services-list">
                    @foreach ($navTechnologies as $tech)
                    <a href="{{ route('tech.show', $tech->slug) }}"
                      class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">
                          {{ $tech->name }}
                        </span>
                        @if ($tech->short_description)
                        <span
                          class="mega-service-desc">{{ $tech->short_description }}</span>
                        @endif
                      </div>
                    </a>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </li>

          {{-- ── PORTFOLIO ── --}}
          <li class="menu-item">
            <a href="{{ route('portfolio') }}" class="item-link body-2"><span>Portfolio</span></a>
          </li>

          {{-- ── BLOG ── --}}
          <li class="menu-item">
            <a href="{{ route('blogs') }}" class="item-link body-2"><span>Blog</span></a>
          </li>

          {{-- ── CONTACT ── --}}
          <li class="menu-item">
            <a href="{{ route('contact-us') }}" class="item-link body-2"><span>Contact</span></a>
          </li>

        </ul>
      </nav>
    </div>

    <div class="header-right flex align-items-center">
      <a href="{{ route('contact-us') }}" class="tf-btn style-1">
        <span>Get In Touch</span>
      </a>
      <div class="burger-menu" data-bs-toggle="offcanvas" data-bs-target="#canvasMobile">
        <span></span><span></span><span></span>
      </div>
    </div>
  </div>
</header>
