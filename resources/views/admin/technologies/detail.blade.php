@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/quill/quill.snow.css') }}">
<style>
  .ql-container {
    min-height: 140px;
    font-size: 14px;
  }

  .nav-pills .nav-link {
    color: #67748e;
    font-weight: 500;
    border-radius: 6px;
  }

  .nav-pills .nav-link.active {
    background: #43baff;
    color: #fff;
  }
</style>
@endpush

@push('scripts')
<script src="{{ asset('dashboard_assets/plugins/quill/quill.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/service-detail.js') }}"></script>
@endpush

@section('content')
<div class="content">

  <div class="page-header">
    <div class="page-title">
      <h4>{{ $technology->name }}</h4>
      <h6>Edit technology detail sections</h6>
    </div>
    <div class="page-btn">
      <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary">
        <i class="ti ti-arrow-left me-1"></i>Back to Technologies
      </a>
    </div>
  </div>

  {{-- Tab Navigation --}}
  <ul class="nav nav-pills mb-3 flex-wrap gap-1" id="detailTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="pill" href="#tab-hero">Hero</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-advantages">Advantages</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-benefits">Benefits</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-why-us">Why Choose Us</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-process">Process</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#tab-faqs">FAQs</a></li>
  </ul>

  <div class="tab-content">

    {{-- ══ TAB 1 — HERO (single record, inline form) ══ --}}
    <div class="tab-pane fade show active" id="tab-hero">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Hero Section</h5>
        </div>
        <div class="card-body">
          <form
            action="{{ $technology->hero
                            ? route('admin.technologies.hero.update', [$technology, $technology->hero])
                            : route('admin.technologies.hero.store', $technology) }}"
            method="POST" enctype="multipart/form-data"
            data-submit-spinner data-spinner-text="Saving...">
            @csrf
            @if($technology->hero) @method('PATCH') @endif

            <div class="row">
              <div class="col-md-8">
                <div class="mb-3">
                  <label class="form-label">Headline <span class="text-danger">*</span></label>
                  <input type="text" name="headline" class="form-control"
                    value="{{ old('headline', $technology->hero?->headline) }}"
                    placeholder="e.g. Laravel Development Company" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Description</label>
                  <input type="hidden" name="description" id="hero-desc-input"
                    value="{{ old('description', $technology->hero?->description) }}">
                  <div data-quill-editor data-quill-input="hero-desc-input">
                    {!! old('description', $technology->hero?->description) !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">CTA Label</label>
                      <input type="text" name="cta_label" class="form-control"
                        value="{{ old('cta_label', $technology->hero?->cta_label) }}"
                        placeholder="e.g. Get A Free Estimation">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">CTA URL</label>
                      <input type="text" name="cta_url" class="form-control"
                        value="{{ old('cta_url', $technology->hero?->cta_url) }}"
                        placeholder="/contact">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label">Hero Image</label>
                  @if($technology->hero?->image)
                  <div class="mb-2">
                    <img src="{{ asset('storage/' . $technology->hero->image) }}"
                      class="img-thumbnail" style="max-height:100px;" alt="Hero">
                  </div>
                  @endif
                  <label for="hero-img-input" class="upload-label w-100">
                    <i class="ti ti-upload me-1"></i>
                    {{ $technology->hero?->image ? 'Change Image' : 'Upload Image' }}
                  </label>
                  <input type="file" name="image" id="hero-img-input"
                    class="d-none" accept="image/*"
                    data-preview-target="#hero-img-preview"
                    data-preview-wrap="#hero-img-wrap">
                  <div id="hero-img-wrap" style="{{ $technology->hero?->image ? '' : 'display:none;' }} margin-top:8px;">
                    <img id="hero-img-preview"
                      src="{{ $technology->hero?->image ? asset('storage/' . $technology->hero->image) : '' }}"
                      class="img-thumbnail" style="max-height:100px;">
                  </div>
                  <small class="text-muted d-block mt-1">Recommended: 1200×600px</small>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-secondary">
                <i class="ti ti-device-floppy me-1"></i>
                {{ $technology->hero ? 'Update Hero' : 'Save Hero' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- ══ TABS 2–6: Advantages, Benefits, Why Us, Process, FAQs ══
             All follow the same table + modal pattern.
             Add button opens modal empty (POST).
             Edit icon pre-fills modal from data-* attrs (PATCH).
        ══ --}}

    {{-- TAB 2 — ADVANTAGES --}}
    <div class="tab-pane fade" id="tab-advantages">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Advantages</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
            data-bs-target="#advantageModal" data-mode="add">
            <i class="ti ti-circle-plus me-1"></i>Add Advantage
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
                @forelse($technology->advantages as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $item->title }}</strong></td>
                  <td><span style="max-width:300px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{!! strip_tags($item->description) !!}</span></td>
                  <td>{{ $item->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#"
                        data-bs-toggle="modal" data-bs-target="#advantageModal"
                        data-mode="edit"
                        data-id="{{ $item->id }}"
                        data-section-heading="{{ $item->section_heading }}"
                        data-section-subtitle="{{ $item->section_subtitle }}"
                        data-title="{{ $item->title }}"
                        data-description="{{ e($item->description) }}"
                        data-sort="{{ $item->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.technologies.advantages.destroy', [$technology, $item]) }}"
                        method="POST" onsubmit="return confirm('Delete?')">
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
                  <td colspan="5" class="text-center text-muted py-4">No advantages yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- TAB 3 — BENEFITS --}}
    <div class="tab-pane fade" id="tab-benefits">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Benefits</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
            data-bs-target="#benefitModal" data-mode="add">
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
                @forelse($technology->benefits as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $item->title }}</strong></td>
                  <td><span style="max-width:300px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{!! strip_tags($item->description) !!}</span></td>
                  <td>{{ $item->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#"
                        data-bs-toggle="modal" data-bs-target="#benefitModal"
                        data-mode="edit"
                        data-id="{{ $item->id }}"
                        data-section-heading="{{ $item->section_heading }}"
                        data-section-subtitle="{{ $item->section_subtitle }}"
                        data-title="{{ $item->title }}"
                        data-description="{{ e($item->description) }}"
                        data-sort="{{ $item->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.technologies.benefits.destroy', [$technology, $item]) }}"
                        method="POST" onsubmit="return confirm('Delete?')">
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

    {{-- TAB 4 — WHY CHOOSE US --}}
    <div class="tab-pane fade" id="tab-why-us">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Why Choose Us</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
            data-bs-target="#whyUsModal" data-mode="add">
            <i class="ti ti-circle-plus me-1"></i>Add Item
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
                @forelse($technology->whyUs as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $item->title }}</strong></td>
                  <td><span style="max-width:300px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{!! strip_tags($item->description) !!}</span></td>
                  <td>{{ $item->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#"
                        data-bs-toggle="modal" data-bs-target="#whyUsModal"
                        data-mode="edit"
                        data-id="{{ $item->id }}"
                        data-section-heading="{{ $item->section_heading }}"
                        data-section-subtitle="{{ $item->section_subtitle }}"
                        data-title="{{ $item->title }}"
                        data-description="{{ e($item->description) }}"
                        data-sort="{{ $item->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.technologies.why-us.destroy', [$technology, $item]) }}"
                        method="POST" onsubmit="return confirm('Delete?')">
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
                  <td colspan="5" class="text-center text-muted py-4">No items yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- TAB 5 — PROCESS --}}
    <div class="tab-pane fade" id="tab-process">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Development Process</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
            data-bs-target="#processModal" data-mode="add">
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
                @forelse($technology->processes as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $item->title }}</strong></td>
                  <td><span style="max-width:300px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{!! strip_tags($item->description) !!}</span></td>
                  <td>{{ $item->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#"
                        data-bs-toggle="modal" data-bs-target="#processModal"
                        data-mode="edit"
                        data-id="{{ $item->id }}"
                        data-section-heading="{{ $item->section_heading }}"
                        data-section-subtitle="{{ $item->section_subtitle }}"
                        data-title="{{ $item->title }}"
                        data-description="{{ e($item->description) }}"
                        data-sort="{{ $item->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.technologies.process.destroy', [$technology, $item]) }}"
                        method="POST" onsubmit="return confirm('Delete?')">
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
                  <td colspan="5" class="text-center text-muted py-4">No process steps yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- TAB 6 — FAQs --}}
    <div class="tab-pane fade" id="tab-faqs">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">FAQs</h5>
          <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
            data-bs-target="#faqModal" data-mode="add">
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
                @forelse($technology->faqs as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><strong>{{ $item->question }}</strong></td>
                  <td><span style="max-width:300px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{!! strip_tags($item->answer) !!}</span></td>
                  <td>{{ $item->sort_order }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="#"
                        data-bs-toggle="modal" data-bs-target="#faqModal"
                        data-mode="edit"
                        data-id="{{ $item->id }}"
                        data-section-heading="{{ $item->section_heading }}"
                        data-section-subtitle="{{ $item->section_subtitle }}"
                        data-question="{{ $item->question }}"
                        data-answer="{{ e($item->answer) }}"
                        data-sort="{{ $item->sort_order }}">
                        <i data-feather="edit" class="feather-14"></i>
                      </a>
                      <form action="{{ route('admin.technologies.faqs.destroy', [$technology, $item]) }}"
                        method="POST" onsubmit="return confirm('Delete?')">
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
                  <td colspan="5" class="text-center text-muted py-4">No FAQs yet.</td>
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
     Same modal handles Add and Edit.
     Routes are passed via data-store-url / data-update-base on the modal div.
════════════════════════════════════════════════════════ --}}

