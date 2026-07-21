@extends('layouts.admin')

@section('content')
<div class="content">

  <div class="page-header">
    <div class="add-item d-flex">
      <div class="page-title">
        <h4>Portfolio</h4>
        <h6>Manage your portfolio items</h6>
      </div>
    </div>
    <div class="page-btn">
      <a href="{{ route('admin.portfolio.create') }}" class="btn btn-secondary">
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
              <th style="width:64px;">Image</th>
              <th>Title</th>
              <th>Service</th>
              <th style="width:90px;">Status</th>
              <th style="width:60px;" class="text-center">Order</th>
              <th style="width:100px;">Actions</th>
            </tr>
          </thead>
          <tbody id="portfolioBody">
            @forelse ($portfolios as $p)
            <tr>
              <td>
                @if ($p->cover_image)
                <img src="{{ asset('storage/' . $p->cover_image) }}"
                  style="width:52px;height:40px;object-fit:cover;border-radius:4px;" alt="">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light"
                  style="width:52px;height:40px;border-radius:4px;">
                  <i class="ti ti-photo text-muted fs-16"></i>
                </div>
                @endif
              </td>
              <td>
                <div class="fw-medium">{{ $p->title }}</div>
                @if ($p->client)
                <small class="text-muted">{{ $p->client }}</small>
                @endif
              </td>
              <td class="text-muted fs-13">{{ $p->service->name ?? '—' }}</td>
              <td>
                <button type="button"
                  class="badge border-0 toggle-status-btn {{ $p->is_active ? 'badge-success' : 'badge-danger' }}"
                  data-id="{{ $p->id }}"
                  data-slug="{{ $p->slug }}"
                  style="cursor:pointer;"
                  title="{{ $p->is_active ? 'Click to deactivate' : 'Click to activate' }}">
                  <i class="ti ti-point-filled"></i>
                  {{ $p->is_active ? 'Active' : 'Inactive' }}
                </button>
              </td>
              <td class="text-center text-muted fs-13">{{ $p->sort_order }}</td>
              <td>
                <div class="d-flex align-items-center gap-1">
                  <button type="button"
                    class="btn btn-sm p-1 view-btn"
                    data-slug="{{ $p->slug }}"
                    title="View details">
                    <i class="ti ti-eye fs-16"></i>
                  </button>
                  <a href="{{ route('admin.portfolio.edit', $p->slug) }}"
                    class="btn btn-sm p-1" title="Edit">
                    <i class="ti ti-edit fs-16"></i>
                  </a>
                  <a href="#" class="btn btn-sm p-1 delete-btn"
                    data-slug="{{ $p->slug }}"
                    data-title="{{ $p->title }}"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_modal"
                    title="Delete">
                    <i class="ti ti-trash fs-16"></i>
                  </a>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="ti ti-briefcase fs-36 d-block mb-2"></i>
                No portfolio items yet.
                <a href="{{ route('admin.portfolio.create') }}">Add your first one.</a>
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
        Showing {{ $portfolios->firstItem() }}–{{ $portfolios->lastItem() }}
        of {{ $portfolios->total() }} items
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

{{-- ── View Details Modal ─────────────────────────────────────────────────── --}}
<div class="modal fade" id="view_modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view-modal-title">Portfolio Details</h5>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal">
          <i class="ti ti-x"></i>
        </button>
      </div>
      <div class="modal-body" id="view-modal-body">
        <div class="text-center py-4">
          <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <a href="#" id="view-modal-edit-btn" class="btn btn-primary btn-sm">
          <i class="ti ti-edit me-1"></i>Edit
        </a>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- ── Delete Modal ───────────────────────────────────────────────────────── --}}
