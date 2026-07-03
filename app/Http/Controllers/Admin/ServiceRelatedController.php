<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceRelated;
use Illuminate\Http\Request;

class ServiceRelatedController extends Controller
{
  /**
   * Add a related service link.
   */
  public function store(Request $request, Service $service)
  {
    $validated = $request->validate([
      'related_service_id' => 'required|exists:services,id',
      'section_heading'    => 'nullable|string|max:255',
      'section_subtitle'   => 'nullable|string|max:255',
      'sort_order'         => 'nullable|integer|min:0',
    ], [
      'related_service_id.required' => 'Please select a service to link.',
      'related_service_id.exists'   => 'The selected service does not exist.',
    ]);

    // Prevent linking a service to itself
    if ((int) $validated['related_service_id'] === $service->id) {
      return back()->with('error', 'A service cannot be related to itself.');
    }

    // Prevent duplicate links
    $alreadyLinked = ServiceRelated::where('service_id', $service->id)
      ->where('related_service_id', $validated['related_service_id'])
      ->exists();

    if ($alreadyLinked) {
      return back()->with('error', 'This service is already linked as related.');
    }

    try {
      $validated['service_id'] = $service->id;

      ServiceRelated::create($validated);

      return back()->with('success', 'Related service added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add related service. Please try again.');
    }
  }

  /**
   * Remove a related service link.
   */
  public function destroy(Service $service, ServiceRelated $related)
  {
    abort_if($related->service_id != $service->id, 403);

    try {
      $related->delete();

      return back()->with('success', 'Related service removed.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to remove related service. Please try again.');
    }
  }
}
