@extends('adminLayouts.app')

@section('content')
{{-- {{ dd($requests) }} --}}
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
                                {{ $r->translations->where('locale', 'fr')->first()?->name }} <br>
                                {{ $r->translations->where('locale', 'ar')->first()?->name }}
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
                                    @elseif($r->status == 'rejected') badge--rejected
                                    @else badge--former
                                    @endif">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>

                            {{-- ACTIONS --}}
                            <td>
                                <div class="mgmt-actions">

                                    @if($r->status != 'approved')
                                        <button class="btn-row btn-row--edit"
                                                onclick="openJoinRequestModal(this)"
                                                data-request='@json($r, JSON_HEX_APOS | JSON_HEX_QUOT)'>
                                            View
                                        </button>

                                        {{-- APPROVE --}}
                                        <form action="{{ route('joinRequests.approve',$r->id) }}"
                                              method="POST">
                                            @csrf
                                            <button class="btn-row btn-row--edit">
                                                ✅ Accept
                                            </button>
                                        </form>
                                    @endif

                                    @if($r->status == 'pending')
                                        {{-- REJECT --}}
                                        <form action="{{ route('joinRequests.reject',$r->id) }}"
                                              method="POST">
                                            @csrf
                                            <button class="btn-row btn-row--delete">
                                                ❌ Reject
                                            </button>
                                        </form>

                                    @elseif($r->status == 'approved')
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
         @if($requests->hasPages())
            <div class="mgmt-pagination">
                {{ $requests->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>

{{-- MODAL --}}
<div id="joinRequestModal" class="mgmt-modal" style="display:none;">
    <div class="mgmt-modal__overlay" onclick="closeJoinRequestModal()"></div>

    <div class="mgmt-modal__container">
        <div class="mgmt-modal__header">
            <div class="mgmt-modal__header-left">
                <div id="modalAvatar" class="mgmt-avatar mgmt-avatar--modal"></div>
                <div>
                    <h3 class="mgmt-modal__title" id="modalName">Request Details</h3>
                    <span class="badge" id="modalStatusBadge"></span>
                </div>
            </div>
            <button class="mgmt-modal__close" onclick="closeJoinRequestModal()">x</button>
        </div>

        <div class="mgmt-modal__body" id="joinRequestModalBody"></div>
    </div>
</div>

<style>
.mgmt-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mgmt-modal__overlay {
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(3px);
}

.mgmt-modal__container {
    position: relative;
    background: #fff;
    border-radius: 16px;
    width: 92%;
    max-width: 860px;
    max-height: 88vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 24px 64px rgba(15,23,42,.18);
    overflow: hidden;
}

.mgmt-modal__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    flex-shrink: 0;
}

.mgmt-modal__header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.mgmt-modal__title {
    margin: 0 0 4px;
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
}

.mgmt-modal__close {
    background: #f1f5f9;
    border: none;
    border-radius: 8px;
    width: 34px;
    height: 34px;
    cursor: pointer;
    font-size: 14px;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .15s;
}
.mgmt-modal__close:hover { background: #e2e8f0; color: #0f172a; }

.mgmt-modal__body {
    padding: 0;
    overflow-y: auto;
    flex: 1;
}

.mgmt-avatar--modal {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    object-fit: cover;
    font-size: 20px;
}

.modal-section-title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #94a3b8;
    padding: 18px 24px 8px;
    border-top: 1px solid #f1f5f9;
    margin: 0;
}
.modal-section-title:first-child { border-top: none; }

.modal-info-table {
    width: 100%;
    border-collapse: collapse;
}

.modal-info-table td {
    padding: 10px 24px;
    font-size: 13.5px;
    color: #334155;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
}

.modal-info-table td:first-child {
    font-weight: 600;
    color: #64748b;
    width: 38%;
    white-space: nowrap;
}

.modal-docs-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 12px 24px 18px;
}

.modal-doc-card {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    text-decoration: none;
    color: #334155;
    font-size: 13px;
    font-weight: 500;
    transition: all .15s;
}
.modal-doc-card:hover {
    background: #eff6ff;
    border-color: #93c5fd;
    color: #1d4ed8;
}

.modal-doc-badge {
    font-size: 10px;
    background: #e0e7ff;
    color: #4338ca;
    border-radius: 4px;
    padding: 1px 6px;
    font-weight: 600;
    text-transform: uppercase;
}

.modal-empty-docs {
    padding: 12px 24px 18px;
    font-size: 13px;
    color: #94a3b8;
}

.badge--rejected {
    background: #fee2e2;
    color: #dc2626;
}
</style>

