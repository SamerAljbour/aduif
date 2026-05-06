@extends('adminLayouts.app')

@section('content')

@if (session('success'))
    <div class="alert-toast alert-toast--success" id="successAlert">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M5 8l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        {{ session('success') }}
        <button class="alert-toast__close" onclick="this.parentElement.remove()">&#x2715;</button>
    </div>
@endif

@if (session('error'))
    <div class="alert-toast alert-toast--error" id="errorAlert">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M8 5v3M8 10.5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        {{ session('error') }}
        <button class="alert-toast__close" onclick="this.parentElement.remove()">&#x2715;</button>
    </div>
@endif

<div class="mgmt-wrap">

    {{-- PAGE HEADER --}}
    <div class="mgmt-header">
        <h1 class="mgmt-title">Management</h1>
        <a href="{{ route('managements.create') }}" class="btn-add">
            <span class="btn-add__icon">+</span> Add a manager
        </a>
    </div>

    {{-- CARD --}}
    <div class="mgmt-card">

        {{-- CARD HEADER --}}
        <div class="mgmt-card__header">
            <span class="mgmt-card__label">All managers</span>
            <input
                type="text"
                id="mgmtSearch"
                class="mgmt-search"
                placeholder="Search by name or email…"
                oninput="mgmtFilter()"
            />
        </div>

        {{-- TABLE --}}
        <div class="mgmt-table-wrap">
            <table class="mgmt-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Position</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="mgmtTableBody">
                    @forelse($managements as $m)
                        <tr class="mgmt-row">

                            {{-- PHOTO --}}
                            <td>
                                @if($m->photo)
                                    <img src="{{ asset('storage/'.$m->photo) }}"
                                         class="mgmt-avatar"
                                         alt="Photo">
                                @else
                                    <div class="mgmt-avatar mgmt-avatar--placeholder">
                                        {{ strtoupper(substr(optional($m->translations->where('locale','ar')->first())->name ?? 'M', 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            {{-- NAME (AR + FR) --}}
                            <td>
                                <div class="mgmt-name">
                                    <span class="mgmt-name__primary">
                                        {{ optional($m->translations->where('locale','ar')->first())->name }}
                                    </span>
                                    <span class="mgmt-name__secondary">
                                        {{ optional($m->translations->where('locale','fr')->first())->name }}
                                    </span>
                                </div>
                            </td>

                            {{-- EMAIL --}}
                            <td class="mgmt-email">{{ $m->email }}</td>

                            {{-- PHONE --}}
                            <td class="mgmt-email">{{ $m->phone ?: '—' }}</td>

                            {{-- POSITION --}}
                            <td>
                                <span class="badge badge--pos">
                                    {{ ucfirst(str_replace('_', ' ', $m->position)) }}
                                </span>
                            </td>

                            {{-- TYPE --}}
                            <td>
                                @php
                                    $typeClass = match($m->type) {
                                        'current'  => 'badge--current',
                                        'former'   => 'badge--former',
                                        'honorary' => 'badge--honorary',
                                        'consultant' => 'badge--honorary',
                                        default    => 'badge--former',
                                    };
                                @endphp
                                <span class="badge {{ $typeClass }}">
                                    {{ ucfirst($m->type) }}
                                </span>
                            </td>

                            {{-- ACTIONS --}}
                            <td>
                                <div class="mgmt-actions">

                                    <a href="{{ route('managements.edit', $m->id) }}"
                                       class="btn-row btn-row--edit">
                                        <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('managements.destroy', $m->id) }}"
                                          method="POST"
                                          style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn-row btn-row--delete"
                                                onclick="return confirm('Delete this manager?')">
                                            <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><path d="M3 4h10M6 4V3h4v1M5 4l.5 9h5L11 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="mgmt-empty">No managers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <p id="mgmtNoResults" class="mgmt-empty" style="display:none;">No managers match your search.</p>
        </div>

        @if($managements->hasPages())
            <div class="mgmt-pagination">
                {{ $managements->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

</div>


{{-- SEARCH + AUTO-DISMISS SCRIPT --}}
<script>
function mgmtFilter() {
    var q = document.getElementById('mgmtSearch').value.toLowerCase();
    var rows = document.querySelectorAll('#mgmtTableBody .mgmt-row');
    var visible = 0;

    rows.forEach(function(row) {
        var text = row.innerText.toLowerCase();
        var show = text.indexOf(q) > -1;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    var noResults = document.getElementById('mgmtNoResults');
    noResults.style.display = visible === 0 ? 'block' : 'none';
}

// Auto-dismiss toasts after 4 seconds
document.querySelectorAll('.alert-toast').forEach(function(el) {
    setTimeout(function() {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 400);
    }, 4000);
});
</script>

@endsection
