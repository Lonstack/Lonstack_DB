<div style="border:1px solid var(--stroke-2); border-radius:16px;
            padding:30px 26px; display:flex; flex-direction:column;
            transition:border-color .3s, background .3s; position:relative; overflow:hidden;"
     onmouseover="this.style.borderColor='rgba(67,186,255,0.35)'; this.style.background='rgba(67,186,255,0.03)'"
     onmouseout="this.style.borderColor='var(--stroke-2)'; this.style.background=''">

  @if ($service->badge)
  <span style="position:absolute; top:18px; right:18px; font-size:11px; font-weight:700;
                padding:3px 10px; border-radius:20px;
                background:{{ $service->badge === 'hot' ? 'rgba(245,158,11,0.15)' : 'rgba(72,187,120,0.15)' }};
                color:{{ $service->badge === 'hot' ? '#f59e0b' : '#48bb78' }};">
    {{ $service->badge_label }}
  </span>
  @endif

  <div style="width:48px; height:48px; border-radius:12px;
              background:rgba(67,186,255,0.1); display:flex;
              align-items:center; justify-content:center; margin-bottom:18px; flex-shrink:0;">
    <i class="{{ $category->icon ?? 'icon-custom-software' }}"
       style="font-size:20px; color:var(--primary);"></i>
  </div>

  <h5 class="fw-6 mb-12" style="font-size:17px; line-height:1.4;">
    <a href="{{ route('services.show', $service->slug) }}" style="color:inherit; text-decoration:none;">
      {{ $service->name }}
    </a>
  </h5>

  @if ($service->short_description)
  <p class="lh-30 mb-20" style="color:rgba(255,255,255,0.55); font-size:14px; flex:1;">
    {{ Str::limit($service->short_description, 100) }}
  </p>
  @endif

  <a href="{{ route('services.show', $service->slug) }}" class="tf-btn-readmore mt-auto">
    <span class="plus">+</span>
    <span class="text">Learn More</span>
  </a>
</div>
