<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
  // ─── Main Pages ───────────────────────────────────────────

  public function home()
  {
    $homeBlogs = Blog::with('category')
      ->withCount(['comments' => fn($q) => $q->where('status', 'published')])
      ->where('status', true)
      ->latest('published_at')
      ->take(2)
      ->get();

    $homeTestimonials = \App\Models\Testimonial::visible()->take(6)->get();

    $homePortfolios = Portfolio::with('service')
      ->where('is_active', true)
      ->orderBy('sort_order')
      ->latest()
      ->take(4)
      ->get();

    $homeTeam = \App\Models\Team::active()
      ->orderBy('sort_order')
      ->orderBy('created_at')
      ->get();

    // Home page services — pick one featured (HOT badge first, then random) + up to 7 others
    $allHomeServices = Service::with('category')
      ->where('is_active', true)
      ->orderByRaw("CASE WHEN badge = 'hot' THEN 0 WHEN badge = 'new' THEN 1 ELSE 2 END")
      ->orderBy('sort_order')
      ->take(8)
      ->get();

    $homeFeaturedService = $allHomeServices->first();
    $homeOtherServices   = $allHomeServices->skip(1)->values();

    return view('welcome', compact(
      'homeBlogs',
      'homeTestimonials',
      'homePortfolios',
      'homeTeam',
      'homeFeaturedService',
      'homeOtherServices'
    ));
  }

  public function about()
  {
    $aboutBlogs = \App\Models\Blog::with('category')
      ->withCount(['comments' => fn($q) => $q->where('status', 'published')])
      ->where('status', true)
      ->latest('published_at')
      ->take(2)
      ->get();

    $aboutPortfolios = Portfolio::with('service')
      ->where('is_active', true)
      ->orderBy('sort_order')
      ->latest()
      ->take(4)
      ->get();

    return view('pages.about', compact('aboutBlogs', 'aboutPortfolios'));
  }

  public function services()
  {
    $categories = ServiceCategory::with(['activeServices'])
      ->active()
      ->get();

    $serviceTestimonials = \App\Models\Testimonial::visible()
      ->take(6)
      ->get();

    return view('pages.services', compact('categories', 'serviceTestimonials'));
  }

  public function serviceDetail(string $slug)
  {
    $service = Service::with([
      'category',
      'hero',
      'benefits',
      'talkToUs',
      'processSteps',
      'techGroups.tags',
      'testimonials',
      'faqs',
      'relatedServices.relatedService.category',
    ])
      ->where('slug', $slug)
      ->where('is_active', true)
      ->firstOrFail();

    return view('pages.services.service-detail', compact('service'));
  }

  public function contact()
  {
    return view('pages.contact-us');
  }

  public function terms()
  {
    return view('pages.terms-of-service');
  }

  public function policy()
  {
    return view('pages.privacy-policy');
  }

  // ─── Portfolio ────────────────────────────────────────────

  public function portfolio()
  {
    $services = Service::whereHas('portfolios', fn($q) => $q->where('is_active', true))
      ->orderBy('sort_order')
      ->get();

    $portfolios = Portfolio::with('service')
      ->where('is_active', true)
      ->orderBy('sort_order')
      ->latest()
      ->paginate(6);

    return view('pages.portfolio.portfolio', compact('portfolios', 'services'));
  }

  public function portfolioLoad(\Illuminate\Http\Request $request)
  {
    $serviceId = $request->input('service_id');
    $page      = max(1, (int) $request->input('page', 1));

    $query = Portfolio::with('service')
      ->where('is_active', true)
      ->orderBy('sort_order')
      ->latest();

    if ($serviceId) {
      $query->where('service_id', $serviceId);
    }

    $paginator = $query->paginate(6, ['*'], 'page', $page);

    $html = '';
    foreach ($paginator->items() as $p) {
      $cover = $p->cover_image
        ? asset('storage/' . $p->cover_image)
        : asset('image/project-item/project-item-2.jpg');

      $badge = $p->service ? '<span class="related-project-badge">' . e($p->service->name) . '</span>' : '';

      $html .= '<div class="col-sm-6 portfolio-card">'
        . '<div class="project-gird-item project-item">'
        . '<a href="' . route('portfolio-details', $p->slug) . '" class="related-project-img-wrap">'
        . '<img src="' . $cover . '" data-src="' . $cover . '" alt="' . e($p->title) . '" class="lazyload related-project-img" style="height:320px;">'
        . $badge
        . '</a>'
        . '<div class="related-project-content item-content">'
        . '<h3 class="title-project related-project-title"><a href="' . route('portfolio-details', $p->slug) . '">' . e($p->title) . '</a></h3>'
        . '</div>'
        . '</div>'
        . '</div>';
    }

    return response()->json([
      'html'     => $html,
      'hasMore'  => $paginator->hasMorePages(),
      'lastPage' => $paginator->lastPage(),
    ]);
  }

  public function portfolioDetails(string $slug)
  {
    $portfolio = Portfolio::with('service')
      ->where('slug', $slug)
      ->where('is_active', true)
      ->firstOrFail();

    // Other active portfolios under the same service (excluding current), latest 4
    $related = Portfolio::with('service')
      ->where('service_id', $portfolio->service_id)
      ->where('id', '!=', $portfolio->id)
      ->active()
      ->latest()
      ->take(4)
      ->get();

    // Previous and next items for navigation
    $prev = Portfolio::active()
      ->where('sort_order', '<', $portfolio->sort_order)
      ->orderByDesc('sort_order')
      ->first();

    $next = Portfolio::active()
      ->where('sort_order', '>', $portfolio->sort_order)
      ->orderBy('sort_order')
      ->first();

    return view('pages.portfolio.portfolio-details', compact('portfolio', 'related', 'prev', 'next'));
  }

  // ─── Blog ─────────────────────────────────────────────────

  public function blogs()
  {
    $blogs = Blog::with('category', 'author')
      ->withCount(['comments' => fn($q) => $q->where('status', 'published')])
      ->where('status', true)
      ->latest('published_at')
      ->get();

    $categories = \App\Models\BlogCategory::where('status', true)
      ->withCount(['blogs' => fn($q) => $q->where('status', true)])
      ->get();

    $recentBlogs = Blog::with('category')
      ->where('status', true)
      ->latest('published_at')
      ->take(3)
      ->get();

    return view('pages.blogs.blogs', compact('blogs', 'categories', 'recentBlogs'));
  }

  public function blogDetails($slug)
  {
    $blog = Blog::with([
      'category',
      'author',
      'comments' => fn($q) => $q->whereNull('parent_id')
        ->where('status', 'published')
        ->latest(),
      'comments.publishedReplies',
    ])
      ->where('slug', $slug)
      ->where('status', true)
      ->firstOrFail();

    $blog->increment('views');

    $categories = \App\Models\BlogCategory::where('status', true)
      ->withCount(['blogs' => fn($q) => $q->where('status', true)])
      ->get();

    $recentBlogs = Blog::with('category')
      ->where('status', true)
      ->where('id', '!=', $blog->id)
      ->latest('published_at')
      ->take(3)
      ->get();

    return view('pages.blogs.blog-details', compact('blog', 'categories', 'recentBlogs'));
  }

  // ─── Company ──────────────────────────────────────────────

  public function career()
  {
    $jobs = \App\Models\Career::active()
      ->orderBy('is_featured', 'desc')
      ->orderBy('sort_order')
      ->orderBy('created_at', 'desc')
      ->paginate(6);

    return view('pages.company.career', compact('jobs'));
  }

  public function careerApply(\Illuminate\Http\Request $request)
  {
    $request->validate([
      'name'     => ['required', 'string', 'max:100'],
      'email'    => ['required', 'email', 'max:150'],
      'phone'    => ['required', 'string', 'max:30'],
      'telegram' => ['nullable', 'string', 'max:60'],
      'position' => ['required', 'string', 'max:150'],
      'experience' => ['nullable', 'string', 'max:50'],
      'message'  => ['required', 'string', 'min:20'],
      'cv_file'  => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:8192'],
    ]);

    // Store the uploaded CV if provided
    $cvPath = null;
    if ($request->hasFile('cv_file')) {
      $cvPath = $request->file('cv_file')->store('career-applications', 'public');
    }

    // TODO: send notification email or save to DB
    // \Mail::to(config('mail.from.address'))->send(new \App\Mail\CareerApplicationMail($request->all(), $cvPath));

    return redirect()->route('career')
      ->with('success', 'Thank you for applying! We will get back to you within 24 hours.');
  }

  public function faq()
  {
    return view('pages.company.faq');
  }

  public function press()
  {
    return view('pages.company.press');
  }

  public function testimonials()
  {
    $testimonials = \App\Models\Testimonial::visible()->paginate(6);
    return view('pages.company.testimonials', compact('testimonials'));
  }

  public function awards()
  {
    return view('pages.company.awards');
  }

  // ─── Technologies ─────────────────────────────────────────
  // Dynamic — one method handles all technology pages by slug.
  // Replaces all the old static per-technology methods.

  public function technologyDetail(string $slug)
  {
    $technology = \App\Models\Technology::with([
      'hero',
      'advantages',
      'benefits',
      'whyUs',
      'processes',
      'faqs',
    ])
      ->where('slug', $slug)
      ->where('is_active', true)
      ->firstOrFail();

    // Global tech stack groups for the "Technologies We Use" section
    $techStackGroups = \App\Models\TechStackGroup::with(['activeItems'])
      ->active()
      ->get();

    // All active technologies for the hero orbit bubbles
    $navTechnologies = \App\Models\Technology::active()->get();

    return view('pages.technologies.technology-detail', compact('technology', 'techStackGroups', 'navTechnologies'));
  }
}
