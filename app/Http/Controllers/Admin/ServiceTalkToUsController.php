<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTalkToUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceTalkToUsController extends Controller
{
  /**
   * Store a new "Talk To Us" record.
   */
  public function store(Request $request, Service $service)
  {
    $validated = $request->validate([
      'person_name'   => 'nullable|string|max:150',
      'person_role'   => 'nullable|string|max:150',
      'person_avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
      'headline'      => 'required|string|max:255',
      'subtext'       => 'nullable|string|max:255',
      'cta_label'     => 'required|string|max:100',
      'cta_url'       => 'required|string|max:255',
    ], [
      'person_avatar.image' => 'The avatar must be an image.',
      'person_avatar.mimes' => 'The avatar must be a JPEG, PNG, JPG, or WebP file.',
      'person_avatar.max'   => 'The avatar size must not exceed 1MB.',
    ]);

    $newAvatarPath = null;

    try {
      if ($request->hasFile('person_avatar')) {
        $file = $request->file('person_avatar');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $newAvatarPath = $file->storeAs('services/avatars', $filename, 'public');
        $validated['person_avatar'] = $newAvatarPath;
      }

      $validated['service_id'] = $service->id;

      ServiceTalkToUs::create($validated);

      return back()->with('success', '"Talk To Us" section saved successfully.');
    } catch (\Exception $e) {
      if ($newAvatarPath && Storage::disk('public')->exists($newAvatarPath)) {
        Storage::disk('public')->delete($newAvatarPath);
      }

      return back()->withInput()->with('error', 'Failed to save section. Please try again.');
    }
  }

  /**
   * Update the existing record (PATCH).
   * Safe order: upload new → update DB → delete old.
   */
  public function update(Request $request, Service $service, ServiceTalkToUs $talkToUs)
  {
    abort_if($talkToUs->service_id != $service->id, 403);

    $validated = $request->validate([
      'person_name'   => 'nullable|string|max:150',
      'person_role'   => 'nullable|string|max:150',
      'person_avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
      'headline'      => 'required|string|max:255',
      'subtext'       => 'nullable|string|max:255',
      'cta_label'     => 'required|string|max:100',
      'cta_url'       => 'required|string|max:255',
    ], [
      'person_avatar.image' => 'The avatar must be an image.',
      'person_avatar.mimes' => 'The avatar must be a JPEG, PNG, JPG, or WebP file.',
      'person_avatar.max'   => 'The avatar size must not exceed 1MB.',
    ]);

    $newAvatarPath = null;
    $oldAvatarPath = $talkToUs->person_avatar;

    try {
      // Step 1: Upload new avatar before touching the DB
      if ($request->hasFile('person_avatar')) {
        $file = $request->file('person_avatar');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $newAvatarPath = $file->storeAs('services/avatars', $filename, 'public');
        $validated['person_avatar'] = $newAvatarPath;
      }

      // Step 2: Update DB
      $talkToUs->update($validated);

      // Step 3: Delete old avatar only after successful DB update
      if ($newAvatarPath && $oldAvatarPath && Storage::disk('public')->exists($oldAvatarPath)) {
        Storage::disk('public')->delete($oldAvatarPath);
      }

      return back()->with('success', '"Talk To Us" section updated successfully.');
    } catch (\Exception $e) {
      // Roll back new upload — old avatar is untouched
      if ($newAvatarPath && Storage::disk('public')->exists($newAvatarPath)) {
        Storage::disk('public')->delete($newAvatarPath);
      }

      return back()->withInput()->with('error', 'Failed to update section. Please try again.');
    }
  }
}
