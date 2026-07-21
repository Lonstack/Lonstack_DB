@extends('layouts.admin')

@push('styles')
{{-- Quill CSS --}}
<link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/quill/quill.snow.css') }}">
{{-- Service detail page styles --}}
<link rel="stylesheet" href="{{ asset('dashboard_assets/css/service-detail.css') }}">
@endpush

@push('scripts')
{{-- Quill JS (must load before service-detail.js) --}}
<script src="{{ asset('dashboard_assets/plugins/quill/quill.min.js') }}"></script>
{{-- Service detail: tab persistence, Quill init, image preview --}}
<script src="{{ asset('dashboard_assets/js/service-detail.js') }}"></script>
@endpush

@section('content')
<div class="content">

  {{-- Page Header --}}
  <div class="page-header">
    <div class="page-title">
      <h4>{{ $service->name }}</h4>
      <h6>Edit service detail &mdash; {{ $service->category->name }}</h6>
    </div>
    <div class="page-btn">
      <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
        <i class="ti ti-arrow-left me-1"></i>Back to Services
      </a>
    </div>
  </div>

  {{-- Tab Navigation --}}
  <ul class="nav nav-pills mb-3 flex-wrap gap-1" id="detailTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="pill" href="#tab-hero">Hero</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-benefits">Benefits</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-talk">Talk To Us</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-process">Process</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-tech">Tech Stack</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-testimonials">Testimonials</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-faqs">FAQs</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-related">Related</a></li>
  </ul>

  <div class="tab-content">

    {{-- ══════════════════════════════════════════════
             TAB 1 — HERO
             Single record. Inline form, pre-filled if exists.
             Image shows a live preview when a file is chosen.
        ══════════════════════════════════════════════ --}}
    <div class="tab-pane fade show active" id="tab-hero">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Hero Section</h5>
        </div>
        <div class="card-body">
          <form
            action="{{ $service->hero
                            ? route('admin.services.hero.update', [$service, $service->hero])
                            : route('admin.services.hero.store', $service) }}"
            method="POST"
            enctype="multipart/form-data"
            data-submit-spinner
            data-spinner-text="Saving...">
            @csrf
            @if($service->hero) @method('PATCH') @endif

            <div class="row">
              <div class="col-md-8">
                <div class="mb-3">
                  <label class="form-label">Headline <span class="text-danger">*</span></label>
                  <input type="text" name="headline" class="form-control"
                    value="{{ old('headline', $service->hero?->headline) }}"
                    placeholder="e.g. Web Application Development Services" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Description</label>
                  {{-- Quill editor — data-quill-editor picks it up in service-detail.js --}}
                  <input type="hidden" name="description" id="hero-desc-input"
                    value="{{ old('description', $service->hero?->description) }}">
                  <div data-quill-editor data-quill-input="hero-desc-input">{!! old('description', $service->hero?->description) !!}</div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Primary CTA Label</label>
                      <input type="text" name="cta_primary_label" class="form-control"
                        value="{{ old('cta_primary_label', $service->hero?->cta_primary_label) }}"
                        placeholder="e.g. Get A Free Estimation">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Primary CTA URL</label>
                      <input type="text" name="cta_primary_url" class="form-control"
                        value="{{ old('cta_primary_url', $service->hero?->cta_primary_url) }}"
                        placeholder="/contact">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Secondary CTA Label</label>
                      <input type="text" name="cta_secondary_label" class="form-control"
                        value="{{ old('cta_secondary_label', $service->hero?->cta_secondary_label) }}"
                        placeholder="e.g. Hire Us">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Secondary CTA URL</label>
                      <input type="text" name="cta_secondary_url" class="form-control"
                        value="{{ old('cta_secondary_url', $service->hero?->cta_secondary_url) }}"
                        placeholder="/contact">
                    </div>
                  </div>
                </div>
              </div>

              {{-- Image upload with live preview --}}
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Hero Image</label>
                  {{-- Preview shown if image already exists --}}
                  <div class="img-preview-wrap mb-2" id="hero-img-wrap"
                    style="{{ $service->hero?->image ? '' : 'display:none;' }}">
                    <img id="hero-img-preview"
                      src="{{ $service->hero?->image ? asset('storage/' . $service->hero->image) : '' }}"
                      alt="Hero preview">
                  </div>
                  {{-- data-preview-target / data-preview-wrap picked up by service-detail.js --}}
                  <label for="hero-img-input" class="upload-label w-100">
                    <i class="ti ti-upload me-1"></i>
                    {{ $service->hero?->image ? 'Change Image' : 'Upload Image' }}
                  </label>
                  <input type="file" name="image" id="hero-img-input"
                    class="d-none" accept="image/*"
                    data-preview-target="#hero-img-preview"
                    data-preview-wrap="#hero-img-wrap">
                  <small class="text-muted d-block mt-1">Recommended: 1200×600px</small>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-end mt-2">
              <button type="submit" class="btn btn-secondary">
                <i class="ti ti-device-floppy me-1"></i>
                {{ $service->hero ? 'Update Hero' : 'Save Hero' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- ══════════════════════════════════════════════
         TAB 2 — BENEFITS  (table + single add/edit modal)
    ══════════════════════════════════════════════ --}}
    <div class="tab-pane fade" id="tab-benefits">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Benefits / Solutions</h5>
          {{-- Opens the shared add/edit modal in ADD mode --}}
          <button class="btn btn-secondary btn-sm"
            data-bs-toggle="modal" data-bs-target="#benefitModal"
            data-mode="add">
            <i class="ti ti-circle-plus me-1"></i>Add Benefit
          </button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Order</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($service->benefits as $benefit)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $benefit->title }}</strong></td>
                  <td>
                    <span style="max-width:300px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                      {!! strip_tags($benefit->description) !!}
                    </span>
                  </td>
                  <td>{{ $benefit->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      {{-- Edit: passes all field values as data-* attrs --}}
                      <a class="me-2 p-2" href="#"
                        data-bs-toggle="modal" data-bs-target="#benefitModal"
                        data-mode="edit"
                        data-id="{{ $benefit->id }}"
                        data-section-heading="{{ $benefit->section_heading }}"
                        data-section-subtitle="{{ $benefit->section_subtitle }}"
                        data-title="{{ $benefit->title }}"
                        data-description="{{ e($benefit->description) }}"
                        data-sort="{{ $benefit->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.services.benefits.destroy', [$service, $benefit]) }}"
                        method="POST" onsubmit="return confirm('Delete this benefit?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 border-0 bg-transparent text-danger">
                          <i data-feather="trash-2" class="feather-14"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">No benefits yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- ══════════════════════════════════════════════
         TAB 3 — TALK TO US
         Single record. Avatar with live preview.
    ══════════════════════════════════════════════ --}}
    <div class="tab-pane fade" id="tab-talk">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Talk To Us Section</h5>
        </div>
        <div class="card-body">
          <form
            action="{{ $service->talkToUs
                            ? route('admin.services.talk.update', [$service, $service->talkToUs])
                            : route('admin.services.talk.store', $service) }}"
            method="POST"
            enctype="multipart/form-data"
            data-submit-spinner
            data-spinner-text="Saving...">
            @csrf
            @if($service->talkToUs) @method('PATCH') @endif

            <div class="row">
              {{-- Person info + avatar --}}
              <div class="col-md-3 text-center">
                <div class="mb-3">
                  {{-- Avatar preview — data-preview-target picked up by service-detail.js --}}
                  <div class="mb-2">
                    <img id="avatar-preview"
                      src="{{ $service->talkToUs?->person_avatar
                                                ? asset('storage/' . $service->talkToUs->person_avatar)
                                                : asset('dashboard_assets/img/user-icon.jpg') }}"
                      class="rounded-circle"
                      style="width:90px;height:90px;object-fit:cover;border:3px solid #e9ecef;"
                      alt="Avatar">
                  </div>
                  <label for="avatar-input" class="upload-label btn-sm w-100">
                    <i class="ti ti-upload me-1"></i>Upload Avatar
                  </label>
                  <input type="file" name="person_avatar" id="avatar-input"
                    class="d-none" accept="image/*"
                    data-preview-target="#avatar-preview">
                </div>
                <div class="mb-3">
                  <label class="form-label">Person Name</label>
                  <input type="text" name="person_name" class="form-control text-center"
                    value="{{ old('person_name', $service->talkToUs?->person_name) }}"
                    placeholder="e.g. Dmytro Lebid">
                </div>
                <div class="mb-3">
                  <label class="form-label">Person Role</label>
                  <input type="text" name="person_role" class="form-control text-center"
                    value="{{ old('person_role', $service->talkToUs?->person_role) }}"
                    placeholder="e.g. Co-Founder & CTO">
                </div>
              </div>

              {{-- CTA content --}}
              <div class="col-md-9">
                <div class="mb-3">
                  <label class="form-label">Headline <span class="text-danger">*</span></label>
                  <input type="text" name="headline" class="form-control"
                    value="{{ old('headline', $service->talkToUs?->headline) }}"
                    placeholder="e.g. Talk to the people who will actually build your product"
                    required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Subtext</label>
                  <input type="text" name="subtext" class="form-control"
                    value="{{ old('subtext', $service->talkToUs?->subtext) }}"
                    placeholder="e.g. Get MVP Scope & Timeline">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">CTA Label <span class="text-danger">*</span></label>
                      <input type="text" name="cta_label" class="form-control"
                        value="{{ old('cta_label', $service->talkToUs?->cta_label) }}"
                        placeholder="e.g. Get MVP Scope & Timeline" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">CTA URL <span class="text-danger">*</span></label>
                      <input type="text" name="cta_url" class="form-control"
                        value="{{ old('cta_url', $service->talkToUs?->cta_url) }}"
                        placeholder="/contact" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-end mt-2">
              <button type="submit" class="btn btn-secondary">
                <i class="ti ti-device-floppy me-1"></i>
                {{ $service->talkToUs ? 'Update Section' : 'Save Section' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>


    {{-- ══════════════════════════════════════════════
         TAB 4 — PROCESS STEPS  (table + single modal)
         Add button opens modal empty.
         Edit icon pre-fills modal via data-* attrs.
    ══════════════════════════════════════════════ --}}
    <div class="tab-pane fade" id="tab-process">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Development Process</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#processModal" data-mode="add">
            <i class="ti ti-circle-plus me-1"></i>Add Step
          </button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Step Title</th>
                  <th>Description</th>
                  <th>Order</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($service->processSteps as $step)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $step->title }}</strong></td>
                  <td><span style="max-width:300px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{!! strip_tags($step->description) !!}</span></td>
                  <td>{{ $step->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#processModal"
                        data-mode="edit"
                        data-id="{{ $step->id }}"
                        data-section-heading="{{ $step->section_heading }}"
                        data-section-subtitle="{{ $step->section_subtitle }}"
                        data-title="{{ $step->title }}"
                        data-description="{{ e($step->description) }}"
                        data-sort="{{ $step->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.services.process.destroy', [$service, $step]) }}" method="POST" onsubmit="return confirm('Delete this step?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 border-0 bg-transparent text-danger"><i data-feather="trash-2" class="feather-14"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">No process steps yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- ══════════════════════════════════════════════
         TAB 5 — TECH STACK
         Groups table + modal. Tags managed inline per group row.
    ══════════════════════════════════════════════ --}}
    <div class="tab-pane fade" id="tab-tech">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Tech Stack</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#techGroupModal" data-mode="add">
            <i class="ti ti-circle-plus me-1"></i>Add Group
          </button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Group Name</th>
                  <th>Tags</th>
                  <th>Order</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($service->techGroups as $group)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $group->group_name }}</strong></td>
                  <td>
                    <div class="d-flex flex-wrap gap-1">
                      @foreach($group->tags as $tag)
                      <span class="badge {{ $tag->is_featured ? 'bg-secondary' : 'bg-light text-dark border' }} d-inline-flex align-items-center gap-1">
                        {{ $tag->name }}
                        <form action="{{ route('admin.services.techtags.destroy', [$service, $group, $tag]) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove tag?')">
                          @csrf @method('DELETE')
                          <button type="submit" class="border-0 bg-transparent p-0 ms-1" style="line-height:1;color:inherit;opacity:.6;font-size:14px;">&times;</button>
                        </form>
                      </span>
                      @endforeach
                      {{-- Inline add tag form --}}
                      <form action="{{ route('admin.services.techtags.store', [$service, $group]) }}" method="POST" class="d-inline-flex align-items-center gap-1 ms-1">
                        @csrf
                        <input type="text" name="name" class="form-control form-control-sm" style="width:100px;" placeholder="Add tag" required>
                        <button type="submit" class="btn btn-secondary btn-xs px-2 py-1" style="font-size:11px;">+</button>
                      </form>
                    </div>
                  </td>
                  <td>{{ $group->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#techGroupModal"
                        data-mode="edit"
                        data-id="{{ $group->id }}"
                        data-section-heading="{{ $group->section_heading }}"
                        data-section-subtitle="{{ $group->section_subtitle }}"
                        data-group-name="{{ $group->group_name }}"
                        data-sort="{{ $group->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.services.techgroups.destroy', [$service, $group]) }}" method="POST" onsubmit="return confirm('Delete this group and all its tags?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 border-0 bg-transparent text-danger"><i data-feather="trash-2" class="feather-14"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">No tech groups yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- ══════════════════════════════════════════════
         TAB 6 — TESTIMONIALS  (table + modal)
    ══════════════════════════════════════════════ --}}
    <div class="tab-pane fade" id="tab-testimonials">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Testimonials</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#testimonialModal" data-mode="add">
            <i class="ti ti-circle-plus me-1"></i>Add Testimonial
          </button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Client</th>
                  <th>Quote</th>
                  <th>Rating</th>
                  <th>Order</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($service->testimonials as $testimonial)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    <strong>{{ $testimonial->client_name }}</strong>
                    @if($testimonial->client_role)<br><small class="text-muted">{{ $testimonial->client_role }}</small>@endif
                  </td>
                  <td><span style="max-width:280px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $testimonial->quote }}</span></td>
                  <td>
                    @for($i=1;$i<=5;$i++)<i class="ti ti-star{{ $i<=$testimonial->rating ? '-filled text-warning' : ' text-muted' }}" style="font-size:12px;"></i>@endfor
                  </td>
                  <td>{{ $testimonial->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#testimonialModal"
                        data-mode="edit"
                        data-id="{{ $testimonial->id }}"
                        data-section-heading="{{ $testimonial->section_heading }}"
                        data-section-subtitle="{{ $testimonial->section_subtitle }}"
                        data-quote="{{ e($testimonial->quote) }}"
                        data-client-name="{{ $testimonial->client_name }}"
                        data-client-role="{{ $testimonial->client_role }}"
                        data-rating="{{ $testimonial->rating }}"
                        data-sort="{{ $testimonial->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.services.testimonials.destroy', [$service, $testimonial]) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 border-0 bg-transparent text-danger"><i data-feather="trash-2" class="feather-14"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-4">No testimonials yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- ══════════════════════════════════════════════
         TAB 7 — FAQs  (table + modal)
    ══════════════════════════════════════════════ --}}
    <div class="tab-pane fade" id="tab-faqs">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">FAQs</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#faqModal" data-mode="add">
            <i class="ti ti-circle-plus me-1"></i>Add FAQ
          </button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Question</th>
                  <th>Answer</th>
                  <th>Order</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($service->faqs as $faq)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $faq->question }}</strong></td>
                  <td><span style="max-width:300px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{!! strip_tags($faq->answer) !!}</span></td>
                  <td>{{ $faq->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#faqModal"
                        data-mode="edit"
                        data-id="{{ $faq->id }}"
                        data-section-heading="{{ $faq->section_heading }}"
                        data-section-subtitle="{{ $faq->section_subtitle }}"
                        data-question="{{ $faq->question }}"
                        data-answer="{{ e($faq->answer) }}"
                        data-sort="{{ $faq->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.services.faqs.destroy', [$service, $faq]) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 border-0 bg-transparent text-danger"><i data-feather="trash-2" class="feather-14"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">No FAQs yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- ══════════════════════════════════════════════
         TAB 8 — RELATED SERVICES  (table + modal)
    ══════════════════════════════════════════════ --}}
    <div class="tab-pane fade" id="tab-related">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Related Services</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#relatedModal">
            <i class="ti ti-circle-plus me-1"></i>Add Related
          </button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Service</th>
                  <th>Category</th>
                  <th>Order</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($service->relatedServices as $related)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $related->relatedService->name }}</strong></td>
                  <td><span class="badge bg-light text-dark border">{{ $related->relatedService->category->name }}</span></td>
                  <td>{{ $related->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <form action="{{ route('admin.services.related.destroy', [$service, $related]) }}" method="POST" onsubmit="return confirm('Remove?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 border-0 bg-transparent text-danger"><i data-feather="trash-2" class="feather-14"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">No related services yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>{{-- end .tab-content --}}
</div>{{-- end .content --}}

{{-- ════════════════════════════════════════════════════════
     MODALS — one per multi-record section.
     Same modal handles Add and Edit:
       data-mode="add"  → empty form, POST action
       data-mode="edit" → pre-filled form, PATCH action
     JS in service-detail.js wires this up on show.bs.modal.
════════════════════════════════════════════════════════ --}}

{{-- ── BENEFIT MODAL ── --}}
<div class="modal fade" id="benefitModal" tabindex="-1"
  data-store-url="{{ route('admin.services.benefits.store', $service) }}"
  data-update-base="{{ url('admin/services/' . $service->slug . '/benefits') }}">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="benefitModalTitle">Add Benefit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="benefitForm" method="POST" data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <span id="benefitMethodField"></span>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Heading</label>
                <input type="text" name="section_heading" id="b_section_heading" class="form-control" placeholder="e.g. WEB APPLICATION DEVELOPMENT SERVICES">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="b_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="b_title" class="form-control" placeholder="e.g. Clear Scope and Product Direction" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="hidden" name="description" id="b_description_input">
            <div data-quill-editor data-quill-input="b_description_input" id="b_description_editor"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="b_sort" class="form-control" value="0" min="0">
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" id="benefitSubmitBtn">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── PROCESS MODAL ── --}}
<div class="modal fade" id="processModal" tabindex="-1"
  data-store-url="{{ route('admin.services.process.store', $service) }}"
  data-update-base="{{ url('admin/services/' . $service->slug . '/process') }}">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="processModalTitle">Add Process Step</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="processForm" method="POST" data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <span id="processMethodField"></span>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Heading</label>
                <input type="text" name="section_heading" id="p_section_heading" class="form-control" placeholder="e.g. Our Development Process">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="p_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Step Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="p_title" class="form-control" placeholder="e.g. Analysis" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="hidden" name="description" id="p_description_input">
            <div data-quill-editor data-quill-input="p_description_input" id="p_description_editor"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="p_sort" class="form-control" value="0" min="0">
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary" id="processSubmitBtn">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── TECH GROUP MODAL ── --}}
<div class="modal fade" id="techGroupModal" tabindex="-1"
  data-store-url="{{ route('admin.services.techgroups.store', $service) }}"
  data-update-base="{{ url('admin/services/' . $service->slug . '/techgroups') }}">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="techGroupModalTitle">Add Tech Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="techGroupForm" method="POST" data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <span id="techGroupMethodField"></span>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Heading</label>
                <input type="text" name="section_heading" id="tg_section_heading" class="form-control" placeholder="e.g. Technologies We Use">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="tg_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Group Name <span class="text-danger">*</span></label>
            <input type="text" name="group_name" id="tg_group_name" class="form-control" placeholder="e.g. Frontend, Backend, Database" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="tg_sort" class="form-control" value="0" min="0">
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── TESTIMONIAL MODAL ── --}}
<div class="modal fade" id="testimonialModal" tabindex="-1"
  data-store-url="{{ route('admin.services.testimonials.store', $service) }}"
  data-update-base="{{ url('admin/services/' . $service->slug . '/testimonials') }}">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="testimonialModalTitle">Add Testimonial</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="testimonialForm" method="POST" data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <span id="testimonialMethodField"></span>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Heading</label>
                <input type="text" name="section_heading" id="t_section_heading" class="form-control" placeholder="e.g. What Our Clients Say">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="t_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Quote <span class="text-danger">*</span></label>
            <textarea name="quote" id="t_quote" class="form-control" rows="3" required></textarea>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="mb-3">
                <label class="form-label">Client Name <span class="text-danger">*</span></label>
                <input type="text" name="client_name" id="t_client_name" class="form-control" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label class="form-label">Client Role</label>
                <input type="text" name="client_role" id="t_client_role" class="form-control" placeholder="e.g. CEO at Acme">
              </div>
            </div>
            <div class="col-md-2">
              <div class="mb-3">
                <label class="form-label">Rating</label>
                <input type="number" name="rating" id="t_rating" class="form-control" value="5" min="1" max="5">
              </div>
            </div>
            <div class="col-md-1">
              <div class="mb-3">
                <label class="form-label">Order</label>
                <input type="number" name="sort_order" id="t_sort" class="form-control" value="0" min="0">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── FAQ MODAL ── --}}