{{-- ── ADVANTAGE MODAL ── --}}
<div class="modal fade" id="advantageModal" tabindex="-1"
  data-store-url="{{ route('admin.technologies.advantages.store', $technology) }}"
  data-update-base="{{ url('admin/technologies/' . $technology->slug . '/advantages') }}">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="advantageModalTitle">Add Advantage</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="advantageForm" method="POST" data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <span id="advantageMethodField"></span>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Heading <small class="text-muted">(first item only)</small></label>
                <input type="text" name="section_heading" id="adv_section_heading" class="form-control" placeholder="e.g. Advantages">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="adv_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="adv_title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="hidden" name="description" id="adv_desc_input">
            <div data-quill-editor data-quill-input="adv_desc_input" id="adv_desc_editor"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="adv_sort" class="form-control" value="0" min="0">
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

{{-- ── BENEFIT MODAL ── --}}
<div class="modal fade" id="benefitModal" tabindex="-1"
  data-store-url="{{ route('admin.technologies.benefits.store', $technology) }}"
  data-update-base="{{ url('admin/technologies/' . $technology->slug . '/benefits') }}">
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
                <input type="text" name="section_heading" id="ben_section_heading" class="form-control" placeholder="e.g. What Are The Benefits of Laravel">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="ben_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="ben_title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="hidden" name="description" id="ben_desc_input">
            <div data-quill-editor data-quill-input="ben_desc_input" id="ben_desc_editor"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="ben_sort" class="form-control" value="0" min="0">
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

