@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/quill/quill.snow.css') }}">
<style>
  /* Force the career modals to scroll — overrides any theme overflow:hidden */
  #add_career .modal-body,
  #edit_career .modal-body {
    max-height: calc(100vh - 200px);
    overflow-y: auto !important;
    overflow-x: hidden;
  }

  /* Ensure the modal dialog itself doesn't clip */
  #add_career .modal-dialog,
  #edit_career .modal-dialog {
    max-height: 95vh;
    margin-top: 2.5vh;
    margin-bottom: 2.5vh;
  }

  /* Bootstrap scrollable modal: modal-content must also be constrained */
  #add_career .modal-content,
  #edit_career .modal-content {
    max-height: 92vh;
    display: flex;
    flex-direction: column;
  }

  #add_career .modal-header,
  #add_career .modal-footer,
  #edit_career .modal-header,
  #edit_career .modal-footer {
    flex-shrink: 0;
  }

  /* Quill toolbar inside a dark-scrollable modal */
  .ql-toolbar.ql-snow {
    border-radius: 6px 6px 0 0;
  }

  .ql-container.ql-snow {
    border-radius: 0 0 6px 6px;
  }

  /* ── Fix: let Quill own list rendering; only restore spacing the theme strips ── */
  /* Quill Snow uses li::before / .ql-ui for markers — don't add list-style on top */
  .ql-editor ul,
  .ql-editor ol {
    padding-left: 1.5em !important;
    margin: 0.4em 0 !important;
  }

  .ql-editor li {
    list-style-type: none !important;
  }

  .ql-editor li[data-list="bullet"]::before {
    content: '\2022' !important;
    /* force bullet character */
  }

  .ql-editor li[data-list="ordered"]::before {
    content: counter(list-0, decimal) '. ' !important;
  }
</style>
@endpush

