<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTechGroup;
use Illuminate\Http\Request;

class ServiceTechGroupController extends Controller
{
  /**
   * Store a new tech group for the service.
   */
  public function store(Request $request, Service $service)
  {
    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'group_name'       => 'required|string|max:150',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'group_name.required' => 'The group name is required.',
    ]);

    try {
      $validated['service_id'] = $service->id;

      ServiceTechGroup::create($validated);

      return back()->with('success', 'Tech group added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add tech group. Please try again.');
    }
  }

  /**
   * Update an existing tech group (PATCH).
   */
  public function update(Request $request, Service $service, ServiceTechGroup $techGroup)
  {
    abort_if($techGroup->service_id != $service->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'group_name'       => 'required|string|max:150',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'group_name.required' => 'The group name is required.',
    ]);

    try {
      $techGroup->update($validated);

      return back()->with('success', 'Tech group updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update tech group. Please try again.');
    }
  }

  /**
   * Delete a tech group.
   * Tags are removed automatically via cascadeOnDelete DB constraint.
   */
  public function destroy(Service $service, ServiceTechGroup $techGroup)
  {
    abort_if($techGroup->service_id != $service->id, 403);

    try {
      $techGroup->delete();

      return back()->with('success', 'Tech group and its tags deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete tech group. Please try again.');
    }
  }
}
