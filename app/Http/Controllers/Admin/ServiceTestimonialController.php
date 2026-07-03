<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTestimonial;
use Illuminate\Http\Request;

class ServiceTestimonialController extends Controller
{
  /**
   * Store a new testimonial for the service.
   */
  public function store(Request $request, Service $service)
  {
    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'quote'            => 'required|string',
      'client_name'      => 'required|string|max:150',
      'client_role'      => 'nullable|string|max:150',
      'rating'           => 'nullable|integer|min:1|max:5',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'quote.required'       => 'The testimonial quote is required.',
      'client_name.required' => 'The client name is required.',
      'rating.min'           => 'Rating must be between 1 and 5.',
      'rating.max'           => 'Rating must be between 1 and 5.',
    ]);

    try {
      $validated['service_id'] = $service->id;
      $validated['rating']     = $validated['rating'] ?? 5;

      ServiceTestimonial::create($validated);

      return back()->with('success', 'Testimonial added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add testimonial. Please try again.');
    }
  }

  /**
   * Update an existing testimonial (PATCH).
   */
  public function update(Request $request, Service $service, ServiceTestimonial $testimonial)
  {
    abort_if($testimonial->service_id != $service->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'quote'            => 'required|string',
      'client_name'      => 'required|string|max:150',
      'client_role'      => 'nullable|string|max:150',
      'rating'           => 'nullable|integer|min:1|max:5',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'quote.required'       => 'The testimonial quote is required.',
      'client_name.required' => 'The client name is required.',
      'rating.min'           => 'Rating must be between 1 and 5.',
      'rating.max'           => 'Rating must be between 1 and 5.',
    ]);

    try {
      $testimonial->update($validated);

      return back()->with('success', 'Testimonial updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update testimonial. Please try again.');
    }
  }

  /**
   * Delete a testimonial.
   */
  public function destroy(Service $service, ServiceTestimonial $testimonial)
  {
    abort_if($testimonial->service_id != $service->id, 403);

    try {
      $testimonial->delete();

      return back()->with('success', 'Testimonial deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete testimonial. Please try again.');
    }
  }
}
