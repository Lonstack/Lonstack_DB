@extends('layouts.admin')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/quill/quill.core.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/quill/quill.snow.css') }}">
@endpush

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Portfolio</h4>
                <h6>Manage your portfolio items</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_portfolio">
                <i class="ti ti-circle-plus me-1"></i>Add Portfolio
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:80px;">Image</th>
                            <th>Title</th>
                            <th>Service</th>
                            <th>Client</th>
                            <th>Location</th>
                            <th style="width:100px;">Published</th>
                            <th style="width:90px;">Status</th>
                            <th style="width:60px;">Order</th>
                            <th style="width:80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="portfolioBody">
                        @forelse ($portfolios as $p)
                        <tr data-id="{{ $p->id }}">
                            <td>
                                @if ($p->cover_image)
                                    <img src="{{ asset('storage/' . $p->cover_image) }}"
                                         style="width:64px;height:48px;object-fit:cover;border-radius:4px;" alt="">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light"
                                         style="width:64px;height:48px;border-radius:4px;">
                                        <i class="ti ti-photo text-muted fs-18"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-medium">
                                {{ $p->title }}
                                @if ($p->tags)
                                    <div class="mt-1">
                                        @foreach ($p->tags as $tag)
                                            <span class="badge bg-light text-dark fs-11">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="text-muted fs-13">{{ $p->service->name ?? '—' }}</td>
                            <td class="text-muted fs-13">{{ $p->client ?? '—' }}</td>
                            <td class="text-muted fs-13">{{ $p->location ?? '—' }}</td>
                            <td class="text-muted fs-13">{{ $p->published_at?->format('M d, Y') ?? '—' }}</td>
                            <td>
                                @if ($p->is_active)
                                    <button type="button" class="badge badge-success border-0 toggle-status-btn"
                                            data-id="{{ $p->id }}" data-slug="{{ $p->slug }}"
                                            style="cursor:pointer;" title="Click to deactivate">
                                        <i class="ti ti-point-filled"></i> Active
                                    </button>
                                @else
                                    <button type="button" class="badge badge-danger border-0 toggle-status-btn"
                                            data-id="{{ $p->id }}" data-slug="{{ $p->slug }}"
                                            style="cursor:pointer;" title="Click to activate">
                                        <i class="ti ti-point-filled"></i> Inactive
                                    </button>
                                @endif
                            </td>
                            <td class="text-center text-muted fs-13">{{ $p->sort_order }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <a href="#" class="p-1 edit-btn"
                                       data-id="{{ $p->id }}"
                                       data-slug="{{ $p->slug }}"
                                       data-service-id="{{ $p->service_id }}"
                                       data-title="{{ $p->title }}"
                                       data-client="{{ $p->client }}"
                                       data-location="{{ $p->location }}"
                                       data-published="{{ $p->published_at?->format('Y-m-d') }}"
                                       data-excerpt="{{ $p->excerpt }}"
                                       data-description="{{ e($p->description) }}"
                                       data-summary="{{ e($p->summary) }}"
                                       data-challenge="{{ e($p->challenge) }}"
                                       data-solution="{{ e($p->solution) }}"
                                       data-technologies="{{ $p->technologies ? implode(', ', $p->technologies) : '' }}"
                                       data-features="{{ $p->features ? implode(', ', $p->features) : '' }}"
                                       data-tags="{{ $p->tags ? implode(', ', $p->tags) : '' }}"
                                       data-is-active="{{ $p->is_active ? 1 : 0 }}"
                                       data-sort="{{ $p->sort_order }}"
                                       data-cover="{{ $p->cover_image ? asset('storage/' . $p->cover_image) : '' }}"
                                       data-gallery='@json(collect($p->gallery ?? [])->map(fn($g) => ["path" => $g, "url" => asset("storage/".$g)])->values())'
                                       data-bs-toggle="modal" data-bs-target="#edit_portfolio">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="#" class="p-1 delete-btn"
                                       data-id="{{ $p->id }}"
                                       data-slug="{{ $p->slug }}"
                                       data-bs-toggle="modal" data-bs-target="#delete_modal">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="ti ti-briefcase fs-36 d-block mb-2"></i>
                                No portfolio items yet. Add your first one.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($portfolios->hasPages())
        <div class="card-footer d-flex align-items-center justify-content-between flex-wrap row-gap-2">
            <p class="text-muted fs-13 mb-0">
                Showing {{ $portfolios->firstItem() }}–{{ $portfolios->lastItem() }} of {{ $portfolios->total() }} items
            </p>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $portfolios->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $portfolios->previousPageUrl() ?? '#' }}">&laquo;</a>
                </li>
                @foreach ($portfolios->getUrlRange(1, $portfolios->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $portfolios->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach
                <li class="page-item {{ !$portfolios->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $portfolios->nextPageUrl() ?? '#' }}">&raquo;</a>
                </li>
            </ul>
        </div>
        @endif
    </div>
</div>

{{-- ── Add Modal ──────────────────────────────────────────────────────────── --}}
<div class="modal fade" id="add_portfolio">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Portfolio Item</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form id="add-form" action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0" style="max-height:70vh; overflow-y:auto;">
                    @include('admin.portfolio._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="add-submit-btn">Add Portfolio</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ── Edit Modal ─────────────────────────────────────────────────────────── --}}
<div class="modal fade" id="edit_portfolio">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Portfolio Item</h4>
                <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form id="edit-form" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0" style="max-height:70vh; overflow-y:auto;">
                    @include('admin.portfolio._form', ['edit' => true])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" id="edit-submit-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ── Delete Modal ────────────────────────────────────────────────────────── --}}
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-soft-danger rounded-circle text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Delete Portfolio Item</h4>
                <p class="mb-3">Are you sure you want to delete this item? This cannot be undone.</p>
                <form id="delete-form" action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('dashboard_assets/plugins/quill/quill.min.js') }}"></script>
