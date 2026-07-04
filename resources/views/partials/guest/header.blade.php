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
                                                <rect width="320" height="180" fill="#1a1f2e" />
                                                <rect x="20" y="20" width="280" height="140" rx="6"
                                                    fill="#242b3d" />
                                                <rect x="36" y="36" width="110" height="8" rx="4"
                                                    fill="#3b82f6" />
                                                <rect x="36" y="52" width="70" height="6" rx="3"
                                                    fill="#374151" />
                                                <rect x="174" y="36" width="110" height="68" rx="6"
                                                    fill="#1e3a5f" />
                                                <polyline points="180,90 200,65 220,78 245,52 268,60 280,48"
                                                    fill="none" stroke="#3b82f6" stroke-width="2.5"
                                                    stroke-linejoin="round" />
                                                <circle cx="268" cy="60" r="3.5" fill="#60a5fa" />
                                                <rect x="36" y="76" width="120" height="28" rx="5"
                                                    fill="#1e3a5f" />
                                                <rect x="46" y="83" width="40" height="5" rx="2.5"
                                                    fill="#3b82f6" />
                                                <rect x="46" y="92" width="60" height="4" rx="2"
                                                    fill="#374151" />
                                                <rect x="36" y="112" width="248" height="1" fill="#2d3748" />
                                                <rect x="36" y="122" width="55" height="6" rx="3"
                                                    fill="#374151" />
                                                <rect x="36" y="132" width="40" height="6" rx="3"
                                                    fill="#374151" />
                                                <rect x="240" y="118" width="44" height="18" rx="4"
                                                    fill="#3b82f6" />
                                                <rect x="248" y="124" width="28" height="6" rx="3"
                                                    fill="#fff" opacity="0.9" />
                                            </svg>
                                        </div>
                                        <h4 class="promo-card-title">CEX White-Label Solution</h4>
                                        <p class="promo-card-desc">Launch your own branded crypto exchange with our
                                            white-label solution. Secure, scalable, and customizable.</p>
                                        <a href="{{ route('services') }}" class="promo-card-btn">
                                            <span>Learn More</span><i class="ti ti-arrow-up-right"></i>
                                        </a>
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
