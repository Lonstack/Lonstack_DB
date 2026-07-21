@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/quill/quill.snow.css') }}">
<style>
  .ql-toolbar.ql-snow {
    border-radius: 6px 6px 0 0;
    background: #f8f9fa;
  }

  .ql-container.ql-snow {
    border-radius: 0 0 6px 6px;
  }

  .ql-editor {
    min-height: 150px;
    font-size: 14px;
    line-height: 1.7;
  }

  .ql-editor ul,
  .ql-editor ol {
    padding-left: 1.5em !important;
    margin: .4em 0 !important;
  }

  .ql-editor li {
    list-style-type: none !important;
  }

  .ql-editor li[data-list="bullet"]::before {
    content: '\2022' !important;
  }

  .ql-editor li[data-list="ordered"]::before {
    content: counter(list-0, decimal) '. ' !important;
  }

  .cover-upload-zone {
    border: 2px dashed #d0d5dd;
    border-radius: 10px;
    background: #f9fafb;
    cursor: pointer;
    min-height: 160px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    transition: border-color .2s, background .2s;
  }

  .cover-upload-zone:hover,
  .cover-upload-zone.dragover {
    border-color: #4f46e5;
    background: #f0f0ff;
  }

  .cover-upload-zone input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
  }

  .cover-upload-zone .upload-placeholder {
    pointer-events: none;
    text-align: center;
    padding: 20px;
  }

  .cover-preview-wrap {
    position: relative;
  }

  .cover-preview-wrap img {
    width: 100%;
    max-height: 220px;
    object-fit: cover;
    border-radius: 8px;
  }

  .cover-remove-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    background: rgba(0, 0, 0, .55);
    border: none;
    border-radius: 50%;
    color: #fff;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 13px;
    line-height: 1;
  }

  .cover-remove-btn:hover {
    background: #dc3545;
  }

  .gallery-thumb {
    position: relative;
    width: 90px;
    height: 68px;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    flex-shrink: 0;
  }

  .gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .gallery-thumb .remove-gallery-btn {
    position: absolute;
    top: 3px;
    right: 3px;
    background: rgba(0, 0, 0, .55);
    border: none;
    border-radius: 50%;
    color: #fff;
    width: 22px;
    height: 22px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 11px;
  }

  .gallery-thumb .remove-gallery-btn:hover {
    background: #dc3545;
  }

  .gallery-thumb.marked-remove {
    opacity: .4;
  }
</style>
@endpush