{{-- ── WHY US MODAL ── --}}
<div class="modal fade" id="whyUsModal" tabindex="-1"
  data-store-url="{{ route('admin.technologies.why-us.store', $technology) }}"
  data-update-base="{{ url('admin/technologies/' . $technology->slug . '/why-us') }}">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="whyUsModalTitle">Add Why Choose Us Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="whyUsForm" method="POST" data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <span id="whyUsMethodField"></span>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Heading</label>
                <input type="text" name="section_heading" id="wu_section_heading" class="form-control" placeholder="e.g. Why Choose Us">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="wu_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="wu_title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="hidden" name="description" id="wu_desc_input">
            <div data-quill-editor data-quill-input="wu_desc_input" id="wu_desc_editor"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="wu_sort" class="form-control" value="0" min="0">
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

{{-- ── PROCESS MODAL ── --}}
<div class="modal fade" id="processModal" tabindex="-1"
  data-store-url="{{ route('admin.technologies.process.store', $technology) }}"
  data-update-base="{{ url('admin/technologies/' . $technology->slug . '/process') }}">
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
                <input type="text" name="section_heading" id="pr_section_heading" class="form-control" placeholder="e.g. Our Laravel Development Process">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="pr_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Step Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="pr_title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="hidden" name="description" id="pr_desc_input">
            <div data-quill-editor data-quill-input="pr_desc_input" id="pr_desc_editor"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="pr_sort" class="form-control" value="0" min="0">
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
  data-store-url="{{ route('admin.technologies.faqs.store', $technology) }}"
  data-update-base="{{ url('admin/technologies/' . $technology->slug . '/faqs') }}">
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
                <input type="text" name="section_heading" id="faq_section_heading" class="form-control" placeholder="e.g. Frequently Asked Questions">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Section Subtitle</label>
                <input type="text" name="section_subtitle" id="faq_section_subtitle" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Question <span class="text-danger">*</span></label>
            <input type="text" name="question" id="faq_question" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Answer <span class="text-danger">*</span></label>
            <input type="hidden" name="answer" id="faq_answer_input">
            <div data-quill-editor data-quill-input="faq_answer_input" id="faq_answer_editor"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="faq_sort" class="form-control" value="0" min="0">
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

