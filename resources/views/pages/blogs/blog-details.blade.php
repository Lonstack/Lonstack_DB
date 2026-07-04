@extends('layouts.guest')
@section('content')

{{-- ── Page Title ── --}}
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title split-text effect-right" style="font-size:clamp(22px,4vw,42px); line-height:1.25; max-width:800px; margin:0 auto;">
        {{ $blog->title }}
      </h1>
      <div class="breadkcum" style="margin-top:16px;">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <a href="{{ route('blogs') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Blog</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">{{ Str::limit($blog->title, 40) }}</span>
      </div>
    </div>
  </div>
</div>

{{-- ── Main content ── --}}
<div class="main-content tf-spacing-2">
  <div class="tf-container">
    <div class="row rg-30">

      {{-- ────────────────────────────────────────
           LEFT: Article
      ──────────────────────────────────────── --}}
      <div class="col-xl-8">

        {{-- Sidebar toggle on tablet --}}
        <button id="filterShop" class="fillter-btn style-fixed d-xl-none">
          <i class="icon-sidebar"></i>
        </button>

        <article class="bd-article">

          {{-- ── Meta bar ── --}}
          <div class="bd-meta">
            @if ($blog->category)
            <a href="#" class="bd-meta__cat">{{ $blog->category->name }}</a>
            @endif
            <span class="bd-meta__dot"></span>
            <span class="bd-meta__date">
              <i class="icon-calendar-days" style="font-size:13px; margin-right:5px;"></i>
              {{ ($blog->published_at ?? $blog->created_at)->format('F d, Y') }}
            </span>
            @if ($blog->author)
            <span class="bd-meta__dot"></span>
            <span class="bd-meta__author">
              <i class="icon-user" style="font-size:13px; margin-right:5px;"></i>
              {{ $blog->author->name }}
            </span>
            @endif
            <span class="bd-meta__dot"></span>
            <span class="bd-meta__comments">
              <i class="icon-message" style="font-size:13px; margin-right:5px;"></i>
              {{ $blog->comments->count() }} comment{{ $blog->comments->count() !== 1 ? 's' : '' }}
            </span>
          </div>

          {{-- ── Featured image ── --}}
          @if ($blog->image)
          <div class="bd-featured-image">
            <img src="{{ asset('storage/' . $blog->image) }}"
              alt="{{ $blog->title }}"
              class="lazyload">
          </div>
          @endif

          {{-- ── Body content ── --}}
          <div class="bd-body">
            {!! $blog->description !!}
          </div>

          {{-- ── Tags + Share ── --}}
          <div class="bd-footer-row">
            @if ($blog->tags)
            <div class="bd-tags">
              <span class="bd-tags__label">Tags</span>
              <div class="tabs-list">
                @foreach (array_map('trim', explode(',', $blog->tags)) as $tag)
                <a href="#" class="tabs-item fw-5">{{ $tag }}</a>
                @endforeach
              </div>
            </div>
            @endif
            <div class="bd-share">
              <span class="bd-share__label">Share</span>
              <ul class="post-social style-radius-50 g-10">
                <li>
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                    target="_blank" rel="noopener" class="icon-social">
                    <i class="icon-fb"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                    target="_blank" rel="noopener" class="icon-social">
                    <i class="icon-X"></i>
                  </a>
                </li>
                <li>
                  <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                    target="_blank" rel="noopener" class="icon-social">
                    <i class="icon-linkedin"></i>
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com"
                    target="_blank" rel="noopener" class="icon-social">
                    <i class="icon-instagram"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          {{-- ── Author card ── --}}
          @if ($blog->author)
          <div class="bd-author-card">
            <div class="bd-author-card__avatar">
              {{ strtoupper(substr($blog->author->name, 0, 1)) }}
            </div>
            <div class="bd-author-card__info">
              <div class="bd-author-card__label">Posted by</div>
              <div class="bd-author-card__name">{{ $blog->author->name }}</div>
            </div>
          </div>
          @endif

          {{-- ── Related posts ── --}}
          @if ($recentBlogs->count())
          <div class="bd-related">
            <h4 class="bd-section-title">You May Also Like</h4>
            <div class="bd-related__grid">
              @foreach ($recentBlogs as $recent)
              <a href="{{ route('blog-details', $recent->slug) }}" class="bd-related-card">
                <div class="bd-related-card__image">
                  @if ($recent->image)
                  <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}" class="lazyload">
                  @else
                  <img src="image/blog/post-list-1.jpg" alt="{{ $recent->title }}" class="lazyload">
                  @endif
                </div>
                <div class="bd-related-card__body">
                  <div class="bd-related-card__date">
                    {{ ($recent->published_at ?? $recent->created_at)->format('M d, Y') }}
                  </div>
                  <div class="bd-related-card__title">{{ Str::limit($recent->title, 55) }}</div>
                </div>
              </a>
              @endforeach
            </div>
          </div>
          @endif

          {{-- ── Comments ── --}}
          <div class="comment" id="comments">
            <h4 class="title">
              Comments ({{ $blog->comments->count() }})
            </h4>

            {{-- Flash success --}}
            @if (session('comment_success'))
            <div class="alert-comment mb-30" style="background:rgba(67,186,255,0.1); border:1px solid rgba(67,186,255,0.3); border-radius:8px; padding:14px 20px; color:#43baff;">
              <i class="icon-check me-2"></i>{{ session('comment_success') }}
            </div>
            @endif

            @forelse ($blog->comments as $comment)
            {{-- Top-level comment --}}
            <div class="comment-item" id="comment-{{ $comment->id }}">
              <div class="comment-content">
                <div class="top">
                  <a href="#" class="name body-2 fw-5">{{ $comment->author_name }}</a>
                  <span class="dot"></span>
                  <div class="date">{{ $comment->created_at->format('M d, Y') }}</div>
                </div>
                <div class="text lh-30">{{ $comment->comment }}</div>
                <button type="button"
                  class="tf-btn no-bg text-medium reply-toggle-btn mt-10"
                  data-target="reply-form-{{ $comment->id }}">
                  <span>Reply</span>
                  <i class="icon-arrow-right"></i>
                </button>
              </div>

              {{-- Inline reply form --}}
              <div id="reply-form-{{ $comment->id }}" class="reply-form mt-20" style="display:none;">
                <div class="reply-form-title">Replying to {{ $comment->author_name }}</div>
                <form action="{{ route('blog.comment.store', $blog->slug) }}" method="POST">
                  @csrf
                  <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                  <div class="reply-inputs">
                    <fieldset>
                      <i class="icon-user"></i>
                      <input type="text" name="name" placeholder="Your Name" required value="{{ old('name') }}">
                    </fieldset>
                    <fieldset>
                      <i class="icon-email"></i>
                      <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}">
                    </fieldset>
                  </div>
                  <div class="reply-textarea">
                    <fieldset>
                      <i class="icon-message"></i>
                      <textarea name="comment" placeholder="Write your reply..." required rows="3">{{ old('comment') }}</textarea>
                    </fieldset>
                  </div>
                  <div class="reply-actions">
                    <button type="submit" class="tf-btn">
                      <span>Post Reply</span>
                      <i class="icon-arrow-right"></i>
                    </button>
                    <button type="button" class="reply-cancel-btn"
                      data-target="reply-form-{{ $comment->id }}">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>

              {{-- Published replies --}}
              @foreach ($comment->publishedReplies as $reply)
              <div class="comment-item reply ms-30 mt-20">
                <div class="comment-content">
                  <div class="top">
                    <a href="#" class="name body-2 fw-5">{{ $reply->author_name }}</a>
                    <span class="dot"></span>
                    <div class="date">{{ $reply->created_at->format('M d, Y') }}</div>
                  </div>
                  <div class="text lh-30">{{ $reply->comment }}</div>
                </div>
              </div>
              @endforeach
            </div>
            @empty
            <p class="lh-30" style="color:rgba(255,255,255,0.5);">No comments yet. Be the first to leave one!</p>
            @endforelse
          </div>

          {{-- ── Comment Form ── --}}
          <form action="{{ route('blog.comment.store', $blog->slug) }}" method="POST"
            class="form-comment write-review px-lg-15" id="comment-form">
            @csrf
            <input type="hidden" name="parent_id" value="">
            <h4 class="title">Leave A Reply</h4>

            @if ($errors->any())
            <div class="mb-20" style="color:#ff6b6b; font-size:14px;">
              @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
              @endforeach
            </div>
            @endif

            <div class="cols g-20 mb-40">
              <fieldset class="item">
                <i class="icon-user"></i>
                <input type="text" name="name" placeholder="Full Name" required
                  value="{{ old('name') }}">
              </fieldset>
              <fieldset class="item">
                <i class="icon-email"></i>
                <input type="email" name="email" placeholder="Email Address" required
                  value="{{ old('email') }}">
              </fieldset>
            </div>
            <fieldset class="mb-40">
              <label class="mb-22 body-2 font-family-2">Message</label>
              <textarea name="comment" placeholder="Write message" required>{{ old('comment') }}</textarea>
            </fieldset>
            <div class="bottom-btn">
              <button type="submit" class="tf-btn">
                <span>Leave A Reply</span>
                <i class="icon-arrow-right"></i>
              </button>
            </div>
          </form>

        </article>

        {{-- Reply toggle JS --}}
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.reply-toggle-btn').forEach(function(btn) {
              btn.addEventListener('click', function() {
                var t = document.getElementById(this.dataset.target);
                if (t) t.style.display = t.style.display === 'none' ? 'block' : 'none';
              });
            });
            document.querySelectorAll('.reply-cancel-btn').forEach(function(btn) {
              btn.addEventListener('click', function() {
                var t = document.getElementById(this.dataset.target);
                if (t) t.style.display = 'none';
              });
            });
          });
        </script>

      </div>
      {{-- /.col --}}

      {{-- ────────────────────────────────────────
           RIGHT: Sidebar
      ──────────────────────────────────────── --}}
      <div class="col-xl-4">
        <div class="tf-sidebar sidebar-filter right">

          <div class="header-fillter flex justify-content-between align-items-center d-xl-none mb-30">
            <h3 class="title">Filter</h3>
            <span class="icon-close close-filter"></span>
          </div>

          {{-- Search --}}
          <div class="sidebar-item sidebar-search">
            <h5 class="title-content fw-5">Search</h5>
            <form action="{{ route('blogs') }}" method="GET" class="form-search-siderbar">
              <fieldset>
                <input type="text" name="q" placeholder="Keywords" value="{{ request('q') }}">
                <button type="submit" class="tf-btn-search">
                  <i class="icon-magnifying-glass"></i>
                </button>
              </fieldset>
            </form>
          </div>

          {{-- Categories --}}
          @if ($categories->count())
          <div class="sidebar-item sidebar-content sidebar-categories mb-40">
            <h5 class="title-content fw-5">Category</h5>
            <ul class="list">
              @foreach ($categories as $cat)
              <li class="item">
                <i class="icon-arrow-right"></i>
                <a href="#" class="body-2 fw-5">
                  {{ $cat->name }}
                  @if ($cat->blogs_count)
                  <span class="text-muted">({{ $cat->blogs_count }})</span>
                  @endif
                </a>
              </li>
              @endforeach
            </ul>
          </div>
          @endif

          {{-- Latest Posts --}}
          @if ($recentBlogs->count())
          <div class="sidebar-item sidebar-content sidebar-recent-posts">
            <h4 class="title-content fw-5">Latest News</h4>
            @foreach ($recentBlogs as $recent)
            <div class="tf-post-list style-small hover-img">
              <a href="{{ route('blog-details', $recent->slug) }}" class="image">
                @if ($recent->image)
                <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}" class="lazyload">
                @else
                <img src="image/blog/post-list-1.jpg" alt="{{ $recent->title }}" class="lazyload">
                @endif
              </a>
              <div class="post-content">
                <div class="post-date">
                  <i class="icon-email"></i>
                  <span>{{ ($recent->published_at ?? $recent->created_at)->format('M d, Y') }}</span>
                </div>
                <a href="{{ route('blog-details', $recent->slug) }}" class="body-2">
                  {{ Str::limit($recent->title, 35) }}
                </a>
              </div>
            </div>
            @endforeach
          </div>
          @endif

          {{-- Tags --}}
          @if ($blog->tags)
          @php $tags = array_map('trim', explode(',', $blog->tags)); @endphp
          <div class="sidebar-item sidebar-tags mb-50">
            <h4 class="title-content fw-5">Tags</h4>
            <div class="tabs-list">
              @foreach ($tags as $tag)
              <a href="#" class="tabs-item fw-5">{{ $tag }}</a>
              @endforeach
            </div>
          </div>
          @endif

          {{-- CTA Banner --}}
          <div class="sidebar-banner box-item">
            <div class="box-content px-sm-15">
              <p class="sub-title">Get A Quote</p>
              <h4 class="title">Looking For Creative Web Designer</h4>
              <a href="{{ route('contact-us') }}" class="tf-btn">
                <span>Hire Me</span>
                <i class="icon-arrow-right"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
      {{-- /.Sidebar --}}

    </div>
  </div>
</div>
@endsection