{{-- SCRIPTS --}}
<script>
function mgmtFilter() {
    let q = document.getElementById('mgmtSearch').value.toLowerCase();
    let rows = document.querySelectorAll('#mgmtTableBody .mgmt-row');

    rows.forEach(row => {
        row.style.display =
            row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
}

function escapeHtml(value) {
    return String(value ?? '').replace(/[&<>"']/g, char => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    }[char]));
}

function emptyValue() {
    return '<span style="color:#94a3b8">-</span>';
}

function openJoinRequestModal(btn) {
    const request = JSON.parse(btn.dataset.request);
    const ar = (request.translations || []).find(t => t.locale === 'ar') || {};
    const fr = (request.translations || []).find(t => t.locale === 'fr') || {};

    const avatarEl = document.getElementById('modalAvatar');
    avatarEl.outerHTML = request.photo
        ? `<img id="modalAvatar" src="/storage/${escapeHtml(request.photo)}" class="mgmt-avatar mgmt-avatar--modal" alt="photo">`
        : `<div id="modalAvatar" class="mgmt-avatar mgmt-avatar--placeholder mgmt-avatar--modal">${escapeHtml((fr.name || ar.name || 'R').charAt(0).toUpperCase())}</div>`;

    document.getElementById('modalName').textContent = fr.name || ar.name || 'Request Details';

    const badge = document.getElementById('modalStatusBadge');
    badge.textContent = request.status
        ? request.status.charAt(0).toUpperCase() + request.status.slice(1)
        : 'Pending';
    badge.className = 'badge ' + (
        request.status === 'approved' ? 'badge--honorary' :
        request.status === 'rejected' ? 'badge--rejected' : 'badge--current'
    );

    const docs = request.documents || [];
    const docsHtml = docs.length
        ? `<div class="modal-docs-grid">
            ${docs.map((doc, i) => `
                <a href="/storage/${escapeHtml(doc.file_path)}" target="_blank" class="modal-doc-card">
                    <span>File</span>
                    <span>Document ${i + 1}</span>
                    <span class="modal-doc-badge">${escapeHtml(doc.type || 'file')}</span>
                </a>
            `).join('')}
           </div>`
        : '<p class="modal-empty-docs">No documents attached.</p>';

    const cvHtml = request.cv
        ? `<a href="/storage/${escapeHtml(request.cv)}" target="_blank" class="btn-row btn-row--edit">View CV</a>`
        : '<span style="color:#94a3b8">No CV uploaded</span>';

    const row = (label, value) => `
        <tr>
            <td>${escapeHtml(label)}</td>
            <td>${value ? value : emptyValue()}</td>
        </tr>`;

    const textRow = (label, value) => row(label, escapeHtml(value));
    const nationality = request.nationality
        ? request.nationality.replace(/_/g, ' ').replace(/\b\w/g, letter => letter.toUpperCase())
        : '';

    document.getElementById('joinRequestModalBody').innerHTML = `
        <p class="modal-section-title">Basic Info</p>
        <table class="modal-info-table">
            ${textRow('Email', request.email)}
            ${textRow('Phone', request.phone)}
            ${textRow('Nationality', nationality)}
            ${row('CV', cvHtml)}
        </table>

        <p class="modal-section-title">Arabic</p>
        <table class="modal-info-table">
            ${textRow('Name', ar.name)}
            ${textRow('Specialization', ar.specialization)}
            ${textRow('Degree', ar.degree)}
            ${textRow('University', ar.graduation_university)}
            ${textRow('Current Job', ar.current_job)}
            ${textRow('Workplace', ar.workplace)}
            ${textRow('Interests', ar.interests)}
            ${textRow('Bio', ar.bio)}
        </table>

        <p class="modal-section-title">French</p>
        <table class="modal-info-table">
            ${textRow('Name', fr.name)}
            ${textRow('Specialization', fr.specialization)}
            ${textRow('Degree', fr.degree)}
            ${textRow('University', fr.graduation_university)}
            ${textRow('Current Job', fr.current_job)}
            ${textRow('Workplace', fr.workplace)}
            ${textRow('Interests', fr.interests)}
            ${textRow('Bio', fr.bio)}
        </table>

        <p class="modal-section-title">Documents</p>
        ${docsHtml}
    `;

    document.getElementById('joinRequestModal').style.display = 'flex';
}

function closeJoinRequestModal() {
    document.getElementById('joinRequestModal').style.display = 'none';
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeJoinRequestModal();
});
</script>

@endsection
