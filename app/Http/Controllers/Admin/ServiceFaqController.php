<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;

class ServiceFaqController extends Controller
{
  /**
   * Store a new FAQ for the service.
   */
  public function store(Request $request, Service $service)
  {
    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'question'         => 'required|string|max:255',
      'answer'           => 'required|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'question.required' => 'The FAQ question is required.',
      'answer.required'   => 'The FAQ answer is required.',
    ]);

    try {
      $validated['service_id'] = $service->id;

      ServiceFaq::create($validated);

      return back()->with('success', 'FAQ added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add FAQ. Please try again.');
    }
  }

  /**
   * Update an existing FAQ (PATCH).
   */
  public function update(Request $request, Service $service, ServiceFaq $faq)
  {
    abort_if($faq->service_id != $service->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'question'         => 'required|string|max:255',
      'answer'           => 'required|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'question.required' => 'The FAQ question is required.',
      'answer.required'   => 'The FAQ answer is required.',
    ]);

    try {
      $faq->update($validated);

      return back()->with('success', 'FAQ updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update FAQ. Please try again.');
    }
  }

  /**
   * Delete a FAQ.
   */
  public function destroy(Service $service, ServiceFaq $faq)
  {
    abort_if($faq->service_id != $service->id, 403);

    try {
      $faq->delete();

      return back()->with('success', 'FAQ deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete FAQ. Please try again.');
    }
  }
}
