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
        <h1 class="mgmt-title">Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn-add">
            <span class="btn-add__icon">+</span> Add a Project
        </a>
    </div>

    {{-- CARD --}}
    <div class="mgmt-card">

        {{-- CARD HEADER --}}
        <div class="mgmt-card__header">
            <span class="mgmt-card__label">All Projects</span>
            <input
                type="text"
                id="mgmtSearch"
                class="mgmt-search"
                placeholder="Search by title or status…"
                oninput="mgmtFilter()"
            />
        </div>

        {{-- TABLE --}}
        <div class="mgmt-table-wrap">
            <table class="mgmt-table">
                <thead>
                    <tr>
                        <th>Title (AR)</th>
                        <th>Title (FR)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="mgmtTableBody">
                    @forelse($projects as $p)
                        <tr class="mgmt-row">

                            {{-- TITLE AR --}}
                            <td>
                                {{ optional($p->translations->where('locale','ar')->first())->title }}
                            </td>

                            {{-- TITLE FR --}}
                            <td>
                                {{ optional($p->translations->where('locale','fr')->first())->title }}
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @php
                                    $statusClass = match($p->status) {
                                        'active' => 'badge--current',
                                        'completed' => 'badge--honorary',
                                        default => 'badge--former',
                                    };
                                @endphp

                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_',' ', $p->status)) }}
                                </span>
                            </td>

                            {{-- ACTIONS --}}
                            <td>
                                <div class="mgmt-actions">

                                    <a href="{{ route('projects.edit', $p->id) }}"
                                       class="btn-row btn-row--edit">
                                        <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('projects.destroy', $p->id) }}"
                                          method="POST"
                                          style="display:inline-block">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn-row btn-row--delete"
                                                onclick="return confirm('Delete this project?')">
                                            <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><path d="M3 4h10M6 4V3h4v1M5 4l.5 9h5L11 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="mgmt-empty">No projects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <p id="mgmtNoResults" class="mgmt-empty" style="display:none;">
                No projects match your search.
            </p>
        </div>

    </div>

</div>

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

document.querySelectorAll('.alert-toast').forEach(function(el) {
    setTimeout(function() {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 400);
    }, 4000);
});
</script>

@endsection
