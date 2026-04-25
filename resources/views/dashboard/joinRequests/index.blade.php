@extends('adminLayouts.app')

@section('content')

{{-- SUCCESS --}}
@if (session('success'))
<div class="alert-toast alert-toast--success">
    {{ session('success') }}
</div>
@endif

{{-- ERROR --}}
@if (session('error'))
<div class="alert-toast alert-toast--error">
    {{ session('error') }}
</div>
@endif

<div class="mgmt-wrap">

    {{-- HEADER --}}
    <div class="mgmt-header">
        <h1 class="mgmt-title">Join Requests</h1>
    </div>

    <div class="mgmt-card">

        <div class="mgmt-card__header">
            <span class="mgmt-card__label">All Requests</span>

            <input type="text"
                   id="mgmtSearch"
                   class="mgmt-search"
                   placeholder="Search..."
                   oninput="mgmtFilter()" />
        </div>

        <div class="mgmt-table-wrap">

            <table class="mgmt-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Nationality</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="mgmtTableBody">

                    @forelse($requests as $r)
                        <tr class="mgmt-row">

                            {{-- PHOTO --}}
                            <td>
                                @if($r->photo)
                                    <img src="{{ asset('storage/'.$r->photo) }}"
                                         class="mgmt-avatar">
                                @else
                                    <div class="mgmt-avatar mgmt-avatar--placeholder">
                                        {{ strtoupper(substr($r->name,0,1)) }}
                                    </div>
                                @endif
                            </td>

                            {{-- NAME --}}
                            <td class="mgmt-name__primary">
                                {{ $r->name }}
                            </td>

                            {{-- EMAIL --}}
                            <td class="mgmt-email">
                                {{ $r->email }}
                            </td>

                            {{-- NATIONALITY --}}
                            <td>
                                {{ ucfirst(str_replace('_',' ', $r->nationality)) }}
                            </td>

                            {{-- STATUS --}}
                            <td>
                                <span class="badge
                                    @if($r->status == 'pending') badge--current
                                    @elseif($r->status == 'approved') badge--honorary
                                    @else badge--former
                                    @endif">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>

                            {{-- ACTIONS --}}
                            <td>
                                <div class="mgmt-actions">

                                    @if($r->status == 'pending')

                                        {{-- APPROVE --}}
                                        <form action="{{ route('joinRequests.approve',$r->id) }}"
                                              method="POST">
                                            @csrf
                                            <button class="btn-row btn-row--edit">
                                                ✅ Accept
                                            </button>
                                        </form>

                                        {{-- REJECT --}}
                                        <form action="{{ route('joinRequests.reject',$r->id) }}"
                                              method="POST">
                                            @csrf
                                            <button class="btn-row btn-row--delete">
                                                ❌ Reject
                                            </button>
                                        </form>

                                    @else
                                        <span style="font-size:12px;color:#64748b;">
                                            No actions
                                        </span>
                                    @endif

                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="mgmt-empty">
                                No requests found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>

{{-- SEARCH SCRIPT --}}
<script>
function mgmtFilter() {
    let q = document.getElementById('mgmtSearch').value.toLowerCase();
    let rows = document.querySelectorAll('#mgmtTableBody .mgmt-row');

    rows.forEach(row => {
        row.style.display =
            row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>

@endsection
