{{--
  Shared service card partial.
  Variables: $service (Service), $category (ServiceCategory)
  Used in both the "All" tab and per-category tabs.
  height:100% + flex-direction:column keeps all cards same height in a row grid.
--}}
<div style="border:1px solid var(--stroke-2); border-radius:16px;
            padding:32px 28px; height:100%;
            display:flex; flex-direction:column;
            transition:border-color .3s, background .3s;
            position:relative; overflow:hidden;"
     onmouseover="this.style.borderColor='rgba(67,186,255,0.35)'; this.style.background='rgba(67,186,255,0.03)'"
     onmouseout="this.style.borderColor='var(--stroke-2)'; this.style.background=''">

  {{-- Badge (absolute top-right) --}}
  @if ($service->badge)
  <span style="position:absolute; top:18px; right:18px;
               font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px;
               background:{{ $service->badge === 'hot' ? 'rgba(245,158,11,0.15)' : 'rgba(72,187,120,0.15)' }};
               color:{{ $service->badge === 'hot' ? '#f59e0b' : '#48bb78' }};">
    {{ $service->badge_label }}
  </span>
  @endif

  {{-- Icon --}}
  <div style="width:50px; height:50px; border-radius:12px; flex-shrink:0;
              background:rgba(67,186,255,0.1); display:flex;
              align-items:center; justify-content:center; margin-bottom:20px;">
    <i class="{{ $category->icon ?? 'icon-custom-software' }}"
       style="font-size:20px; color:var(--primary);"></i>
  </div>

  {{-- Title — fixed font size + line-height --}}
  <h5 style="font-size:17px; font-weight:600; line-height:1.4;
             margin:0 0 12px; padding-right:{{ $service->badge ? '60px' : '0' }};">
    <a href="{{ route('services.show', $service->slug) }}"
       style="color:inherit; text-decoration:none;">
      {{ $service->name }}
    </a>
  </h5>

  {{-- Description — fixed line-height, flex:1 pushes CTA to bottom --}}
  @if ($service->short_description)
  <p style="font-size:14px; line-height:1.7; margin:0 0 24px; flex:1;
            color:rgba(255,255,255,0.55);">
    {{ Str::limit($service->short_description, 110) }}
  </p>
  @else
  <div style="flex:1;"></div>
  @endif

  {{-- CTA always at bottom --}}
  <a href="{{ route('services.show', $service->slug) }}" class="tf-btn-readmore"
     style="margin-top:auto;">
    <span class="plus">+</span>
    <span class="text">Learn More</span>
  </a>
</div>
