<div class="row">

    {{-- Cover Image --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Cover Image</label>
        @if ($edit ?? false)
            <div id="edit-cover-preview" class="mb-2" style="display:none;">
                <img id="edit-cover-img" src="" alt=""
                     style="width:120px;height:80px;object-fit:cover;border-radius:6px;">
                <p class="text-muted fs-12 mt-1">Current image — upload a new one to replace it.</p>
            </div>
        @else
            <div id="add-cover-preview" class="mb-2" style="display:none;">
                <img id="add-cover-img" src="" alt=""
                     style="width:120px;height:80px;object-fit:cover;border-radius:6px;">
            </div>
        @endif
        <input type="file" name="cover_image" class="form-control" accept="image/*">
        <small class="text-muted">Max 5MB. JPG / PNG / WebP.</small>
    </div>

    {{-- Gallery Images --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">
            Gallery Images
            <small class="text-muted">(shown on the project details page)</small>
        </label>
        @if ($edit ?? false)
            <div id="edit-gallery-existing" class="d-flex flex-wrap gap-2 mb-2"></div>
            <div id="edit-gallery-preview" class="d-flex flex-wrap gap-2 mb-2"></div>
        @else
            <div id="add-gallery-preview" class="d-flex flex-wrap gap-2 mb-2"></div>
        @endif

        <label class="btn btn-outline-secondary btn-sm"
               style="cursor:pointer; position:relative; overflow:hidden;">
            <i class="ti ti-plus me-1"></i>Add Image
            <input type="file" name="gallery[]"
                   id="{{ ($edit ?? false) ? 'edit-gallery-input' : 'add-gallery-input' }}"
                   accept="image/*"
                   style="position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;">
        </label>
        <small class="text-muted ms-2">Max 5MB each. Click to add one at a time.</small>
    </div>

    {{-- Service --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Service <span class="text-danger">*</span></label>
        <select name="service_id" class="form-select" required>
            <option value="">— Select a service —</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Sort Order --}}
    <div class="col-md-3 mb-3">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" value="0" min="0">
    </div>

    {{-- Status --}}
    <div class="col-md-3 mb-3 d-flex flex-column justify-content-end">
        <div class="d-flex align-items-center justify-content-between">
            <label class="form-label mb-0">Active</label>
            <label class="switch ms-2">
                <input type="checkbox" name="is_active"
                       id="{{ ($edit ?? false) ? 'edit-is-active' : 'add-is-active' }}"
                       value="1">
                <span class="slider round"></span>
            </label>
        </div>
    </div>

    {{-- Title --}}
    <div class="col-md-8 mb-3">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" required placeholder="e.g. E-Commerce Platform Redesign">
    </div>

    {{-- Slug --}}
    <div class="col-md-4 mb-3">
        <label class="form-label">Slug <small class="text-muted">(auto-generated)</small></label>
        <input type="text" name="slug" class="form-control" placeholder="leave blank to auto-generate">
    </div>

    {{-- Client --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Client</label>
        <input type="text" name="client" class="form-control" placeholder="e.g. Acme Corp">
    </div>

    {{-- Location --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location" class="form-control" placeholder="e.g. Dubai, UAE">
    </div>

    {{-- Published At --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Published Date</label>
        <input type="date" name="published_at" class="form-control">
    </div>

    {{-- Tags --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Tags <small class="text-muted">(comma-separated)</small></label>
        <input type="text" name="tags" class="form-control" placeholder="e.g. Design, React, API">
    </div>

    {{-- Excerpt --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Excerpt <small class="text-muted">(short summary for cards)</small></label>
        <textarea name="excerpt" class="form-control" rows="2"
                  placeholder="One or two sentences describing the project."></textarea>
    </div>

    {{-- Description (Quill) --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Description <small class="text-muted">(main body)</small></label>
        @if ($edit ?? false)
            <input type="hidden" name="description" id="edit-description-input">
            <div id="edit-description-editor" style="min-height:160px;"></div>
        @else
            <input type="hidden" name="description" id="add-description-input">
            <div id="add-description-editor" style="min-height:160px;"></div>
        @endif
    </div>

    {{-- Summary (Quill) --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Project Summary <small class="text-muted">(closing section)</small></label>
        @if ($edit ?? false)
            <input type="hidden" name="summary" id="edit-summary-input">
            <div id="edit-summary-editor" style="min-height:120px;"></div>
        @else
            <input type="hidden" name="summary" id="add-summary-input">
            <div id="add-summary-editor" style="min-height:120px;"></div>
        @endif
    </div>

    {{-- Challenge (Quill) --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Challenge <small class="text-muted">(what business problem existed?)</small></label>
        @if ($edit ?? false)
            <input type="hidden" name="challenge" id="edit-challenge-input">
            <div id="edit-challenge-editor" style="min-height:120px;"></div>
        @else
            <input type="hidden" name="challenge" id="add-challenge-input">
            <div id="add-challenge-editor" style="min-height:120px;"></div>
        @endif
    </div>

    {{-- Solution (Quill) --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">Solution <small class="text-muted">(what Lonstack built)</small></label>
        @if ($edit ?? false)
            <input type="hidden" name="solution" id="edit-solution-input">
            <div id="edit-solution-editor" style="min-height:120px;"></div>
        @else
            <input type="hidden" name="solution" id="add-solution-input">
            <div id="add-solution-editor" style="min-height:120px;"></div>
        @endif
    </div>

    {{-- Technologies (comma-separated → JSON) --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Technologies <small class="text-muted">(comma-separated)</small></label>
        <input type="text" name="technologies"
               id="{{ ($edit ?? false) ? 'edit-technologies' : 'add-technologies' }}"
               class="form-control" placeholder="e.g. React Native, Node.js, PostgreSQL">
        <small class="text-muted">Each item becomes a tag on the frontend.</small>
    </div>

    {{-- Features (comma-separated → JSON) --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Features <small class="text-muted">(comma-separated)</small></label>
        <input type="text" name="features"
               id="{{ ($edit ?? false) ? 'edit-features' : 'add-features' }}"
               class="form-control" placeholder="e.g. User authentication, Order management, Payments">
        <small class="text-muted">Each item becomes a bullet point on the frontend.</small>
    </div>

</div>