<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTechGroup;
use App\Models\ServiceTechTag;
use Illuminate\Http\Request;

class ServiceTechTagController extends Controller
{
  /**
   * Store a new tag under a tech group.
   * Route: POST /admin/services/{service}/techgroups/{techGroup}/tags
   */
  public function store(Request $request, Service $service, ServiceTechGroup $techGroup)
  {
    // Ensure the group belongs to this service
    abort_if($techGroup->service_id != $service->id, 403);

    $validated = $request->validate([
      'name'        => 'required|string|max:100',
      'is_featured' => 'nullable|boolean',
      'sort_order'  => 'nullable|integer|min:0',
    ], [
      'name.required' => 'The tag name is required.',
    ]);

    try {
      $validated['service_tech_group_id'] = $techGroup->id;
      $validated['is_featured']           = $request->boolean('is_featured', false);

      ServiceTechTag::create($validated);

      return back()->with('success', 'Tag added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add tag. Please try again.');
    }
  }

  /**
   * Delete a tag.
   * Route: DELETE /admin/services/{service}/techgroups/{techGroup}/tags/{tag}
   */
  public function destroy(Service $service, ServiceTechGroup $techGroup, ServiceTechTag $tag)
  {
    // Verify full ownership chain
    abort_if($techGroup->service_id != $service->id, 403);
    abort_if($tag->service_tech_group_id != $techGroup->id, 403);

    try {
      $tag->delete();

      return back()->with('success', 'Tag removed.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to remove tag. Please try again.');
    }
  }
}
