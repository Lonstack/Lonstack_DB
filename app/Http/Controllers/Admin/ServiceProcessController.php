<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceProcessStep;
use Illuminate\Http\Request;

class ServiceProcessController extends Controller
{
  /**
   * Store a new process step.
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
      'title.required' => 'The step title is required.',
    ]);

    try {
      $validated['service_id'] = $service->id;

      ServiceProcessStep::create($validated);

      return back()->with('success', 'Process step added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add process step. Please try again.');
    }
  }

  /**
   * Update an existing process step (PATCH).
   */
  public function update(Request $request, Service $service, ServiceProcessStep $step)
  {
    abort_if($step->service_id != $service->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], [
      'title.required' => 'The step title is required.',
    ]);

    try {
      $step->update($validated);

      return back()->with('success', 'Process step updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update process step. Please try again.');
    }
  }

  /**
   * Delete a process step.
   */
  public function destroy(Service $service, ServiceProcessStep $step)
  {
    abort_if($step->service_id != $service->id, 403);

    try {
      $step->delete();

      return back()->with('success', 'Process step deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete process step. Please try again.');
    }
  }
}
