@php $settings = \App\Models\Setting::current(); @endphp

<footer class="footer" id="footer">
  <div class="mask mask-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
      <circle cx="400" cy="400" r="325" stroke="url(#a6)" stroke-width="150" />
      <defs>
        <linearGradient id="a6" x1="176" x2="569" y1="70.5" y2="674">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>
  <div class="mask mask-2">
    <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
      <circle cx="400" cy="400" r="325" stroke="url(#a7)" stroke-width="150" />
      <defs>
        <linearGradient id="a7" x1="176" x2="569" y1="70.5" y2="674">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>
  <div class="footer-inner position-relative">
    <div class="footer-top">
      <div class="tf-marquee">
        <div class="marquee-wrapper">
          <div class="initial-child-container">

            <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
            </div>
            <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
            </div>
            <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
            </div>
            <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
            </div>
            <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
            </div>
            <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tf-container">
      <div class="footer-middle flex justify-content-between">

        <div class="left">
          <div class="footer-logo mb-20">
            <a href="{{ route('home') }}">
              <img src="{{ asset('image/logo/logo.png') }}" alt="Logo"
                style="height: 50px; width: auto;">
            </a>
          </div>

          <p class="text mb-20" style="max-width: 480px; line-height: 1.7;">
            At LonStack, we are committed to delivering excellence through technology. Our team of experts partners with businesses to craft intelligent, reliable, and scalable digital experiences that stand the test of time.
          </p>

          <form class="form-newsletter form-footer">
            <div class="title fs-32 fw-7">
              Subscribe <span class="fw-4">Newsletter</span>
            </div>
          </form>

          <div class="sib-form mb-23">
            <form id="newsletter-form" class="newsletter-form mt-20">
              @csrf
              <div class="newsletter-form__row">
                <div class="newsletter-form__field">
                  <i class="icon-email newsletter-form__icon"></i>
                  <input type="email" name="email" id="newsletter-email"
                    placeholder="Email Address" required
                    class="newsletter-form__input"
                    autocomplete="email">
                </div>
                <button type="submit" class="tf-btn newsletter-form__btn" id="newsletter-btn">
                  <span>Sign Up</span>
                  <i class="icon-arrow-right"></i>
                </button>
              </div>
              <div id="newsletter-msg" class="newsletter-form__msg" style="display:none;"></div>
            </form>
          </div>

          <p class="text">
            By subscribing, you're accept <a href="{{route('privacy-policy')}}" class="fw-7">Privacy Policy</a>
          </p>
        </div>

        <div class="footer-content footer-col-block">
          <div class="title-mobile footer-col-heading">
            Services
            <i class="icon-angle-down"></i>
          </div>
          <div class="tf-collapse-content" style="display: unset;">
            <ul>
              <li class="support-item-footer"><a href="{{ route('services.show', 'blockchain-development') }}">Blockchain
                  Development</a></li>
              <li class="support-item-footer"><a href="{{ route('services.show', 'web3-development') }}">Web3
                  Development</a></li>
              <li class="support-item-footer"><a href="{{ route('services.show', 'mobile-app-development') }}">Mobile App
                  Development</a></li>
              <li class="support-item-footer"><a href="{{ route('services.show', 'custom-software-development') }}">Custom
                  Software</a></li>
              <li class="support-item-footer"><a href="{{ route('services.show', 'ai-development') }}">AI
                  Development</a></li>
              <li class="support-item-footer"><a href="{{ route('services.show', 'ux-ui-design') }}">UX/UI Design</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="locations-contact">
          <div class="locations-footer item mb-30">
            <div class="title footer-col-heading">Locations</div>
            @if($settings->company_address)
            <div class="address body-2 lh-30">
              {{ $settings->company_address }}
            </div>
            @endif
          </div>
          <div class="contact-footer item">
            <div class="title footer-col-heading">Contact</div>
            <div>
              @if($settings->company_email)
              <h6><a href="mailto:{{ $settings->company_email }}" class="fw-5">{{ $settings->company_email }}</a></h6>
              @endif
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="tf-container">
      <div class="footer-bottom">
        <div class="line"></div>
        <a href="javascript:void(0)" class="footer-go-top">
          <i class="icon-arrow-up"></i>
        </a>
        <div class="list-bottom flex align-items-center justify-content-between flex-wrap rg-15 g-30">
          <span class="text-center lh-30">
            © {{ date('Y') }} <a href="#" class="fw-7">LonStack</a> - IT Services. All rights
            reserved.
          </span>
          <ul class="flex align-items-center justify-content-center flex-wrap rg-15">
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
            <li><a href="{{ route('terms-of-service') }}">Terms</a></li>
            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>

@push('scripts')
<script>
  document.getElementById('newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const btn = document.getElementById('newsletter-btn');
    const msg = document.getElementById('newsletter-msg');
    const email = document.getElementById('newsletter-email').value;

    btn.disabled = true;
    btn.querySelector('span').textContent = 'Sending...';
    msg.style.display = 'none';

    fetch('{{ route("newsletter.subscribe") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          email: email
        }),
      })
      .then(r => r.json())
      .then(data => {
        msg.style.display = 'block';
        if (data.success) {
          msg.style.color = '#43baff';
          msg.textContent = data.message;
          form.reset();
        } else {
          msg.style.color = '#ff6b6b';
          msg.textContent = data.message || 'Something went wrong. Please try again.';
        }
      })
      .catch(() => {
        msg.style.display = 'block';
        msg.style.color = '#ff6b6b';
        msg.textContent = 'Something went wrong. Please try again.';
      })
      .finally(() => {
        btn.disabled = false;
        btn.querySelector('span').textContent = 'Sign Up';
      });
  });
</script>
@endpush
