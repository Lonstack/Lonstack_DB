@extends('layouts.admin')

@section('content')
<div class="content">

  <div class="page-header">
    <div class="page-title">
      <h4>Technologies We Use</h4>
      <h6>Global tech stack shown on all technology pages</h6>
    </div>
    <div class="page-btn">
      <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addGroupModal">
        <i class="ti ti-circle-plus me-1"></i>Add Group
      </a>
    </div>
  </div>

  {{-- Each group is its own card with inline item management --}}
  @forelse($groups as $group)
  <div class="card mb-3">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2">
        <h5 class="card-title mb-0">{{ $group->name }}</h5>
        @if(!$group->is_active)
        <span class="badge badge-danger badge-xs">Inactive</span>
        @endif
      </div>
      <div class="d-flex gap-2">
        {{-- Add item to this group --}}
        <button class="btn btn-secondary btn-sm"
          data-bs-toggle="modal" data-bs-target="#addItemModal"
          data-group-id="{{ $group->id }}"
          data-group-name="{{ $group->name }}">
          <i class="ti ti-tag me-1"></i>Add Item
        </button>
        {{-- Edit group --}}
        <a href="#" class="btn btn-light btn-sm"
          data-bs-toggle="modal" data-bs-target="#editGroupModal"
          data-id="{{ $group->id }}"
          data-name="{{ $group->name }}"
          data-sort="{{ $group->sort_order }}"
          data-active="{{ $group->is_active ? '1' : '0' }}">
          <i data-feather="edit" class="feather-14"></i>
        </a>
        {{-- Delete group --}}
        <form action="{{ route('admin.tech-stack.groups.destroy', $group) }}"
          method="POST" onsubmit="return confirm('Delete this group and all its items?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-light btn-sm text-danger">
            <i data-feather="trash-2" class="feather-14"></i>
          </button>
        </form>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="thead-light">
            <tr>
              <th>Icon</th>
              <th>Name</th>
              <th>Order</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse($group->items as $item)
            <tr>
              <td>
                @if($item->icon)
                <img src="{{ asset('storage/' . $item->icon) }}"
                  style="width:36px;height:36px;object-fit:contain;border-radius:6px;background:#f8f9fa;padding:4px;"
                  alt="{{ $item->name }}">
                @else
                <span class="text-muted">—</span>
                @endif
              </td>
              <td><strong>{{ $item->name }}</strong></td>
              <td>{{ $item->sort_order }}</td>
              <td>
                @if($item->is_active)
                <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                  <i class="ti ti-point-filled me-1"></i>Active
                </span>
                @else
                <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                  <i class="ti ti-point-filled me-1"></i>Inactive
                </span>
                @endif
              </td>
              <td class="action-table-data">
                <div class="edit-delete-action">
                  <a class="me-2 p-2" href="#"
                    data-bs-toggle="modal" data-bs-target="#editItemModal"
                    data-id="{{ $item->id }}"
                    data-group-id="{{ $group->id }}"
                    data-name="{{ $item->name }}"
                    data-sort="{{ $item->sort_order }}"
                    data-active="{{ $item->is_active ? '1' : '0' }}"
                    data-icon="{{ $item->icon }}">
                    <i data-feather="edit" class="feather-14"></i>
                  </a>
                  <form action="{{ route('admin.tech-stack.items.destroy', [$group, $item]) }}"
                    method="POST" onsubmit="return confirm('Delete this item?')">
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
              <td colspan="5" class="text-center text-muted py-3">No items yet. Add your first one.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @empty
  <div class="card">
    <div class="card-body text-center text-muted py-5">
      No groups yet. Add your first group above.
    </div>
  </div>
  @endforelse

</div>

{{-- ── ADD GROUP MODAL ── --}}
<div class="modal fade" id="addGroupModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Tech Stack Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.tech-stack.groups.store') }}" method="POST"
        data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Group Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
              placeholder="e.g. Frameworks & Languages" required>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0" min="0">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                  <label class="form-check-label">Active</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Save Group</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── EDIT GROUP MODAL ── --}}
<div class="modal fade" id="editGroupModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editGroupForm" method="POST" data-submit-spinner data-spinner-text="Updating...">
        @csrf @method('PATCH')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Group Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="eg_name" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" id="eg_sort" class="form-control" min="0">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" name="is_active" id="eg_active" value="1">
                  <label class="form-check-label">Active</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Update Group</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── ADD ITEM MODAL ── --}}
<div class="modal fade" id="addItemModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Item to <span id="addItemGroupName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="addItemForm" method="POST" enctype="multipart/form-data"
        data-submit-spinner data-spinner-text="Saving...">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
              placeholder="e.g. Laravel, MySQL, Docker" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Icon Image <small class="text-muted">(PNG/SVG, max 512KB)</small></label>
            <input type="file" name="icon" class="form-control" accept="image/*,.svg">
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0" min="0">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                  <label class="form-check-label">Active</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Save Item</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ── EDIT ITEM MODAL ── --}}
<div class="modal fade" id="editItemModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editItemForm" method="POST" enctype="multipart/form-data"
        data-submit-spinner data-spinner-text="Updating...">
        @csrf @method('PATCH')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="ei_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Replace Icon <small class="text-muted">(leave empty to keep current)</small></label>
            <div id="ei_current_icon" class="mb-2"></div>
            <input type="file" name="icon" class="form-control" accept="image/*">
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" id="ei_sort" class="form-control" min="0">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" name="is_active" id="ei_active" value="1">
                  <label class="form-check-label">Active</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex gap-2">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary">Update Item</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Pre-fill edit group modal
  document.getElementById('editGroupModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    const form = document.getElementById('editGroupForm');
    form.action = `/admin/tech-stack/groups/${btn.dataset.id}`;
    document.getElementById('eg_name').value = btn.dataset.name || '';
    document.getElementById('eg_sort').value = btn.dataset.sort || 0;
    document.getElementById('eg_active').checked = btn.dataset.active === '1';
  });

  // Set the correct store URL for add item modal based on which group was clicked
  document.getElementById('addItemModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    const form = document.getElementById('addItemForm');
    form.action = `/admin/tech-stack/groups/${btn.dataset.groupId}/items`;
    document.getElementById('addItemGroupName').textContent = btn.dataset.groupName;
  });

  // Pre-fill edit item modal
  document.getElementById('editItemModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    const form = document.getElementById('editItemForm');
    form.action = `/admin/tech-stack/groups/${btn.dataset.groupId}/items/${btn.dataset.id}`;
    document.getElementById('ei_name').value = btn.dataset.name || '';
    document.getElementById('ei_sort').value = btn.dataset.sort || 0;
    document.getElementById('ei_active').checked = btn.dataset.active === '1';

    // Show current icon preview if exists
    const iconWrap = document.getElementById('ei_current_icon');
    if (btn.dataset.icon) {
      iconWrap.innerHTML = `<img src="/storage/${btn.dataset.icon}"
                style="width:40px;height:40px;object-fit:contain;border-radius:6px;background:#f8f9fa;padding:4px;"
                alt="Current icon">`;
    } else {
      iconWrap.innerHTML = '';
    }
  });
</script>
@endpush

@endsection