<div class="modal fade" id="delete_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center py-4">
        <span class="avatar avatar-xl bg-soft-danger rounded-circle text-danger mb-3">
          <i class="ti ti-trash-x fs-36"></i>
        </span>
        <h4 class="mb-1">Delete Portfolio Item</h4>
        <p class="mb-4 text-muted" id="delete-confirm-text">
          Are you sure? This cannot be undone.
        </p>
        <form id="delete-form" action="#" method="POST">
          @csrf
          @method('DELETE')
          <div class="d-flex justify-content-center gap-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {

    const PORTFOLIO_BASE = '{{ url("admin/portfolio") }}';
    const csrfToken = '{{ csrf_token() }}';
    const tbody = document.getElementById('portfolioBody');

    // ── View details modal ─────────────────────────────────────────────────
    document.querySelectorAll('.view-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        const slug = this.dataset.slug;
        const modalEl = document.getElementById('view_modal');
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

        // Reset
        document.getElementById('view-modal-title').textContent = 'Portfolio Details';
        document.getElementById('view-modal-body').innerHTML =
          '<div class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></div>';
        document.getElementById('view-modal-edit-btn').href = PORTFOLIO_BASE + '/' + slug + '/edit';

        modal.show();

        fetch(PORTFOLIO_BASE + '/' + slug, {
            headers: {
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            }
          })
          .then(r => r.json())
          .then(function(p) {
            document.getElementById('view-modal-title').textContent = p.title;

            const tags = (p.tags || []).map(t => '<span class="badge bg-light text-dark me-1">' + t + '</span>').join('');
            const techs = (p.technologies || []).map(t => '<span class="badge bg-soft-info me-1 mb-1">' + t + '</span>').join('');
            const features = (p.features || []).map(f =>
              '<li class="mb-1"><i class="ti ti-check text-success me-1"></i>' + f + '</li>'
            ).join('');

            const coverHtml = p.cover_image ?
              '<img src="' + p.cover_image + '" class="w-100 rounded mb-3" style="max-height:220px;object-fit:cover;" alt="">' :
              '';

            const gallery = (p.gallery || []).map(function(g) {
              return '<img src="' + g + '" style="height:70px;width:100px;object-fit:cover;border-radius:6px;" alt="">';
            }).join('');

            let html = coverHtml;

            // Meta row
            html += '<div class="row g-2 mb-3">';
            if (p.service) html += '<div class="col-auto"><span class="badge bg-soft-primary">' + (p.service.name || '') + '</span></div>';
            if (p.client) html += '<div class="col-auto"><small class="text-muted"><i class="ti ti-building me-1"></i>' + p.client + '</small></div>';
            if (p.location) html += '<div class="col-auto"><small class="text-muted"><i class="ti ti-map-pin me-1"></i>' + p.location + '</small></div>';
            if (p.published_at) html += '<div class="col-auto"><small class="text-muted"><i class="ti ti-calendar me-1"></i>' + p.published_at + '</small></div>';
            html += '</div>';

            if (tags) html += '<div class="mb-3">' + tags + '</div>';
            if (p.excerpt) html += '<p class="text-muted fs-13 mb-3">' + p.excerpt + '</p>';

            if (p.description) html += '<div class="mb-3"><strong class="fs-13 d-block mb-1">Description</strong><div class="fs-13">' + p.description + '</div></div>';
            if (p.summary) html += '<div class="mb-3"><strong class="fs-13 d-block mb-1">Project Summary</strong><div class="fs-13">' + p.summary + '</div></div>';
            if (p.challenge) html += '<div class="mb-3"><strong class="fs-13 d-block mb-1">Challenge</strong><div class="fs-13">' + p.challenge + '</div></div>';
            if (p.solution) html += '<div class="mb-3"><strong class="fs-13 d-block mb-1">Solution</strong><div class="fs-13">' + p.solution + '</div></div>';

            if (techs) html += '<div class="mb-3"><strong class="fs-13 d-block mb-1">Technologies</strong>' + techs + '</div>';
            if (features) html += '<div class="mb-3"><strong class="fs-13 d-block mb-1">Features</strong><ul class="list-unstyled mb-0 fs-13">' + features + '</ul></div>';

            if (gallery) html += '<div class="mb-2"><strong class="fs-13 d-block mb-2">Gallery</strong><div class="d-flex flex-wrap gap-2">' + gallery + '</div></div>';

            document.getElementById('view-modal-body').innerHTML = html;
          });
      });
    });

    // ── Delete ─────────────────────────────────────────────────────────────
    document.querySelectorAll('.delete-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        document.getElementById('delete-form').action = PORTFOLIO_BASE + '/' + this.dataset.slug;
        document.getElementById('delete-confirm-text').textContent =
          'Are you sure you want to delete "' + this.dataset.title + '"? This cannot be undone.';
      });
    });

    // ── Status toggle ──────────────────────────────────────────────────────
    tbody.addEventListener('click', function(e) {
      const btn = e.target.closest('.toggle-status-btn');
      if (!btn) return;

      fetch(PORTFOLIO_BASE + '/' + btn.dataset.slug + '/status', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: '_method=PATCH',
        })
        .then(r => r.json())
        .then(function(data) {
          if (data.success) {
            const on = data.is_active;
            btn.className = 'badge border-0 toggle-status-btn ' + (on ? 'badge-success' : 'badge-danger');
            btn.title = on ? 'Click to deactivate' : 'Click to activate';
            btn.innerHTML = '<i class="ti ti-point-filled"></i> ' + (on ? 'Active' : 'Inactive');
            iziToast.success({
              message: data.message,
              position: 'topRight'
            });
          }
        });
    });

    // ── Backdrop cleanup on modal close ────────────────────────────────────
    document.getElementById('view_modal').addEventListener('hidden.bs.modal', function() {
      document.querySelectorAll('.modal-backdrop').forEach(function(el) {
        el.remove();
      });
      document.body.classList.remove('modal-open');
      document.body.style.removeProperty('overflow');
      document.body.style.removeProperty('padding-right');
    });

  });
</script>
@endpush
