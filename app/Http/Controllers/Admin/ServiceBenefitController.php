<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBenefit;
use Illuminate\Http\Request;

class ServiceBenefitController extends Controller
{
  /**
   * Store a new benefit for the service.
   */
  public function store(Request $request, Service $service)
  {
    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'title.required' => 'The benefit title is required.',
    ]);

    try {
      $validated['service_id'] = $service->id;

      ServiceBenefit::create($validated);

      return back()->with('success', 'Benefit added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add benefit. Please try again.');
    }
  }

  /**
   * Update an existing benefit (PATCH).
   */
  public function update(Request $request, Service $service, ServiceBenefit $benefit)
  {
    abort_if($benefit->service_id != $service->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'title.required' => 'The benefit title is required.',
    ]);

    try {
      $benefit->update($validated);

      return back()->with('success', 'Benefit updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update benefit. Please try again.');
    }
  }

  /**
   * Delete a benefit.
   */
  public function destroy(Service $service, ServiceBenefit $benefit)
  {
    abort_if($benefit->service_id != $service->id, 403);

    try {
      $benefit->delete();

      return back()->with('success', 'Benefit deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete benefit. Please try again.');
    }
  }

  
}