@push('scripts')
<script>
  /**
   * Technology detail page modal wiring.
   * Reuses the same setMethod / setQuill helpers from service-detail.js.
   * Each modal reads data-store-url and data-update-base from its own div.
   */
  document.addEventListener('DOMContentLoaded', function() {

    // Generic wiring function — used for all 5 section modals
    function wireModal(modalId, formId, titleId, methodFieldId, fields, quillFields) {
      var modal = document.getElementById(modalId);
      if (!modal) return;

      var storeUrl = modal.getAttribute('data-store-url') || '';
      var updateBase = modal.getAttribute('data-update-base') || '';

      modal.addEventListener('show.bs.modal', function(e) {
        var btn = e.relatedTarget;
        var mode = btn ? btn.getAttribute('data-mode') : 'add';
        var form = document.getElementById(formId);

        document.getElementById(titleId).textContent =
          mode === 'edit' ? 'Edit ' + document.getElementById(titleId).textContent.replace('Add ', '') : document.getElementById(titleId).textContent;

        if (mode === 'edit') {
          form.action = updateBase + '/' + btn.getAttribute('data-id');
          setMethod(methodFieldId, 'PATCH');
          // Fill plain text fields
          fields.forEach(function(f) {
            var el = document.getElementById(f.id);
            if (el) el.value = btn.getAttribute(f.attr) || '';
          });
          // Fill Quill editors
          if (quillFields) {
            quillFields.forEach(function(q) {
              var editorEl = document.getElementById(q.editorId);
              if (editorEl) {
                if (typeof Quill !== 'undefined') mountQuill(editorEl);
                setQuill(editorEl, q.inputId, btn.getAttribute(q.attr) || '');
              }
            });
          }
        } else {
          form.action = storeUrl;
          setMethod(methodFieldId, null);
          fields.forEach(function(f) {
            var el = document.getElementById(f.id);
            if (el) el.value = '';
          });
          if (quillFields) {
            quillFields.forEach(function(q) {
              var editorEl = document.getElementById(q.editorId);
              if (editorEl) {
                if (typeof Quill !== 'undefined') mountQuill(editorEl);
                setQuill(editorEl, q.inputId, '');
              }
            });
          }
        }
        feather.replace();
      });
    }

    // Wire all 5 section modals
    wireModal('advantageModal', 'advantageForm', 'advantageModalTitle', 'advantageMethodField',
      [{
          id: 'adv_section_heading',
          attr: 'data-section-heading'
        },
        {
          id: 'adv_section_subtitle',
          attr: 'data-section-subtitle'
        },
        {
          id: 'adv_title',
          attr: 'data-title'
        },
        {
          id: 'adv_sort',
          attr: 'data-sort'
        },
      ],
      [{
        editorId: 'adv_desc_editor',
        inputId: 'adv_desc_input',
        attr: 'data-description'
      }]
    );

    wireModal('benefitModal', 'benefitForm', 'benefitModalTitle', 'benefitMethodField',
      [{
          id: 'ben_section_heading',
          attr: 'data-section-heading'
        },
        {
          id: 'ben_section_subtitle',
          attr: 'data-section-subtitle'
        },
        {
          id: 'ben_title',
          attr: 'data-title'
        },
        {
          id: 'ben_sort',
          attr: 'data-sort'
        },
      ],
      [{
        editorId: 'ben_desc_editor',
        inputId: 'ben_desc_input',
        attr: 'data-description'
      }]
    );

    wireModal('whyUsModal', 'whyUsForm', 'whyUsModalTitle', 'whyUsMethodField',
      [{
          id: 'wu_section_heading',
          attr: 'data-section-heading'
        },
        {
          id: 'wu_section_subtitle',
          attr: 'data-section-subtitle'
        },
        {
          id: 'wu_title',
          attr: 'data-title'
        },
        {
          id: 'wu_sort',
          attr: 'data-sort'
        },
      ],
      [{
        editorId: 'wu_desc_editor',
        inputId: 'wu_desc_input',
        attr: 'data-description'
      }]
    );

    wireModal('processModal', 'processForm', 'processModalTitle', 'processMethodField',
      [{
          id: 'pr_section_heading',
          attr: 'data-section-heading'
        },
        {
          id: 'pr_section_subtitle',
          attr: 'data-section-subtitle'
        },
        {
          id: 'pr_title',
          attr: 'data-title'
        },
        {
          id: 'pr_sort',
          attr: 'data-sort'
        },
      ],
      [{
        editorId: 'pr_desc_editor',
        inputId: 'pr_desc_input',
        attr: 'data-description'
      }]
    );

    wireModal('faqModal', 'faqForm', 'faqModalTitle', 'faqMethodField',
      [{
          id: 'faq_section_heading',
          attr: 'data-section-heading'
        },
        {
          id: 'faq_section_subtitle',
          attr: 'data-section-subtitle'
        },
        {
          id: 'faq_question',
          attr: 'data-question'
        },
        {
          id: 'faq_sort',
          attr: 'data-sort'
        },
      ],
      [{
        editorId: 'faq_answer_editor',
        inputId: 'faq_answer_input',
        attr: 'data-answer'
      }]
    );

  });
</script>
@endpush

@endsection
