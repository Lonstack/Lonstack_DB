<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware(['maintenance'])->group(function () {

    // ── Core pages ──
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/contact-us', [PageController::class, 'contact'])->name('contact-us');
    Route::get('/terms-of-service', [PageController::class, 'terms'])->name('terms-of-service');
    Route::get('/privacy-policy', [PageController::class, 'policy'])->name('privacy-policy');

    // ── Portfolio ──
    Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
    Route::get('/portfolio/load', [PageController::class, 'portfolioLoad'])->name('portfolio.load');
    Route::get('/portfolio/{slug}', [PageController::class, 'portfolioDetails'])->name('portfolio-details');

    // ── Blog ──
    Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
    Route::get('/blog/{slug}', [PageController::class, 'blogDetails'])->name('blog-details');
    Route::post('/blog/{slug}/comment', [\App\Http\Controllers\BlogCommentController::class, 'store'])->name('blog.comment.store');

    // ── Company ──
    Route::get('/career', [PageController::class, 'career'])->name('career');
    Route::post('/career/apply', [PageController::class, 'careerApply'])->name('career.apply');

    // ── CV Submissions (public) ──
    Route::post('/career/submit-cv', [\App\Http\Controllers\CvSubmissionController::class, 'store'])->name('cv.submit');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    Route::get('/press', [PageController::class, 'press'])->name('press');
    Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
    Route::get('/awards', [PageController::class, 'awards'])->name('awards');

    // ── Dynamic service detail — single route handles all services by slug ──
    Route::get('/services/{slug}', [PageController::class, 'serviceDetail'])->name('services.show');

    // ── Technologies — dynamic, one route handles all by slug ──
    Route::get('/technologies/{slug}', [PageController::class, 'technologyDetail'])->name('tech.show');

    // ── Industries (commented out) ──
    //   Route::get('/industries/oil-gas', [PageController::class, 'oilGas'])->name('industries.oil-gas');
    //   Route::get('/industries/logistics', [PageController::class, 'logistics'])->name('industries.logistics');
    //   Route::get('/industries/fintech', [PageController::class, 'fintech'])->name('industries.fintech');
    //   Route::get('/industries/retail', [PageController::class, 'retail'])->name('industries.retail');
    //   Route::get('/industries/real-estate', [PageController::class, 'realEstate'])->name('industries.real-estate');
    //   Route::get('/industries/travel-hospitality', [PageController::class, 'travelHospitality'])->name('industries.travel');
    //   Route::get('/industries/media-entertainment', [PageController::class, 'mediaEntertainment'])->name('industries.media');
    //   Route::get('/industries/healthcare', [PageController::class, 'healthcare'])->name('industries.healthcare');
    //   Route::get('/industries/elearning', [PageController::class, 'elearning'])->name('industries.elearning');
    //   Route::get('/industries/manufacturing', [PageController::class, 'manufacturing'])->name('industries.manufacturing');

    // ── Contact Form ──
    Route::post('/contact-us', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

    //Newsletter Form
    Route::post('/newsletter', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
