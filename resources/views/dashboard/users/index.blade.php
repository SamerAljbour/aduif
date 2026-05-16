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
        <h1 class="mgmt-title">User Registration Approvals</h1>
    </div>

    {{-- TABS --}}
    <div style="margin-bottom: 20px; border-bottom: 2px solid #e2e8f0;">
        <div style="display: flex; gap: 20px;">
            <button onclick="switchTab('pending')" class="tab-button active" id="tab-pending">
                Pending ({{ $pendingUsers->total() }})
            </button>
            <button onclick="switchTab('approved')" class="tab-button" id="tab-approved">
                Approved ({{ $approvedUsers->total() }})
            </button>
            <button onclick="switchTab('rejected')" class="tab-button" id="tab-rejected">
                Rejected ({{ $rejectedUsers->total() }})
            </button>
        </div>
    </div>

    {{-- PENDING USERS --}}
    <div id="pending-tab" class="tab-content">
        <div class="mgmt-card">

            {{-- CARD HEADER --}}
            <div class="mgmt-card__header">
                <span class="mgmt-card__label">Pending User Registrations</span>
                <input type="text"
                       id="pendingSearch"
                       class="mgmt-search"
                       placeholder="Search user..."
                       oninput="filterTable('pending')" />
            </div>

            {{-- TABLE --}}
            <div class="mgmt-table-wrap">

                <table class="mgmt-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="pendingTableBody">

                        @forelse($pendingUsers as $user)
                            <tr class="mgmt-row" class="searchable-row">

                                {{-- NAME --}}
                                <td>{{ $user->name }}</td>

                                {{-- EMAIL --}}
                                <td class="mgmt-email">{{ $user->email }}</td>

                                {{-- REGISTERED AT --}}
                                <td>{{ $user->created_at->format('M d, Y H:i') }}</td>

                                {{-- ACTIONS --}}
                                <td>
                                        @if(auth()->check() && auth()->user()->email === 'aduif.jordanie@gmail.com' && auth()->id() !== $user->id)
                                        <div style="display: flex; gap: 10px;">
                                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn-row btn-row--edit" style="background-color: #10b981; color: white; border: none;">
                                                    ✓ Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.reject', $user) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn-row btn-row--edit" style="background-color: #ef4444; color: white; border: none;">
                                                    ✗ Reject
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="mgmt-empty">No pending user registrations.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
            @if($pendingUsers->hasPages())
                <div class="mgmt-pagination">
                    {{ $pendingUsers->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    {{-- APPROVED USERS --}}
    <div id="approved-tab" class="tab-content" style="display: none;">
        <div class="mgmt-card">

            {{-- CARD HEADER --}}
            <div class="mgmt-card__header">
                <span class="mgmt-card__label">Approved Users</span>
                <input type="text"
                       id="approvedSearch"
                       class="mgmt-search"
                       placeholder="Search user..."
                       oninput="filterTable('approved')" />
            </div>

            {{-- TABLE --}}
            <div class="mgmt-table-wrap">

                <table class="mgmt-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Approved At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="approvedTableBody">

                        @forelse($approvedUsers as $user)
                            <tr class="mgmt-row" class="searchable-row">

                                {{-- NAME --}}
                                <td>{{ $user->name }}</td>

                                {{-- EMAIL --}}
                                <td class="mgmt-email">{{ $user->email }}</td>

                                {{-- APPROVED AT --}}
                                <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>

                                {{-- STATUS --}}
                                <td>
                                    <span class="badge badge--honorary">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                {{-- ACTIONS --}}
                                <td>
                                        @if(auth()->check() && auth()->user()->email === 'aduif.jordanie@gmail.com' && auth()->id() !== $user->id)
                                            @if($user->is_active)
                                            <form action="{{ route('admin.users.deactivate', $user) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn-row btn-row--edit" style="background-color: #f59e0b; color: white; border: none;">
                                                    Deactivate
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.activate', $user) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn-row btn-row--edit" style="background-color: #10b981; color: white; border: none;">
                                                    Activate
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="mgmt-empty">No approved users.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
            @if($approvedUsers->hasPages())
                <div class="mgmt-pagination">
                    {{ $approvedUsers->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    {{-- REJECTED USERS --}}
    <div id="rejected-tab" class="tab-content" style="display: none;">
        <div class="mgmt-card">

            {{-- CARD HEADER --}}
            <div class="mgmt-card__header">
                <span class="mgmt-card__label">Rejected Users</span>
                <input type="text"
                       id="rejectedSearch"
                       class="mgmt-search"
                       placeholder="Search user..."
                       oninput="filterTable('rejected')" />
            </div>

            {{-- TABLE --}}
            <div class="mgmt-table-wrap">

                <table class="mgmt-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Rejected At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="rejectedTableBody">

                        @forelse($rejectedUsers as $user)
                            <tr class="mgmt-row" class="searchable-row">

                                {{-- NAME --}}
                                <td>{{ $user->name }}</td>

                                {{-- EMAIL --}}
                                <td class="mgmt-email">{{ $user->email }}</td>

                                {{-- REJECTED AT --}}
                                <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>

                                {{-- ACTIONS --}}
                                <td>
                                        @if(auth()->check() && auth()->user()->email === 'aduif.jordanie@gmail.com' && auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.reactivate', $user) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-row btn-row--edit" style="background-color: #3b82f6; color: white; border: none;">
                                                ↻ Reactivate
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="mgmt-empty">No rejected users.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
            @if($rejectedUsers->hasPages())
                <div class="mgmt-pagination">
                    {{ $rejectedUsers->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

</div>

<style>
    .tab-button {
        padding: 12px 20px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        color: #64748b;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .tab-button.active {
        color: #1e293b;
        border-bottom-color: #3b82f6;
    }

    .tab-button:hover {
        color: #1e293b;
    }

    .tab-content {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    function switchTab(tabName) {
        // Hide all tabs
        document.getElementById('pending-tab').style.display = 'none';
        document.getElementById('approved-tab').style.display = 'none';
        document.getElementById('rejected-tab').style.display = 'none';

        // Remove active class from all buttons
        document.getElementById('tab-pending').classList.remove('active');
        document.getElementById('tab-approved').classList.remove('active');
        document.getElementById('tab-rejected').classList.remove('active');

        // Show selected tab
        document.getElementById(tabName + '-tab').style.display = 'block';
        document.getElementById('tab-' + tabName).classList.add('active');
    }

    function filterTable(tabType) {
        const searchInput = document.getElementById(tabType + 'Search');
        const tableBody = document.getElementById(tabType + 'TableBody');
        const searchTerm = searchInput.value.toLowerCase();

        const rows = tableBody.getElementsByClassName('mgmt-row');
        for (let row of rows) {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        }
    }
</script>

@endsection