<script>
const PORTFOLIO_BASE = "{{ url('admin/portfolio') }}";
const csrfToken     = "{{ csrf_token() }}";

window.iziToastInitialized = true;

const quillOptions = {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ header: [2, 3, false] }],
            ['bold', 'italic', 'underline'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            ['link'],
            ['clean'],
        ],
    },
};

const addDescQuill      = new Quill('#add-description-editor',      quillOptions);
const addSumQuill       = new Quill('#add-summary-editor',           quillOptions);
const addChallengeQuill = new Quill('#add-challenge-editor',         quillOptions);
const addSolutionQuill  = new Quill('#add-solution-editor',          quillOptions);
const editDescQuill     = new Quill('#edit-description-editor',      quillOptions);
const editSumQuill      = new Quill('#edit-summary-editor',          quillOptions);
const editChallengeQuill= new Quill('#edit-challenge-editor',        quillOptions);
const editSolutionQuill = new Quill('#edit-solution-editor',         quillOptions);

document.addEventListener('DOMContentLoaded', function () {

    let submitting = false;
    const tbody    = document.getElementById('portfolioBody');

    const addIsActive = document.getElementById('add-is-active');
    if (addIsActive) addIsActive.checked = true;

    const addGalleryDT  = new DataTransfer();
    const editGalleryDT = new DataTransfer();

    // ── Reset Add modal fully every time it opens ─────────────────────────────
    document.getElementById('add_portfolio').addEventListener('show.bs.modal', function () {
        const form = document.getElementById('add-form');
        form.reset();

        // Clear Quill editors
        addDescQuill.setContents([]);
        addSumQuill.setContents([]);

        // Clear cover preview
        const coverPreview = document.getElementById('add-cover-preview');
        const coverImg     = document.getElementById('add-cover-img');
        if (coverPreview) coverPreview.style.display = 'none';
        if (coverImg)     coverImg.src = '';

        // Clear gallery preview and DataTransfer
        const galleryPreview = document.getElementById('add-gallery-preview');
        if (galleryPreview) galleryPreview.innerHTML = '';
        addGalleryDT.items.clear();

        // Reset is_active to checked by default
        const isActiveEl = document.getElementById('add-is-active');
        if (isActiveEl) isActiveEl.checked = true;
    });

    const GALLERY_MAX = 3;

    function addGalleryFile(file, previewId, dt, existingCountFn) {
        const existingCount = existingCountFn ? existingCountFn() : 0;
        if (existingCount + dt.files.length >= GALLERY_MAX) {
            iziToast.warning({ message: 'Maximum ' + GALLERY_MAX + ' gallery images allowed.', position: 'topRight' });
            return;
        }
        for (var i = 0; i < dt.files.length; i++) {
            if (dt.files[i].name === file.name && dt.files[i].size === file.size) return;
        }
        dt.items.add(file);

        const reader = new FileReader();
        reader.onload = function (e) {
            const container = document.getElementById(previewId);
            if (!container) return;
            const div = document.createElement('div');
            div.style.cssText = 'position:relative;display:inline-block;';
            div.innerHTML =
                '<img src="' + e.target.result + '" style="width:80px;height:60px;object-fit:cover;border-radius:4px;" alt="">'
                + '<button type="button" class="btn btn-danger btn-sm remove-new-gallery"'
                + ' style="position:absolute;top:2px;right:2px;padding:1px 5px;font-size:10px;line-height:1;">'
                + '<i class="ti ti-x"></i></button>';
            container.appendChild(div);

            div.querySelector('.remove-new-gallery').addEventListener('click', function () {
                const newDT = new DataTransfer();
                for (var i = 0; i < dt.files.length; i++) {
                    if (dt.files[i].name !== file.name || dt.files[i].size !== file.size) {
                        newDT.items.add(dt.files[i]);
                    }
                }
                dt.items.clear();
                for (var i = 0; i < newDT.files.length; i++) dt.items.add(newDT.files[i]);
                div.remove();
            });
        };
        reader.readAsDataURL(file);
    }

    function countExistingEditGallery() {
        const container = document.getElementById('edit-gallery-existing');
        if (!container) return 0;
        const total   = container.children.length;
        const removed = container.querySelectorAll('input[type="hidden"]:not([disabled])').length;
        return total - removed;
    }

    // ── Gallery change handlers ───────────────────────────────────────────────
    document.getElementById('add-gallery-input').addEventListener('change', function () {
        if (!this.files || !this.files.length) return;
        if (addGalleryDT.files.length >= GALLERY_MAX) {
            iziToast.warning({ message: 'Maximum ' + GALLERY_MAX + ' gallery images allowed.', position: 'topRight' });
            this.value = '';
            return;
        }
        Array.from(this.files).forEach(function (file) {
            addGalleryFile(file, 'add-gallery-preview', addGalleryDT, null);
        });
        this.value = '';
    });

    document.getElementById('edit-gallery-input').addEventListener('change', function () {
        if (!this.files || !this.files.length) return;
        if (countExistingEditGallery() + editGalleryDT.files.length >= GALLERY_MAX) {
            iziToast.warning({ message: 'Maximum ' + GALLERY_MAX + ' gallery images allowed.', position: 'topRight' });
            this.value = '';
            return;
        }
        Array.from(this.files).forEach(function (file) {
            addGalleryFile(file, 'edit-gallery-preview', editGalleryDT, countExistingEditGallery);
        });
        this.value = '';
    });

// ── ADD ───────────────────────────────────────────────────────────────────
document.getElementById('add-submit-btn').addEventListener('click', function () {
    if (submitting) return;
    submitting = true;

    document.getElementById('add-description-input').value = addDescQuill.root.innerHTML;
    document.getElementById('add-summary-input').value     = addSumQuill.root.innerHTML;
    document.getElementById('add-challenge-input').value   = addChallengeQuill.root.innerHTML;
    document.getElementById('add-solution-input').value    = addSolutionQuill.root.innerHTML;

    const form = document.getElementById('add-form');
    const fd   = new FormData(form);
    fd.delete('gallery[]');
    for (var i = 0; i < addGalleryDT.files.length; i++) {
        fd.append('gallery[]', addGalleryDT.files[i], addGalleryDT.files[i].name);
    }

    fetch(form.action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: fd,
    })
    .then(r => r.json())
    .then(data => {
        submitting = false;
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('add_portfolio')).hide();
            form.reset();
            addDescQuill.setContents([]);
            addSumQuill.setContents([]);
            addChallengeQuill.setContents([]);
            addSolutionQuill.setContents([]);
            document.getElementById('add-cover-preview').style.display = 'none';
            document.getElementById('add-gallery-preview').innerHTML = '';
            addGalleryDT.items.clear();
            iziToast.success({ message: data.message, position: 'topRight' });
            removeEmpty();
            const tr = document.createElement('tr');
            tr.dataset.id = data.portfolio.id;
            tr.innerHTML  = rowHtml(data.portfolio);
            tbody.insertBefore(tr, tbody.firstChild);
        }
    })
    .catch(() => { submitting = false; });
});

