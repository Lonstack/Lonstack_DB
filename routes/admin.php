<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceBenefitController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceDetailController;
use App\Http\Controllers\Admin\ServiceFaqController;
use App\Http\Controllers\Admin\ServiceHeroController;
use App\Http\Controllers\Admin\ServiceProcessController;
use App\Http\Controllers\Admin\ServiceRelatedController;
use App\Http\Controllers\Admin\ServiceTalkToUsController;
use App\Http\Controllers\Admin\ServiceTechGroupController;
use App\Http\Controllers\Admin\ServiceTechTagController;
use App\Http\Controllers\Admin\ServiceTestimonialController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TechStackGroupController;
use App\Http\Controllers\Admin\TechStackItemController;
use App\Http\Controllers\Admin\TechnologyAdvantageController;
use App\Http\Controllers\Admin\TechnologyBenefitController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TechnologyDetailController;
use App\Http\Controllers\Admin\TechnologyFaqController;
use App\Http\Controllers\Admin\TechnologyHeroController;
use App\Http\Controllers\Admin\TechnologyProcessController;
use App\Http\Controllers\Admin\TechnologyWhyUsController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CvSubmissionController as AdminCvSubmissionController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;

// ADMIN ROUTES
Route::prefix('admin')
  ->name('admin.')
  ->middleware('auth', 'can:access-admin-dashboard')
  ->group(function () {

    // ── Dashboard ──
    Route::get('dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('dashboard');

    // ── Profile ──
    Route::prefix('profile')
      ->name('profile.')
      ->controller(ProfileController::class)
      ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/', 'update')->name('update');
        Route::patch('/password', 'updatePassword')->name('password');
      });

    // ── Settings ──
    Route::prefix('settings')
      ->name('settings.')
      ->controller(SettingsController::class)
      ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
      });

    // ── Blog Categories ──
    Route::get('blog/manage-categories', [BlogCategoryController::class, 'index'])->name('blog.manage-categories');
    Route::get('blog/manage-categories/search', [BlogCategoryController::class, 'search'])->name('blog.categories.search');
    Route::post('blog/manage-categories', [BlogCategoryController::class, 'store'])->name('blog.categories.store');
    Route::put('blog/manage-categories/{blogCategory}', [BlogCategoryController::class, 'update'])->name('blog.categories.update');
    Route::delete('blog/manage-categories/{blogCategory}', [BlogCategoryController::class, 'destroy'])->name('blog.categories.destroy');

    // ── Blog Comments ──
    Route::get('blog/comments', [BlogCommentController::class, 'index'])->name('blog.comments');
    Route::get('blog/comments/search', [BlogCommentController::class, 'search'])->name('blog.comments.search');
    Route::patch('blog/comments/{blogComment}/status', [BlogCommentController::class, 'updateStatus'])->name('blog.comments.status');
    Route::delete('blog/comments/{blogComment}', [BlogCommentController::class, 'destroy'])->name('blog.comments.destroy');

    // ── Blog Posts ──
    // Static routes before {blog} wildcard to avoid conflicts
    Route::get('blog/all', [BlogController::class, 'index'])->name('blog.all');
    Route::get('blog/search', [BlogController::class, 'search'])->name('blog.search');
    Route::post('blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
    Route::put('blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');

    // ── Testimonials (global, not service-specific) ──
    Route::get('testimonial/all', [TestimonialController::class, 'index'])->name('testimonial.all');
    Route::post('testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::put('testimonial/{testimonial}', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::delete('testimonial/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');
    Route::patch('testimonial/{testimonial}/status', [TestimonialController::class, 'toggleStatus'])->name('testimonial.status');

    // ── Services ──
    Route::prefix('services')
      ->name('services.')
      ->group(function () {

        // Service Categories
        Route::resource('categories', ServiceCategoryController::class)
          ->only(['index', 'store', 'update', 'destroy'])
          ->parameters(['categories' => 'serviceCategory']);

        // Services list — explicit routes (avoids empty-string resource conflicts)
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::patch('{service}', [ServiceController::class, 'update'])->name('update');
        Route::delete('{service}', [ServiceController::class, 'destroy'])->name('destroy');

        // Service Detail Editor (tabbed page)
        Route::get('{service}/detail', [ServiceDetailController::class, 'show'])->name('detail');

        // Hero (one per service)
        Route::post('{service}/hero', [ServiceHeroController::class, 'store'])->name('hero.store');
        Route::patch('{service}/hero/{hero}', [ServiceHeroController::class, 'update'])->name('hero.update');

        // Benefits
        Route::post('{service}/benefits', [ServiceBenefitController::class, 'store'])->name('benefits.store');
        Route::patch('{service}/benefits/{benefit}', [ServiceBenefitController::class, 'update'])->name('benefits.update');
        Route::delete('{service}/benefits/{benefit}', [ServiceBenefitController::class, 'destroy'])->name('benefits.destroy');

        // Talk To Us (one per service)
        Route::post('{service}/talk', [ServiceTalkToUsController::class, 'store'])->name('talk.store');
        Route::patch('{service}/talk/{talkToUs}', [ServiceTalkToUsController::class, 'update'])->name('talk.update');

        // Process Steps
        Route::post('{service}/process', [ServiceProcessController::class, 'store'])->name('process.store');
        Route::patch('{service}/process/{step}', [ServiceProcessController::class, 'update'])->name('process.update');
        Route::delete('{service}/process/{step}', [ServiceProcessController::class, 'destroy'])->name('process.destroy');

        // Tech Groups
        Route::post('{service}/techgroups', [ServiceTechGroupController::class, 'store'])->name('techgroups.store');
        Route::patch('{service}/techgroups/{techGroup}', [ServiceTechGroupController::class, 'update'])->name('techgroups.update');
        Route::delete('{service}/techgroups/{techGroup}', [ServiceTechGroupController::class, 'destroy'])->name('techgroups.destroy');

        // Tech Tags (nested under group)
        Route::post('{service}/techgroups/{techGroup}/tags', [ServiceTechTagController::class, 'store'])->name('techtags.store');
        Route::delete('{service}/techgroups/{techGroup}/tags/{tag}', [ServiceTechTagController::class, 'destroy'])->name('techtags.destroy');

        // Testimonials (service-specific)
        Route::post('{service}/testimonials', [ServiceTestimonialController::class, 'store'])->name('testimonials.store');
        Route::patch('{service}/testimonials/{testimonial}', [ServiceTestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('{service}/testimonials/{testimonial}', [ServiceTestimonialController::class, 'destroy'])->name('testimonials.destroy');

        // FAQs
        Route::post('{service}/faqs', [ServiceFaqController::class, 'store'])->name('faqs.store');
        Route::patch('{service}/faqs/{faq}', [ServiceFaqController::class, 'update'])->name('faqs.update');
        Route::delete('{service}/faqs/{faq}', [ServiceFaqController::class, 'destroy'])->name('faqs.destroy');

        // Related Services
        Route::post('{service}/related', [ServiceRelatedController::class, 'store'])->name('related.store');
        Route::delete('{service}/related/{related}', [ServiceRelatedController::class, 'destroy'])->name('related.destroy');
      });

    // ── Technologies ──
    Route::prefix('technologies')
      ->name('technologies.')
      ->group(function () {

        // Technologies list (index, store, update, destroy)
        Route::get('/', [TechnologyController::class, 'index'])->name('index');
        Route::post('/', [TechnologyController::class, 'store'])->name('store');
        Route::patch('{technology}', [TechnologyController::class, 'update'])->name('update');
        Route::delete('{technology}', [TechnologyController::class, 'destroy'])->name('destroy');

        // Technology detail editor (tabbed page)
        Route::get('{technology}/detail', [TechnologyDetailController::class, 'show'])->name('detail');

        // Hero (one per technology)
        Route::post('{technology}/hero', [TechnologyHeroController::class, 'store'])->name('hero.store');
        Route::patch('{technology}/hero/{hero}', [TechnologyHeroController::class, 'update'])->name('hero.update');

        // Advantages
        Route::post('{technology}/advantages', [TechnologyAdvantageController::class, 'store'])->name('advantages.store');
        Route::patch('{technology}/advantages/{advantage}', [TechnologyAdvantageController::class, 'update'])->name('advantages.update');
        Route::delete('{technology}/advantages/{advantage}', [TechnologyAdvantageController::class, 'destroy'])->name('advantages.destroy');

        // Benefits
        Route::post('{technology}/benefits', [TechnologyBenefitController::class, 'store'])->name('benefits.store');
        Route::patch('{technology}/benefits/{benefit}', [TechnologyBenefitController::class, 'update'])->name('benefits.update');
        Route::delete('{technology}/benefits/{benefit}', [TechnologyBenefitController::class, 'destroy'])->name('benefits.destroy');

        // Why Choose Us
        Route::post('{technology}/why-us', [TechnologyWhyUsController::class, 'store'])->name('why-us.store');
        Route::patch('{technology}/why-us/{whyUs}', [TechnologyWhyUsController::class, 'update'])->name('why-us.update');
        Route::delete('{technology}/why-us/{whyUs}', [TechnologyWhyUsController::class, 'destroy'])->name('why-us.destroy');

        // Process Steps
        Route::post('{technology}/process', [TechnologyProcessController::class, 'store'])->name('process.store');
        Route::patch('{technology}/process/{process}', [TechnologyProcessController::class, 'update'])->name('process.update');
        Route::delete('{technology}/process/{process}', [TechnologyProcessController::class, 'destroy'])->name('process.destroy');

        // FAQs
        Route::post('{technology}/faqs', [TechnologyFaqController::class, 'store'])->name('faqs.store');
        Route::patch('{technology}/faqs/{faq}', [TechnologyFaqController::class, 'update'])->name('faqs.update');
        Route::delete('{technology}/faqs/{faq}', [TechnologyFaqController::class, 'destroy'])->name('faqs.destroy');
      });

    // ── Tech Stack (global "Technologies We Use" section) ──
    Route::prefix('tech-stack')
      ->name('tech-stack.')
      ->group(function () {

        // Groups management page
        Route::get('/', [TechStackGroupController::class, 'index'])->name('index');
        Route::post('/', [TechStackGroupController::class, 'store'])->name('groups.store');
        Route::patch('groups/{group}', [TechStackGroupController::class, 'update'])->name('groups.update');
        Route::delete('groups/{group}', [TechStackGroupController::class, 'destroy'])->name('groups.destroy');

        // Items within a group
        Route::post('groups/{group}/items', [TechStackItemController::class, 'store'])->name('items.store');
        Route::patch('groups/{group}/items/{item}', [TechStackItemController::class, 'update'])->name('items.update');
        Route::delete('groups/{group}/items/{item}', [TechStackItemController::class, 'destroy'])->name('items.destroy');
      });


    // ── Careers / Job Vacancies ──
    Route::prefix('career')
      ->name('career.')
      ->group(function () {
        Route::get('/', [CareerController::class, 'index'])->name('index');
        Route::post('/', [CareerController::class, 'store'])->name('store');
        Route::put('/{career}', [CareerController::class, 'update'])->name('update');
        Route::patch('/{career}/status', [CareerController::class, 'toggleStatus'])->name('status');
        Route::delete('/{career}', [CareerController::class, 'destroy'])->name('destroy');
      });

    // ── Portfolios ──
    Route::prefix('portfolio')
      ->name('portfolio.')
      ->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('index');
        Route::get('/create', [PortfolioController::class, 'create'])->name('create');
        Route::post('/', [PortfolioController::class, 'store'])->name('store');
        Route::get('/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('edit');
        Route::get('/{portfolio}', [PortfolioController::class, 'show'])->name('show');
        Route::post('/{portfolio}', [PortfolioController::class, 'update'])->name('update');
        Route::patch('/{portfolio}/status', [PortfolioController::class, 'toggleStatus'])->name('status');
        Route::delete('/{portfolio}', [PortfolioController::class, 'destroy'])->name('destroy');
      });

    // ── CV Submissions ──
    Route::prefix('cv-submissions')
      ->name('cv-submissions.')
      ->group(function () {
        Route::get('/', [AdminCvSubmissionController::class, 'index'])->name('index');
        Route::patch('/{submission}/status', [AdminCvSubmissionController::class, 'updateStatus'])->name('status');
        Route::delete('/{submission}', [AdminCvSubmissionController::class, 'destroy'])->name('destroy');
        Route::get('/{submission}/download', [AdminCvSubmissionController::class, 'download'])->name('download');
      });

    // ── Team Members ──
    Route::prefix('team')
      ->name('team.')
      ->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('index');
        Route::post('/', [TeamController::class, 'store'])->name('store');
        Route::put('/{team}', [TeamController::class, 'update'])->name('update');
        Route::patch('/{team}/status', [TeamController::class, 'toggleStatus'])->name('status');
        Route::delete('/{team}', [TeamController::class, 'destroy'])->name('destroy');
      });
  });