@section('content')
<div class="content">

  <div class="page-header">
    <div class="add-item d-flex">
      <div class="page-title">
        <h4>Edit Portfolio Item</h4>
        <h6>{{ $portfolio->title }}</h6>
      </div>
    </div>
    <div class="page-btn">
      <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">
        <i class="ti ti-arrow-left me-1"></i>Back to Portfolio
      </a>
    </div>
  </div>

  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Please fix the following errors:</strong>
    <ul class="mb-0 mt-1">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

  {{-- Hidden data containers — JS reads these to populate Quill editors --}}
  <div id="quill-data" style="display:none;">
    <div id="quill-description">{!! old('description', $portfolio->description) !!}</div>
    <div id="quill-summary">{!! old('summary', $portfolio->summary) !!}</div>
    <div id="quill-challenge">{!! old('challenge', $portfolio->challenge) !!}</div>
    <div id="quill-solution">{!! old('solution', $portfolio->solution) !!}</div>
  </div>

  <form action="{{ route('admin.portfolio.update', $portfolio->slug) }}"
    method="POST"
    enctype="multipart/form-data"
    id="edit-portfolio-form">
    @csrf
    @method('POST')

    {{-- ══ SECTION 1 — Cover & Gallery ══ --}}
    <div class="accordion-item border mb-3">
      <h2 class="accordion-header">
        <div class="accordion-button bg-white" data-bs-toggle="collapse" data-bs-target="#sec-media">
          <h5 class="mb-0">Cover Image &amp; Gallery</h5>
        </div>
      </h2>
      <div id="sec-media" class="accordion-collapse collapse show">
        <div class="accordion-body border-top">
          <div class="row g-4">

            {{-- Cover --}}
            <div class="col-md-6">
              <label class="form-label fw-medium">Cover Image</label>

              <div class="cover-preview-wrap mb-2" id="cover-preview-wrap"
                style="{{ $portfolio->cover_image ? '' : 'display:none;' }}">
                <img id="cover-preview-img"
                  src="{{ $portfolio->cover_image ? asset('storage/'.$portfolio->cover_image) : '' }}"
                  alt="Cover">
                <button type="button" class="cover-remove-btn" id="cover-remove-btn" title="Replace image">
                  <i class="ti ti-x"></i>
                </button>
              </div>

              <div class="cover-upload-zone" id="cover-upload-zone"
                style="{{ $portfolio->cover_image ? 'display:none;' : '' }}">
                <input type="file" name="cover_image" id="cover-image-input" accept="image/*">
                <div class="upload-placeholder">
                  <i class="ti ti-cloud-upload fs-36 text-muted mb-2 d-block"></i>
                  <p class="fw-medium mb-1">Drag &amp; drop or click to upload</p>
                  <small class="text-muted">JPG, PNG, WebP — max 5 MB</small>
                </div>
              </div>

              @if ($portfolio->cover_image)
              <small class="text-muted d-block mt-1">Click ✕ to replace with a new image.</small>
              @endif
            </div>

            {{-- Gallery --}}
            <div class="col-md-6">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <label class="form-label fw-medium mb-0">
                  Gallery <small class="text-muted fw-normal">(up to 3)</small>
                </label>
                <label class="btn btn-outline-secondary btn-sm mb-0" style="cursor:pointer; position:relative;">
                  <i class="ti ti-plus me-1"></i>Add Image
                  <input type="file" name="gallery[]" id="gallery-input" accept="image/*"
                    style="position:absolute; width:1px; height:1px; opacity:0;">
                </label>
              </div>

              <div id="gallery-existing" class="d-flex flex-wrap gap-2 align-items-start mb-2">
                @foreach ($portfolio->gallery ?? [] as $img)
                <div class="gallery-thumb" data-path="{{ $img }}">
                  <img src="{{ asset('storage/'.$img) }}" alt="">
                  <button type="button" class="remove-gallery-btn remove-existing-gallery"
                    title="Remove">
                    <i class="ti ti-x"></i>
                  </button>
                  <input type="hidden" name="remove_gallery[]" value="{{ $img }}" disabled>
                </div>
                @endforeach
              </div>

              <div id="gallery-preview" class="d-flex flex-wrap gap-2 align-items-start">
                <p class="text-muted fs-13 mb-0" id="gallery-empty-msg"
                  style="{{ ($portfolio->gallery && count($portfolio->gallery)) ? 'display:none;' : '' }}">
                  No gallery images added yet.
                </p>
              </div>

              <small class="text-muted d-block mt-2">Max 5 MB each.</small>
            </div>

          </div>
        </div>
      </div>
    </div>

    {{-- ══ SECTION 2 — Project Info ══ --}}
    <div class="accordion-item border mb-3">
      <h2 class="accordion-header">
        <div class="accordion-button bg-white" data-bs-toggle="collapse" data-bs-target="#sec-info">
          <h5 class="mb-0">Project Info</h5>
        </div>
      </h2>
      <div id="sec-info" class="accordion-collapse collapse show">
        <div class="accordion-body border-top">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Service <span class="text-danger">*</span></label>
              <select name="service_id" class="form-select @error('service_id') is-invalid @enderror" required>
                <option value="">— Select a service —</option>
                @foreach ($services as $service)
                <option value="{{ $service->id }}"
                  {{ old('service_id', $portfolio->service_id) == $service->id ? 'selected' : '' }}>
                  {{ $service->name }}
                </option>
                @endforeach
              </select>
              @error('service_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <label class="form-label">Published Date</label>
              <input type="text" name="published_at" id="published-at-picker"
                class="form-control @error('published_at') is-invalid @enderror"
                value="{{ old('published_at', $portfolio->published_at?->format('Y-m-d')) }}"
                placeholder="Pick a date" autocomplete="off" readonly>
              @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-2">
              <label class="form-label">Sort Order</label>
              <input type="number" name="sort_order" class="form-control"
                value="{{ old('sort_order', $portfolio->sort_order) }}" min="0">
            </div>

            <div class="col-md-8">
              <label class="form-label">Title <span class="text-danger">*</span></label>
              <input type="text" name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $portfolio->title) }}" required>
              @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <label class="form-label">Active</label>
              <div class="d-flex align-items-center gap-3 mt-1">
                <label class="switch mb-0">
                  <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $portfolio->is_active) ? 'checked' : '' }}>
                  <span class="slider round"></span>
                </label>
                <span class="text-muted fs-13">Visible on the public website</span>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Client</label>
              <input type="text" name="client"
                class="form-control @error('client') is-invalid @enderror"
                value="{{ old('client', $portfolio->client) }}" placeholder="e.g. Acme Corp">
              @error('client')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label">Location</label>
              <input type="text" name="location"
                class="form-control @error('location') is-invalid @enderror"
                value="{{ old('location', $portfolio->location) }}" placeholder="e.g. Dubai, UAE">
              @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label">Technologies <small class="text-muted">(comma-separated)</small></label>
              <input type="text" name="technologies"
                class="form-control @error('technologies') is-invalid @enderror"
                value="{{ old('technologies', $portfolio->technologies ? implode(', ', $portfolio->technologies) : '') }}"
                placeholder="e.g. React Native, Node.js, PostgreSQL">
              @error('technologies')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label">Features <small class="text-muted">(comma-separated)</small></label>
              <input type="text" name="features"
                class="form-control @error('features') is-invalid @enderror"
                value="{{ old('features', $portfolio->features ? implode(', ', $portfolio->features) : '') }}"
                placeholder="e.g. Auth, Order management, Payments">
              @error('features')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label">Tags <small class="text-muted">(comma-separated)</small></label>
              <input type="text" name="tags"
                class="form-control @error('tags') is-invalid @enderror"
                value="{{ old('tags', $portfolio->tags ? implode(', ', $portfolio->tags) : '') }}"
                placeholder="e.g. Design, React, API">
              @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <label class="form-label">Excerpt <small class="text-muted">(short summary shown on cards)</small></label>
              <textarea name="excerpt" rows="2"
                class="form-control @error('excerpt') is-invalid @enderror"
                placeholder="One or two sentences describing the project.">{{ old('excerpt', $portfolio->excerpt) }}</textarea>
              @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

          </div>
        </div>
      </div>
    </div>

    {{-- ══ SECTION 3 — Content (Quill) ══ --}}
    <div class="accordion-item border mb-3">
      <h2 class="accordion-header">
        <div class="accordion-button bg-white" data-bs-toggle="collapse" data-bs-target="#sec-content">
          <h5 class="mb-0">Content</h5>
        </div>
      </h2>
      <div id="sec-content" class="accordion-collapse collapse show">
        <div class="accordion-body border-top">

          <div class="mb-4">
            <label class="form-label fw-medium">Description <small class="text-muted fw-normal">(main body)</small></label>
            <input type="hidden" name="description" id="description-input">
            <div id="description-editor"></div>
          </div>

          <div class="mb-4">
            <label class="form-label fw-medium">Project Summary <small class="text-muted fw-normal">(closing section)</small></label>
            <input type="hidden" name="summary" id="summary-input">
            <div id="summary-editor"></div>
          </div>

          <div class="mb-4">
            <label class="form-label fw-medium">Challenge <small class="text-muted fw-normal">(what business problem existed?)</small></label>
            <input type="hidden" name="challenge" id="challenge-input">
            <div id="challenge-editor"></div>
          </div>

          <div class="mb-0">
            <label class="form-label fw-medium">Solution <small class="text-muted fw-normal">(what was built)</small></label>
            <input type="hidden" name="solution" id="solution-input">
            <div id="solution-editor"></div>
          </div>

        </div>
      </div>
    </div>

    {{-- Submit --}}
    <div class="d-flex justify-content-end gap-2 mb-4">
      <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary px-4">Cancel</a>
      <button type="submit" class="btn btn-primary px-5">
        <i class="ti ti-device-floppy me-1"></i>Save Changes
      </button>
    </div>

  </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('dashboard_assets/plugins/quill/quill.min.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {

    // ── Flatpickr ─────────────────────────────────────────────────────────
    flatpickr('#published-at-picker', {
      dateFormat: 'Y-m-d',
      allowInput: false,
    });

    // ── Quill editors ─────────────────────────────────────────────────────
    const quillOpts = {
      theme: 'snow',
      modules: {
        toolbar: [
          [{
            header: [2, 3, false]
          }],
          ['bold', 'italic', 'underline'],
          [{
            list: 'ordered'
          }, {
            list: 'bullet'
          }],
          ['link'],
          ['clean'],
        ],
      },
    };

    const descQuill = new Quill('#description-editor', quillOpts);
    const summaryQuill = new Quill('#summary-editor', quillOpts);
    const challengeQuill = new Quill('#challenge-editor', quillOpts);
    const solutionQuill = new Quill('#solution-editor', quillOpts);

    // Read existing HTML from the hidden data divs (set by Blade, not JS)
    descQuill.root.innerHTML = document.getElementById('quill-description').innerHTML;
    summaryQuill.root.innerHTML = document.getElementById('quill-summary').innerHTML;
    challengeQuill.root.innerHTML = document.getElementById('quill-challenge').innerHTML;
    solutionQuill.root.innerHTML = document.getElementById('quill-solution').innerHTML;

    // Sync Quill HTML into hidden inputs on submit
    document.getElementById('edit-portfolio-form').addEventListener('submit', function() {
      document.getElementById('description-input').value = descQuill.root.innerHTML;
      document.getElementById('summary-input').value = summaryQuill.root.innerHTML;
      document.getElementById('challenge-input').value = challengeQuill.root.innerHTML;
      document.getElementById('solution-input').value = solutionQuill.root.innerHTML;
    });

    // ── Cover image ───────────────────────────────────────────────────────
    const coverInput = document.getElementById('cover-image-input');
    const coverZone = document.getElementById('cover-upload-zone');
    const previewWrap = document.getElementById('cover-preview-wrap');
    const previewImg = document.getElementById('cover-preview-img');
    const removeBtn = document.getElementById('cover-remove-btn');

    function showCoverPreview(file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        previewImg.src = e.target.result;
        previewWrap.style.display = 'block';
        coverZone.style.display = 'none';
      };
      reader.readAsDataURL(file);
    }

    if (coverInput) {
      coverInput.addEventListener('change', function() {
        if (this.files && this.files[0]) showCoverPreview(this.files[0]);
      });
    }

    if (coverZone) {
      coverZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
      });
      coverZone.addEventListener('dragleave', function() {
        this.classList.remove('dragover');
      });
      coverZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
          const dt = new DataTransfer();
          dt.items.add(file);
          coverInput.files = dt.files;
          showCoverPreview(file);
        }
      });
    }

    if (removeBtn) {
      removeBtn.addEventListener('click', function() {
        coverInput.value = '';
        previewImg.src = '';
        previewWrap.style.display = 'none';
        coverZone.style.display = 'flex';
      });
    }

    // ── Existing gallery remove ───────────────────────────────────────────
    document.querySelectorAll('.remove-existing-gallery').forEach(function(btn) {
      btn.addEventListener('click', function() {
        const thumb = this.closest('.gallery-thumb');
        const hiddenInput = thumb.querySelector('input[type="hidden"]');
        hiddenInput.disabled = false;
        thumb.classList.add('marked-remove');
        this.disabled = true;
        updateEmptyState();
      });
    });

    // ── New gallery images ────────────────────────────────────────────────
    const galleryInput = document.getElementById('gallery-input');
    const galleryPreview = document.getElementById('gallery-preview');
    const galleryEmptyMsg = document.getElementById('gallery-empty-msg');
    const GALLERY_MAX = 3;
    const galleryDT = new DataTransfer();

    function countKeepExisting() {
      return document.querySelectorAll('#gallery-existing .gallery-thumb:not(.marked-remove)').length;
    }

    function syncGalleryInput() {
      galleryInput.files = galleryDT.files;
    }

    function updateEmptyState() {
      const total = countKeepExisting() + galleryDT.files.length;
      galleryEmptyMsg.style.display = total === 0 ? 'block' : 'none';
    }

    galleryInput.addEventListener('change', function() {
      if (!this.files || !this.files.length) return;
      Array.from(this.files).forEach(function(file) {
        if (countKeepExisting() + galleryDT.files.length >= GALLERY_MAX) {
          iziToast.warning({
            message: 'Maximum ' + GALLERY_MAX + ' gallery images allowed.',
            position: 'topRight'
          });
          return;
        }
        for (let i = 0; i < galleryDT.files.length; i++) {
          if (galleryDT.files[i].name === file.name && galleryDT.files[i].size === file.size) return;
        }
        galleryDT.items.add(file);

        const reader = new FileReader();
        reader.onload = function(e) {
          const thumb = document.createElement('div');
          thumb.className = 'gallery-thumb';
          thumb.innerHTML =
            '<img src="' + e.target.result + '" alt="">' +
            '<button type="button" class="remove-gallery-btn" title="Remove"><i class="ti ti-x"></i></button>';

          thumb.querySelector('.remove-gallery-btn').addEventListener('click', function() {
            const newDT = new DataTransfer();
            for (let i = 0; i < galleryDT.files.length; i++) {
              if (galleryDT.files[i].name !== file.name || galleryDT.files[i].size !== file.size)
                newDT.items.add(galleryDT.files[i]);
            }
            galleryDT.items.clear();
            for (let i = 0; i < newDT.files.length; i++) galleryDT.items.add(newDT.files[i]);
            thumb.remove();
            syncGalleryInput();
            updateEmptyState();
          });

          galleryPreview.appendChild(thumb);
          syncGalleryInput();
          updateEmptyState();
        };
        reader.readAsDataURL(file);
      });
      this.value = '';
    });

    updateEmptyState();

  });
</script>
@endpush