@section('content')
<div class="content">

  <div class="page-header">
    <div class="add-item d-flex">
      <div class="page-title">
        <h4>Career / Job Vacancies</h4>
        <h6>Manage open positions shown on the careers page</h6>
      </div>
    </div>
    <div class="page-btn">
      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_career">
        <i class="ti ti-circle-plus me-1"></i>Add Vacancy
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead class="thead-light">
            <tr>
              <th>Title</th>
              <th>Department</th>
              <th>Location</th>
              <th>Type</th>
              <th>Level</th>
              <th style="width:110px;">Status</th>
              <th style="width:90px;">Featured</th>
              <th style="width:100px;">Deadline</th>
              <th style="width:80px;">Actions</th>
            </tr>
          </thead>
          <tbody id="careerBody">
            @forelse ($careers as $c)
            <tr data-id="{{ $c->id }}">
              <td>
                <div class="fw-medium">{{ $c->title }}</div>
                @if ($c->salary_range)
                <small class="text-muted">{{ $c->salary_range }}</small>
                @endif
              </td>
              <td class="text-muted fs-13">{{ $c->department ?? '—' }}</td>
              <td class="text-muted fs-13">
                {{ $c->location }}
                <span class="badge bg-light text-dark ms-1">{{ $c->work_type_label }}</span>
              </td>
              <td class="text-muted fs-13">{{ $c->employment_label }}</td>
              <td class="text-muted fs-13">{{ $c->experience_level ?? '—' }}</td>
              <td>
                <button type="button"
                  class="badge {{ $c->is_active ? 'badge-success' : 'badge-danger' }} border-0 toggle-status-btn"
                  data-id="{{ $c->id }}" data-status="{{ $c->is_active ? 1 : 0 }}"
                  style="cursor:pointer;">
                  <i class="ti ti-point-filled"></i>
                  {{ $c->is_active ? 'Active' : 'Inactive' }}
                </button>
              </td>
              <td>
                @if ($c->is_featured)
                <span class="badge badge-warning">🔥 Featured</span>
                @else
                <span class="text-muted fs-13">—</span>
                @endif
              </td>
              <td class="text-muted fs-13">
                {{ $c->deadline?->format('d M Y') ?? '—' }}
              </td>
              <td>
                <div class="d-flex align-items-center gap-1">
                  <a href="#" class="p-1 edit-btn"
                    data-id="{{ $c->id }}"
                    data-title="{{ $c->title }}"
                    data-slug="{{ $c->slug }}"
                    data-department="{{ $c->department }}"
                    data-location="{{ $c->location }}"
                    data-work_type="{{ $c->work_type }}"
                    data-employment_type="{{ $c->employment_type }}"
                    data-experience_level="{{ $c->experience_level }}"
                    data-salary_range="{{ $c->salary_range }}"
                    data-excerpt="{{ $c->excerpt }}"
                    data-description="{{ e($c->description) }}"
                    data-responsibilities="{{ e($c->responsibilities) }}"
                    data-requirements="{{ e($c->requirements) }}"
                    data-nice_to_have="{{ e($c->nice_to_have) }}"
                    data-benefits="{{ e($c->benefits) }}"
                    data-tags="{{ $c->tags ? implode(', ', $c->tags) : '' }}"
                    data-is_active="{{ $c->is_active ? 1 : 0 }}"
                    data-is_featured="{{ $c->is_featured ? 1 : 0 }}"
                    data-sort_order="{{ $c->sort_order }}"
                    data-deadline="{{ $c->deadline?->format('Y-m-d') }}"
                    data-bs-toggle="modal" data-bs-target="#edit_career">
                    <i class="ti ti-edit"></i>
                  </a>
                  <a href="#" class="p-1 delete-btn"
                    data-id="{{ $c->id }}"
                    data-bs-toggle="modal" data-bs-target="#delete_modal">
                    <i class="ti ti-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @empty
            <tr id="emptyRow">
              <td colspan="9" class="text-center py-5 text-muted">
                <i class="ti ti-id-badge fs-36 d-block mb-2"></i>
                No job vacancies yet. Add your first one.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    @if ($careers->hasPages())
    <div class="card-footer d-flex align-items-center justify-content-between flex-wrap row-gap-2">
      <p class="text-muted fs-13 mb-0">
        Showing {{ $careers->firstItem() }}–{{ $careers->lastItem() }} of {{ $careers->total() }} vacancies
      </p>
      <ul class="pagination pagination-sm mb-0">
        <li class="page-item {{ $careers->onFirstPage() ? 'disabled' : '' }}">
          <a class="page-link" href="{{ $careers->previousPageUrl() ?? '#' }}">&laquo;</a>
        </li>
        @foreach ($careers->getUrlRange(1, $careers->lastPage()) as $page => $url)
        <li class="page-item {{ $page == $careers->currentPage() ? 'active' : '' }}">
          <a class="page-link" href="{{ $url }}">{{ $page }}</a>
        </li>
        @endforeach
        <li class="page-item {{ !$careers->hasMorePages() ? 'disabled' : '' }}">
          <a class="page-link" href="{{ $careers->nextPageUrl() ?? '#' }}">&raquo;</a>
        </li>
      </ul>
    </div>
    @endif
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     ADD MODAL
══════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="add_career">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Job Vacancy</h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal">
          <i class="ti ti-x"></i>
        </button>
      </div>
      <form id="add-form" action="{{ route('admin.career.store') }}" method="POST">
        @csrf
        <div class="modal-body pb-0">
          @include('admin.career._form', ['edit' => false])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Vacancy</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     EDIT MODAL
══════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="edit_career">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Job Vacancy</h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal">
          <i class="ti ti-x"></i>
        </button>
      </div>
      <form id="edit-form" action="#" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body pb-0">
          @include('admin.career._form', ['edit' => true])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     DELETE MODAL
