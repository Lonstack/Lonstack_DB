@php $settings = \App\Models\Setting::current(); @endphp

<div class="top-bar d-flex">
  <div class="top-bar-inner flex align-items-center justify-content-between">
    <div class="tf-tb-left">
      <ul class="list-topbar-item flex align-items-center">
        @if($settings->company_address)
        <li class="top-bar-item">
          <i class="icon-location-dot"></i>
          <a href="#">{{ $settings->company_address }}</a>
        </li>
        @endif
        @if($settings->company_email)
        <li class="top-bar-item">
          <i class="icon-email"></i>
          <a href="mailto:{{ $settings->company_email }}">{{ $settings->company_email }}</a>
        </li>
        @endif
        {{-- @if($settings->company_phone)
        <li class="top-bar-item">
          <i class="icon-phone"></i>
          <a href="tel:{{ $settings->company_phone }}">{{ $settings->company_phone }}</a>
        </li>
        @endif --}}
      </ul>
    </div>

    <div class="tf-tb-right flex align-items-center"
         style="border-left:1px solid rgba(255,255,255,0.12); padding-left:20px; margin-left:20px; gap:10px;">
      <ul class="post-social">
        @if($settings->site_fb)
        <li><a href="{{ $settings->site_fb }}" target="_blank" class="icon-social"><i class="icon-fb"></i></a></li>
        @endif
        @if($settings->site_twitter)
        <li><a href="{{ $settings->site_twitter }}" target="_blank" class="icon-social"><i class="icon-X"></i></a></li>
        @endif
        @if($settings->site_linkedin)
        <li><a href="{{ $settings->site_linkedin }}" target="_blank" class="icon-social"><i class="icon-linkedin"></i></a></li>
        @endif
        @if($settings->site_youtube)
        <li><a href="{{ $settings->site_youtube }}" target="_blank" class="icon-social"><i class="icon-youtube"></i></a></li>
        @endif
      </ul>
    </div>
  </div>
</div>