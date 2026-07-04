<div class="offcanvas offcanvas-start mobile-nav-wrap" id="canvasMobile">
    <div class="inner-mobile-nav">
        <div class="top-header-mobi">
            <div class="logo-mobile">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('image/logo/logo.png') }}" alt="Logo">
                </a>
            </div>
            <button class="mobile-nav-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" width="20px" height="20px"
                    viewBox="0 0 122.878 122.88">
                    <g>
                        <path
                            d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z">
                        </path>
                    </g>
                </svg>
            </button>
        </div>

        <nav class="mobile-main-nav">
            <ul id="menu-mobile" class="menu">

                <li class="menu-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('about') }}">About Us</a>
                </li>

                {{-- Services — collapsible categories, then services per category --}}
                <li class="menu-item menu-item-has-children-mobile">
                    <a href="#mobile-services" data-bs-toggle="collapse" class="collapsed" role="button"
                        aria-expanded="false" aria-controls="mobile-services">Services</a>
                    <div id="mobile-services" class="collapse" data-bs-parent="#menu-mobile">
                        <ul class="sub-menu-mobile">
                            <li class="menu-item">
                                <a href="{{ route('services') }}">All Services</a>
                            </li>
                        </ul>
                        <ul id="mobile-services-categories" class="sub-menu-mobile sub-menu-mobile--categories">
                            @foreach ($navCategories as $category)
                                <li class="menu-item menu-item-has-children-mobile menu-item-nested">
                                    <a href="#mobile-cat-{{ $category->id }}" data-bs-toggle="collapse"
                                        class="collapsed" role="button" aria-expanded="false"
                                        aria-controls="mobile-cat-{{ $category->id }}">{{ $category->name }}</a>
                                    <div id="mobile-cat-{{ $category->id }}" class="collapse"
                                        data-bs-parent="#mobile-services-categories">
                                        <ul class="sub-menu-mobile sub-menu-mobile--nested">
                                            @foreach ($category->activeServices as $service)
                                                <li class="menu-item">
                                                    <a href="{{ route('services.show', $service->slug) }}">
                                                        {{ $service->name }}
                                                        @if ($service->badge === 'hot')
                                                            <span class="mobile-badge mobile-badge--hot">HOT</span>
                                                        @elseif($service->badge === 'new')
                                                            <span class="mobile-badge mobile-badge--new">NEW</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-has-children-mobile">
                    <a href="#mobile-company" data-bs-toggle="collapse" class="collapsed" role="button"
                        aria-expanded="false" aria-controls="mobile-company">Company</a>
                    <div id="mobile-company" class="collapse" data-bs-parent="#menu-mobile">
                        <ul class="sub-menu-mobile">
                            <li class="menu-item"><a href="{{ route('about') }}">About Us</a></li>
                            <li class="menu-item"><a href="{{ route('career') }}">Career</a></li>
                            {{-- <li class="menu-item"><a href="{{ route('faq') }}">FAQ</a></li> --}}
                            {{-- <li class="menu-item"><a href="{{ route('press') }}">Press</a></li> --}}
                            <li class="menu-item"><a href="{{ route('testimonials') }}">Testimonials</a></li>
                            {{-- <li class="menu-item"><a href="{{ route('awards') }}">Awards</a></li> --}}
                        </ul>
                    </div>
                </li>

                {{-- Technologies — dynamic from DB --}}
                <li class="menu-item menu-item-has-children-mobile">
                    <a href="#mobile-technologies" data-bs-toggle="collapse" class="collapsed" role="button"
                        aria-expanded="false" aria-controls="mobile-technologies">Technologies</a>
                    <div id="mobile-technologies" class="collapse" data-bs-parent="#menu-mobile">
                        <ul class="sub-menu-mobile">
                            @foreach ($navTechnologies as $tech)
                                <li class="menu-item">
                                    <a href="{{ route('tech.show', $tech->slug) }}">{{ $tech->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="menu-item">
                    <a href="{{ route('portfolio') }}">Portfolio</a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('blogs') }}">Blog</a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('contact-us') }}">Contact Us</a>
                </li>

            </ul>

            {{-- Contact info from settings if available --}}
            @php $settings = app(\App\Models\Setting::class)::first(); @endphp
            @if ($settings)
                <div class="contact-mobile">
                    <h5 class="title-contact-mobile">Contact Info</h5>
                    <ul class="mb-20">
                        @if ($settings->company_address)
                            <li class="content-contact-moblile">
                                <i class="icon-location-dot"></i>
                                <a href="#" class="text-medium">{{ $settings->company_address }}</a>
                            </li>
                        @endif
                        @if ($settings->company_email)
                            <li class="content-contact-moblile">
                                <i class="icon-email"></i>
                                <a href="mailto:{{ $settings->company_email }}"
                                    class="text-medium">{{ $settings->company_email }}</a>
                            </li>
                        @endif
                        @if ($settings->company_phone)
                            <li class="content-contact-moblile">
                                <i class="icon-phone"></i>
                                <a href="tel:{{ $settings->company_phone }}"
                                    class="text-medium">{{ $settings->company_phone }}
                                </a>
                            </li>
                        @endif
                    </ul>
                    <ul class="post-social">
                        @if ($settings->site_fb)
                            <li><a href="{{ $settings->site_fb }}" class="icon-social" target="_blank"><i
                                        class="icon-fb"></i></a></li>
                        @endif
                        @if ($settings->site_twitter)
                            <li><a href="{{ $settings->site_twitter }}" class="icon-social" target="_blank"><i
                                        class="icon-X"></i></a></li>
                        @endif
                        @if ($settings->site_linkedin)
                            <li><a href="{{ $settings->site_linkedin }}" class="icon-social" target="_blank"><i
                                        class="icon-linkedin"></i></a></li>
                        @endif
                        @if ($settings->site_youtube)
                            <li><a href="{{ $settings->site_youtube }}" class="icon-social" target="_blank"><i
                                        class="icon-youtube"></i></a></li>
                        @endif
                    </ul>
                </div>
            @endif
        </nav>
    </div>
</div>