<div class="modal fade" id="faqModal" tabindex="-1"
  data-store-url="{{ route('admin.services.faqs.store', $service) }}"
  data-update-base="{{ url('admin/services/' . $service->slug . '/faqs') }}">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="faqModalTitle">Add FAQ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="faqForm" method="POST" data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <span id="faqMethodField"></span>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Heading</label>
                <input type="text" name="section_heading" id="f_section_heading" class="form-control" placeholder="e.g. Frequently Asked Questions">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="f_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Question <span class="text-danger">*</span></label>
            <input type="text" name="question" id="f_question" class="form-control" placeholder="e.g. How much do web development services cost?" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Answer <span class="text-danger">*</span></label>
            <input type="hidden" name="answer" id="f_answer_input">
            <div data-quill-editor data-quill-input="f_answer_input" id="f_answer_editor"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="f_sort" class="form-control" value="0" min="0">
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── RELATED SERVICE MODAL ── --}}
<div class="modal fade" id="relatedModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Related Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.services.related.store', $service) }}" method="POST" data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Service <span class="text-danger">*</span></label>
            <select name="related_service_id" class="form-select" required>
              <option value="">Select a service</option>
              @foreach($allServices as $s)
              <option value="{{ $s->id }}">{{ $s->name }} — {{ $s->category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Section Heading</label>
            <input type="text" name="section_heading" class="form-control" placeholder="e.g. Additional Services">
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ $service->relatedServices->count() }}" min="0">
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Add Related</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