══════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="delete_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <span class="avatar avatar-xl bg-soft-danger rounded-circle text-danger mb-3">
          <i class="ti ti-trash-x fs-36"></i>
        </span>
        <h4 class="mb-1">Delete Vacancy</h4>
        <p class="mb-3">Are you sure you want to delete this job vacancy? This cannot be undone.</p>
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
  const CAREER_BASE = "{{ url('admin/career') }}";
  const csrfToken = "{{ csrf_token() }}";

  (function() {
    const tbody = document.getElementById('careerBody');
    let addBusy = false,
      editBusy = false,
      delBusy = false;

    // ── Quill config ─────────────────────────────────────────
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

    // Add-modal editors
    const addDescQ = new Quill('#add-description-editor', quillOpts);
    const addRespQ = new Quill('#add-responsibilities-editor', quillOpts);
    const addReqQ = new Quill('#add-requirements-editor', quillOpts);
    const addNthQ = new Quill('#add-nice_to_have-editor', quillOpts);
    const addBenQ = new Quill('#add-benefits-editor', quillOpts);

    // Edit-modal editors
    const editDescQ = new Quill('#edit-description-editor', quillOpts);
    const editRespQ = new Quill('#edit-responsibilities-editor', quillOpts);
    const editReqQ = new Quill('#edit-requirements-editor', quillOpts);
    const editNthQ = new Quill('#edit-nice_to_have-editor', quillOpts);
    const editBenQ = new Quill('#edit-benefits-editor', quillOpts);

    // Helper: flush all Quill editors → hidden inputs before fetch
    function syncAddEditors() {
      document.getElementById('add-description-input').value = addDescQ.root.innerHTML;
      document.getElementById('add-responsibilities-input').value = addRespQ.root.innerHTML;
      document.getElementById('add-requirements-input').value = addReqQ.root.innerHTML;
      document.getElementById('add-nice_to_have-input').value = addNthQ.root.innerHTML;
      document.getElementById('add-benefits-input').value = addBenQ.root.innerHTML;
    }

    function syncEditEditors() {
      document.getElementById('edit-description-input').value = editDescQ.root.innerHTML;
      document.getElementById('edit-responsibilities-input').value = editRespQ.root.innerHTML;
      document.getElementById('edit-requirements-input').value = editReqQ.root.innerHTML;
      document.getElementById('edit-nice_to_have-input').value = editNthQ.root.innerHTML;
      document.getElementById('edit-benefits-input').value = editBenQ.root.innerHTML;
    }

    function clearAddEditors() {
      [addDescQ, addRespQ, addReqQ, addNthQ, addBenQ].forEach(q => q.setContents([]));
    }

    // ── ADD ──────────────────────────────────────────────────
    document.getElementById('add-form').addEventListener('submit', function(e) {
      e.preventDefault();
      if (addBusy) return;
      addBusy = true;
      syncAddEditors();

      fetch(this.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          body: new FormData(this),
        })
        .then(r => r.json())
        .then(data => {
          addBusy = false;
          if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('add_career')).hide();
            this.reset();
            clearAddEditors();
            iziToast.success({
              message: data.message,
              position: 'topRight'
            });
            removeEmpty();
            const tr = document.createElement('tr');
            tr.dataset.id = data.career.id;
            tr.innerHTML = rowHtml(data.career);
            tbody.insertBefore(tr, tbody.firstChild);
          }
        })
        .catch(() => {
          addBusy = false;
        });
    });

    // ── EDIT ─────────────────────────────────────────────────
    document.getElementById('edit-form').addEventListener('submit', function(e) {
      e.preventDefault();
      if (editBusy) return;
      editBusy = true;
      syncEditEditors();

      const fd = new FormData(this);
      fd.append('_method', 'PUT');

      fetch(this.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          body: fd,
        })
        .then(r => r.json())
        .then(data => {
          editBusy = false;
          if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('edit_career')).hide();
            iziToast.success({
              message: data.message,
              position: 'topRight'
            });
            const row = tbody.querySelector(`tr[data-id="${data.career.id}"]`);
            if (row) row.innerHTML = rowHtml(data.career);
          }
        })
        .catch(() => {
          editBusy = false;
        });
    });

    // ── DELETE ───────────────────────────────────────────────
    document.getElementById('delete-form').addEventListener('submit', function(e) {
      e.preventDefault();
      if (delBusy) return;
      delBusy = true;

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
          delBusy = false;
          if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('delete_modal')).hide();
            iziToast.success({
              message: data.message,
              position: 'topRight'
            });
            const row = tbody.querySelector(`tr[data-id="${this.dataset.id}"]`);
            if (row) row.remove();
            checkEmpty();
          }
        })
        .catch(() => {
          delBusy = false;
        });
    });

    // ── EVENT DELEGATION ─────────────────────────────────────
    tbody.addEventListener('click', function(e) {

      // EDIT — populate modal + Quill editors
      const editBtn = e.target.closest('.edit-btn');
      if (editBtn) {
        const d = editBtn.dataset;
        setVal('edit-title', d.title);
        setVal('edit-slug', d.slug);
        setVal('edit-department', d.department);
        setVal('edit-location', d.location);
        setVal('edit-work_type', d.work_type);
        setVal('edit-employment_type', d.employment_type);
        setVal('edit-experience_level', d.experience_level);
        setVal('edit-salary_range', d.salary_range);
        setVal('edit-excerpt', d.excerpt);
        setVal('edit-tags', d.tags);
        setVal('edit-sort_order', d.sort_order);
        setVal('edit-deadline', d.deadline);
        setChk('edit-is_active', d.is_active == '1');
        setChk('edit-is_featured', d.is_featured == '1');

        // Load rich content into Quill editors
        editDescQ.root.innerHTML = d.description || '';
        editRespQ.root.innerHTML = d.responsibilities || '';
        editReqQ.root.innerHTML = d.requirements || '';
        editNthQ.root.innerHTML = d.nice_to_have || '';
        editBenQ.root.innerHTML = d.benefits || '';

        document.getElementById('edit-form').action = `${CAREER_BASE}/${d.id}`;
      }

      // DELETE
      const delBtn = e.target.closest('.delete-btn');
      if (delBtn) {
        const form = document.getElementById('delete-form');
        form.action = `${CAREER_BASE}/${delBtn.dataset.id}`;
        form.dataset.id = delBtn.dataset.id;
      }

      // TOGGLE STATUS
      const togBtn = e.target.closest('.toggle-status-btn');
      if (togBtn) {
        fetch(`${CAREER_BASE}/${togBtn.dataset.id}/status`, {
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
              const on = data.status;
              togBtn.className = `badge ${on ? 'badge-success' : 'badge-danger'} border-0 toggle-status-btn`;
              togBtn.dataset.status = on ? '1' : '0';
              togBtn.innerHTML = `<i class="ti ti-point-filled"></i> ${on ? 'Active' : 'Inactive'}`;
              iziToast.success({
                message: data.message,
                position: 'topRight'
              });
            }
          });
      }
    });

    // ── HELPERS ──────────────────────────────────────────────
    function setVal(id, val) {
      const el = document.getElementById(id);
      if (el) el.value = val || '';
    }

    function setChk(id, checked) {
      const el = document.getElementById(id);
      if (el) el.checked = checked;
    }

    function removeEmpty() {
      const e = document.getElementById('emptyRow');
      if (e) e.remove();
    }

    function checkEmpty() {
      if (!tbody.querySelector('tr')) {
        tbody.innerHTML = `<tr id="emptyRow">
                <td colspan="9" class="text-center py-5 text-muted">
                    <i class="ti ti-id-badge fs-36 d-block mb-2"></i>
                    No job vacancies yet. Add your first one.
                </td></tr>`;
      }
    }

    function rowHtml(c) {
      const isActive = c.is_active == 1;
      const isFeatured = c.is_featured == 1;
      return `
            <td>
                <div class="fw-medium">${c.title}</div>
                ${c.salary_range ? `<small class="text-muted">${c.salary_range}</small>` : ''}
            </td>
            <td class="text-muted fs-13">${c.department || '—'}</td>
            <td class="text-muted fs-13">
                ${c.location || ''}
                <span class="badge bg-light text-dark ms-1">${c.work_type_label}</span>
            </td>
            <td class="text-muted fs-13">${c.employment_label}</td>
            <td class="text-muted fs-13">${c.experience_level || '—'}</td>
            <td>
                <button type="button"
                        class="badge ${isActive ? 'badge-success' : 'badge-danger'} border-0 toggle-status-btn"
                        data-id="${c.id}" data-status="${isActive ? 1 : 0}" style="cursor:pointer;">
                    <i class="ti ti-point-filled"></i> ${isActive ? 'Active' : 'Inactive'}
                </button>
            </td>
            <td>${isFeatured ? '<span class="badge badge-warning">🔥 Featured</span>' : '<span class="text-muted fs-13">—</span>'}</td>
            <td class="text-muted fs-13">${c.deadline_display || '—'}</td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <a href="#" class="p-1 edit-btn"
                       data-id="${c.id}"
                       data-title="${esc(c.title)}"
                       data-slug="${esc(c.slug)}"
                       data-department="${esc(c.department)}"
                       data-location="${esc(c.location)}"
                       data-work_type="${c.work_type}"
                       data-employment_type="${c.employment_type}"
                       data-experience_level="${esc(c.experience_level)}"
                       data-salary_range="${esc(c.salary_range)}"
                       data-excerpt="${esc(c.excerpt)}"
                       data-description="${esc(c.description)}"
                       data-responsibilities="${esc(c.responsibilities)}"
                       data-requirements="${esc(c.requirements)}"
                       data-nice_to_have="${esc(c.nice_to_have)}"
                       data-benefits="${esc(c.benefits)}"
                       data-tags="${esc(c.tags)}"
                       data-is_active="${isActive ? 1 : 0}"
                       data-is_featured="${isFeatured ? 1 : 0}"
                       data-sort_order="${c.sort_order}"
                       data-deadline="${c.deadline || ''}"
                       data-bs-toggle="modal" data-bs-target="#edit_career">
                        <i class="ti ti-edit"></i>
                    </a>
                    <a href="#" class="p-1 delete-btn" data-id="${c.id}"
                       data-bs-toggle="modal" data-bs-target="#delete_modal">
                        <i class="ti ti-trash"></i>
                    </a>
                </div>
            </td>`;
    }

    function esc(v) {
      if (!v) return '';
      return String(v)
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
    }
  })();
</script>
@endpush
