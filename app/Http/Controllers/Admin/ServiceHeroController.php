<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceHeroController extends Controller
{
  /**
   * Strip inline color styles injected by Quill editor.
   */
  private function cleanDescription(?string $html): ?string
  {
    if (!$html) return $html;
    $html = preg_replace('/color\s*:\s*[^;"]+;?/i', '', $html);
    $html = preg_replace('/style="\s*"/i', '', $html);
    return $html;
  }

  /**
   * Store a new hero record for the service.
   */
  public function store(Request $request, Service $service)
  {
    $validated = $request->validate([
      'headline'            => 'required|string|max:255',
      'description'         => 'nullable|string',
      'image'               => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
      'cta_primary_label'   => 'nullable|string|max:100',
      'cta_primary_url'     => 'nullable|string|max:255',
      'cta_secondary_label' => 'nullable|string|max:100',
      'cta_secondary_url'   => 'nullable|string|max:255',
    ], [
      'image.image' => 'The file must be an image.',
      'image.mimes' => 'The image must be a JPEG, PNG, JPG, or WebP file.',
      'image.max'   => 'The image size must not exceed 2MB.',
    ]);

    $newImagePath = null;

    try {
      if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $newImagePath = $file->storeAs('services/hero', $filename, 'public');
        $validated['image'] = $newImagePath;
      }

      $validated['service_id']   = $service->id;
      $validated['description']  = $this->cleanDescription($request->description);

      ServiceHero::create($validated);

      return back()->with('success', 'Hero section saved successfully.');
    } catch (\Exception $e) {
      if ($newImagePath && Storage::disk('public')->exists($newImagePath)) {
        Storage::disk('public')->delete($newImagePath);
      }

      return back()->withInput()->with('error', 'Failed to save hero section. Please try again.');
    }
  }

  /**
   * Update the existing hero record (PATCH).
   */
  public function update(Request $request, Service $service, ServiceHero $hero)
  {
    abort_if($hero->service_id != $service->id, 403);

    $validated = $request->validate([
      'headline'            => 'required|string|max:255',
      'description'         => 'nullable|string',
      'image'               => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
      'cta_primary_label'   => 'nullable|string|max:100',
      'cta_primary_url'     => 'nullable|string|max:255',
      'cta_secondary_label' => 'nullable|string|max:100',
      'cta_secondary_url'   => 'nullable|string|max:255',
    ], [
      'image.image' => 'The file must be an image.',
      'image.mimes' => 'The image must be a JPEG, PNG, JPG, or WebP file.',
      'image.max'   => 'The image size must not exceed 2MB.',
    ]);

    $newImagePath = null;
    $oldImagePath = $hero->image;

    try {
      if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $newImagePath = $file->storeAs('services/hero', $filename, 'public');
        $validated['image'] = $newImagePath;
      }

      $validated['description'] = $this->cleanDescription($request->description);

      $hero->update($validated);

      if ($newImagePath && $oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
        Storage::disk('public')->delete($oldImagePath);
      }

      return back()->with('success', 'Hero section updated successfully.');
    } catch (\Exception $e) {
      if ($newImagePath && Storage::disk('public')->exists($newImagePath)) {
        Storage::disk('public')->delete($newImagePath);
      }

      return back()->withInput()->with('error', 'Failed to update hero section. Please try again.');
    }
  }
}