// ── EDIT ──────────────────────────────────────────────────────────────────
document.getElementById('edit-submit-btn').addEventListener('click', function () {
    if (submitting) return;
    submitting = true;

    document.getElementById('edit-description-input').value = editDescQuill.root.innerHTML;
    document.getElementById('edit-summary-input').value     = editSumQuill.root.innerHTML;
    document.getElementById('edit-challenge-input').value   = editChallengeQuill.root.innerHTML;
    document.getElementById('edit-solution-input').value    = editSolutionQuill.root.innerHTML;

    const form = document.getElementById('edit-form');
    const fd   = new FormData(form);
    fd.delete('gallery[]');
    for (var i = 0; i < editGalleryDT.files.length; i++) {
        fd.append('gallery[]', editGalleryDT.files[i], editGalleryDT.files[i].name);
    }

    fetch(form.action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: fd,
    })
    .then(r => r.json())
    .then(data => {
        submitting = false;
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('edit_portfolio')).hide();
            iziToast.success({ message: data.message, position: 'topRight' });
            const row = tbody.querySelector(`tr[data-id="${data.portfolio.id}"]`);
            if (row) row.innerHTML = rowHtml(data.portfolio);
        }
    })
    .catch(() => { submitting = false; });
});

    // ── DELETE ────────────────────────────────────────────────────────────────
    document.getElementById('delete-form').addEventListener('submit', function (e) {
        e.preventDefault();
        if (submitting) return;
        submitting = true;

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: '_method=DELETE',
        })
        .then(r => r.json())
        .then(data => {
            submitting = false;
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('delete_modal')).hide();
                iziToast.success({ message: data.message, position: 'topRight' });
                const row = tbody.querySelector(`tr[data-id="${this.dataset.id}"]`);
                if (row) row.remove();
                checkEmpty();
            }
        })
        .catch(() => { submitting = false; });
    });

    // ── Edit button ───────────────────────────────────────────────────────────
    document.querySelectorAll('.edit-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const f = document.getElementById('edit-form');
            f.action = `${PORTFOLIO_BASE}/${this.dataset.slug}`;

            f.querySelector('[name="service_id"]').value   = this.dataset.serviceId  || '';
            f.querySelector('[name="title"]').value        = this.dataset.title       || '';
            f.querySelector('[name="slug"]').value         = this.dataset.slug        || '';
            f.querySelector('[name="client"]').value       = this.dataset.client      || '';
            f.querySelector('[name="location"]').value     = this.dataset.location    || '';
            f.querySelector('[name="published_at"]').value = this.dataset.published   || '';
            f.querySelector('[name="excerpt"]').value      = this.dataset.excerpt     || '';
            f.querySelector('[name="tags"]').value         = this.dataset.tags        || '';
            f.querySelector('[name="sort_order"]').value   = this.dataset.sort        || '0';
            f.querySelector('[name="is_active"]').checked  = this.dataset.isActive    == '1';

            editDescQuill.root.innerHTML = this.dataset.description || '';
            editSumQuill.root.innerHTML  = this.dataset.summary     || '';
            editChallengeQuill.root.innerHTML = this.dataset.challenge || '';
            editSolutionQuill.root.innerHTML  = this.dataset.solution  || '';

            f.querySelector('[name="technologies"]').value = this.dataset.technologies || '';
            f.querySelector('[name="features"]').value     = this.dataset.features     || '';

            const preview = document.getElementById('edit-cover-preview');
            const img     = document.getElementById('edit-cover-img');
            if (this.dataset.cover) {
                img.src = this.dataset.cover;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }

            const galleryContainer = document.getElementById('edit-gallery-existing');
            galleryContainer.innerHTML = '';
            document.getElementById('edit-gallery-preview').innerHTML = '';
            editGalleryDT.items.clear();

            const gallery = JSON.parse(this.dataset.gallery || '[]');
            gallery.forEach(function (item) {
                const div = document.createElement('div');
                div.style.cssText = 'position:relative;display:inline-block;';
                div.innerHTML =
                    '<img src="' + item.url + '" style="width:80px;height:60px;object-fit:cover;border-radius:4px;" alt="">'
                    + '<button type="button" class="btn btn-danger btn-sm remove-gallery-img"'
                    + ' data-path="' + item.path + '"'
                    + ' style="position:absolute;top:2px;right:2px;padding:1px 4px;font-size:10px;line-height:1;">'
                    + '<i class="ti ti-x"></i></button>'
                    + '<input type="hidden" name="remove_gallery[]" value="' + item.path + '" disabled>';
                galleryContainer.appendChild(div);
            });

            galleryContainer.querySelectorAll('.remove-gallery-img').forEach(function (removeBtn) {
                removeBtn.addEventListener('click', function () {
                    const hiddenInput = this.parentElement.querySelector('input[type="hidden"]');
                    hiddenInput.disabled = false;
                    this.parentElement.style.opacity = '0.4';
                    this.disabled = true;
                });
            });
        });
    });

    // ── Delete button ─────────────────────────────────────────────────────────
    document.querySelectorAll('.delete-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const f      = document.getElementById('delete-form');
            f.action     = `${PORTFOLIO_BASE}/${this.dataset.slug}`;
            f.dataset.id = this.dataset.id;
        });
    });

    // ── Status toggle ─────────────────────────────────────────────────────────
    tbody.addEventListener('click', function (e) {
        const toggleBtn = e.target.closest('.toggle-status-btn');
        if (toggleBtn) {
            fetch(`${PORTFOLIO_BASE}/${toggleBtn.dataset.slug}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: '_method=PATCH',
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    const isActive = data.is_active;
                    toggleBtn.className = 'badge border-0 toggle-status-btn ' + (isActive ? 'badge-success' : 'badge-danger');
                    toggleBtn.title     = isActive ? 'Click to deactivate' : 'Click to activate';
                    toggleBtn.innerHTML = '<i class="ti ti-point-filled"></i> ' + (isActive ? 'Active' : 'Inactive');
                    iziToast.success({ message: data.message, position: 'topRight' });
                }
            });
        }
    });

    // ── Cover image preview ───────────────────────────────────────────────────
    document.querySelector('#add-form [name="cover_image"]').addEventListener('change', function () {
        previewImage(this, 'add-cover-preview', 'add-cover-img');
    });
    document.querySelector('#edit-form [name="cover_image"]').addEventListener('change', function () {
        previewImage(this, 'edit-cover-preview', 'edit-cover-img');
    });

    function previewImage(input, previewId, imgId) {
        if (!input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById(imgId).src = e.target.result;
            document.getElementById(previewId).style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────
    function removeEmpty() {
        const el = document.getElementById('emptyRow');
        if (el) el.remove();
    }

    function checkEmpty() {
        if (!tbody.querySelector('tr')) {
            tbody.innerHTML = `
                <tr id="emptyRow">
                    <td colspan="9" class="text-center py-5 text-muted">
                        <i class="ti ti-briefcase fs-36 d-block mb-2"></i>
                        No portfolio items yet. Add your first one.
                    </td>
                </tr>`;
        }
    }

    function tagsHtml(tags) {
        if (!tags || !tags.length) return '';
        return '<div class="mt-1">' + tags.map(function(t) {
            return '<span class="badge bg-light text-dark fs-11">' + t + '</span>';
        }).join(' ') + '</div>';
    }

    function coverHtml(url) {
        if (url) {
            return '<img src="' + url + '" style="width:64px;height:48px;object-fit:cover;border-radius:4px;" alt="">';
        }
        return '<div class="d-flex align-items-center justify-content-center bg-light" style="width:64px;height:48px;border-radius:4px;"><i class="ti ti-photo text-muted fs-18"></i></div>';
    }

    function esc(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    function rowHtml(p) {
        const isActive = p.is_active;
        const badge = isActive
            ? '<button type="button" class="badge badge-success border-0 toggle-status-btn" data-id="' + p.id + '" data-slug="' + esc(p.slug) + '" style="cursor:pointer;" title="Click to deactivate"><i class="ti ti-point-filled"></i> Active</button>'
            : '<button type="button" class="badge badge-danger border-0 toggle-status-btn" data-id="' + p.id + '" data-slug="' + esc(p.slug) + '" style="cursor:pointer;" title="Click to activate"><i class="ti ti-point-filled"></i> Inactive</button>';

        const galleryJson = JSON.stringify(p.gallery || []).replace(/'/g, '&#39;');

        return '<td>' + coverHtml(p.cover_image) + '</td>'
            + '<td class="fw-medium">' + esc(p.title) + tagsHtml(p.tags) + '</td>'
            + '<td class="text-muted fs-13">' + esc(p.service_name) + '</td>'
            + '<td class="text-muted fs-13">' + (p.client || '—') + '</td>'
            + '<td class="text-muted fs-13">' + (p.location || '—') + '</td>'
            + '<td class="text-muted fs-13">' + (p.published_fmt || '—') + '</td>'
            + '<td>' + badge + '</td>'
            + '<td class="text-center text-muted fs-13">' + p.sort_order + '</td>'
            + '<td>'
            +   '<div class="d-flex align-items-center gap-1">'
            +     '<a href="#" class="p-1 edit-btn"'
            +       ' data-id="' + p.id + '"'
            +       ' data-slug="' + esc(p.slug) + '"'
            +       ' data-service-id="' + p.service_id + '"'
            +       ' data-title="' + esc(p.title) + '"'
            +       ' data-client="' + esc(p.client) + '"'
            +       ' data-location="' + esc(p.location) + '"'
            +       ' data-published="' + (p.published_at || '') + '"'
            +       ' data-excerpt="' + esc(p.excerpt) + '"'
            +       ' data-description="' + esc(p.description) + '"'
            +       ' data-summary="' + esc(p.summary) + '"'
            +       ' data-challenge="' + esc(p.challenge) + '"'
            +       ' data-solution="' + esc(p.solution) + '"'
            +       ' data-technologies="' + esc(p.technologies_str) + '"'
            +       ' data-features="' + esc(p.features_str) + '"'
            +       ' data-tags="' + esc(p.tags_str) + '"'
            +       ' data-is-active="' + (isActive ? 1 : 0) + '"'
            +       ' data-sort="' + p.sort_order + '"'
            +       ' data-cover="' + (p.cover_image || '') + '"'
            +       ' data-gallery=\'' + galleryJson + '\''
            +       ' data-bs-toggle="modal" data-bs-target="#edit_portfolio">'
            +       '<i class="ti ti-edit"></i>'
            +     '</a>'
            +     '<a href="#" class="p-1 delete-btn"'
            +       ' data-id="' + p.id + '"'
            +       ' data-slug="' + esc(p.slug) + '"'
            +       ' data-bs-toggle="modal" data-bs-target="#delete_modal">'
            +       '<i class="ti ti-trash"></i>'
            +     '</a>'
            +   '</div>'
            + '</td>';
    }

    // ── Re-bind buttons on dynamically inserted rows ──────────────────────────
    tbody.addEventListener('click', function (e) {
        const editBtn = e.target.closest('.edit-btn');
        if (editBtn && !editBtn._bound) {
            editBtn._bound = true;
            editBtn.addEventListener('click', function () {
                const f = document.getElementById('edit-form');
                f.action = `${PORTFOLIO_BASE}/${this.dataset.slug}`;
                f.querySelector('[name="service_id"]').value   = this.dataset.serviceId  || '';
                f.querySelector('[name="title"]').value        = this.dataset.title       || '';
                f.querySelector('[name="slug"]').value         = this.dataset.slug        || '';
                f.querySelector('[name="client"]').value       = this.dataset.client      || '';
                f.querySelector('[name="location"]').value     = this.dataset.location    || '';
                f.querySelector('[name="published_at"]').value = this.dataset.published   || '';
                f.querySelector('[name="excerpt"]').value      = this.dataset.excerpt     || '';
                f.querySelector('[name="tags"]').value         = this.dataset.tags        || '';
                f.querySelector('[name="sort_order"]').value   = this.dataset.sort        || '0';
                f.querySelector('[name="is_active"]').checked  = this.dataset.isActive    == '1';
                editDescQuill.root.innerHTML = this.dataset.description || '';
                editSumQuill.root.innerHTML  = this.dataset.summary     || '';
                editChallengeQuill.root.innerHTML = this.dataset.challenge || '';
                editSolutionQuill.root.innerHTML  = this.dataset.solution  || '';
                f.querySelector('[name="technologies"]').value = this.dataset.technologies || '';
                f.querySelector('[name="features"]').value     = this.dataset.features     || '';
                const preview = document.getElementById('edit-cover-preview');
                const img     = document.getElementById('edit-cover-img');
                if (this.dataset.cover) { img.src = this.dataset.cover; preview.style.display = 'block'; }
                else { preview.style.display = 'none'; }
            });
        }

        const deleteBtn = e.target.closest('.delete-btn');
        if (deleteBtn && !deleteBtn._bound) {
            deleteBtn._bound = true;
            deleteBtn.addEventListener('click', function () {
                const f      = document.getElementById('delete-form');
                f.action     = `${PORTFOLIO_BASE}/${this.dataset.slug}`;
                f.dataset.id = this.dataset.id;
            });
        }
    });

}); // end DOMContentLoaded
</script>
@endpush