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
        <h1 class="mgmt-title">Members</h1>
    </div>

    <div class="mgmt-card">

        {{-- CARD HEADER --}}
        <div class="mgmt-card__header">
            <span class="mgmt-card__label">All Members</span>

            <input type="text"
                   id="mgmtSearch"
                   class="mgmt-search"
                   placeholder="Search member..."
                   oninput="mgmtFilter()" />
        </div>

        {{-- TABLE --}}
        <div class="mgmt-table-wrap">

            <table class="mgmt-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name (AR)</th>
                        <th>Name (FR)</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>CV</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="mgmtTableBody">

                    @forelse($members as $m)
                        <tr class="mgmt-row">

                            {{-- PHOTO --}}
                            <td>
                                @if($m->photo)
                                    <img src="{{ asset('storage/'.$m->photo) }}"
                                         class="mgmt-avatar">
                                @else
                                    <div class="mgmt-avatar mgmt-avatar--placeholder">
                                        {{ strtoupper(substr(optional($m->translation('ar'))->name ?? 'M', 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            {{-- NAME AR --}}
                            <td>{{ optional($m->translation('ar'))->name }}</td>

                            {{-- NAME FR --}}
                            <td>{{ optional($m->translation('fr'))->name }}</td>

                            {{-- EMAIL --}}
                            <td class="mgmt-email">{{ $m->email }}</td>

                            {{-- STATUS --}}
                            <td>
                                <span class="badge {{ $m->status == 'approved' ? 'badge--honorary' : ($m->status == 'rejected' ? 'badge--rejected' : 'badge--former') }}">
                                    {{ ucfirst($m->status) }}
                                </span>
                            </td>

                            {{-- CV --}}
                            <td>
                                @if($m->cv)
                                    <a href="{{ asset('storage/'.$m->cv) }}"
                                       target="_blank"
                                       class="btn-row btn-row--edit">
                                        📄 CV
                                    </a>
                                @else
                                    <span style="font-size:12px;color:#64748b;">No CV</span>
                                @endif
                            </td>

                            {{-- ACTIONS --}}
                            <td>
                                <button class="btn-row btn-row--edit"
                                        onclick="openMemberModal(this)"
                                                  data-member='@json($m->load("translations", "documents"), JSON_HEX_APOS | JSON_HEX_QUOT)'>
                                    👁 View
                                </button>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="mgmt-empty">No members found.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="memberModal" class="mgmt-modal" style="display:none;">
    <div class="mgmt-modal__overlay" onclick="closeMemberModal()"></div>

    <div class="mgmt-modal__container">

        {{-- MODAL HEADER --}}
        <div class="mgmt-modal__header">
            <div class="mgmt-modal__header-left">
                <div id="modalAvatar" class="mgmt-avatar mgmt-avatar--modal"></div>
                <div>
                    <h3 class="mgmt-modal__title" id="modalName">Member Details</h3>
                    <span class="badge" id="modalStatusBadge"></span>
                </div>
            </div>
            <button class="mgmt-modal__close" onclick="closeMemberModal()">✕</button>
        </div>

        {{-- MODAL BODY --}}
        <div class="mgmt-modal__body" id="memberModalBody"></div>

    </div>
</div>

<style>
/* ── MODAL OVERRIDES ────────────────────────────────────── */
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

/* Header — same bg as mgmt-card__header */
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

/* Body */
.mgmt-modal__body {
    padding: 0;
    overflow-y: auto;
    flex: 1;
}

/* Avatar in modal header */
.mgmt-avatar--modal {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    object-fit: cover;
    font-size: 20px;
}

/* ── SECTION TABLE inside modal ─────────────────────────── */
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

/* Documents grid */
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

.modal-doc-icon { font-size: 18px; }

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

/* Status badge fix */
.badge--rejected {
    background: #fee2e2;
    color: #dc2626;
}
</style>

<script>
function mgmtFilter() {
    const q = document.getElementById('mgmtSearch').value.toLowerCase();
    document.querySelectorAll('#mgmtTableBody .mgmt-row').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
}

function openMemberModal(btn) {
    const member = JSON.parse(btn.dataset.member);
    // console.log(member);
    const ar = (member.translations || []).find(t => t.locale === 'ar') || {};
    const fr = (member.translations || []).find(t => t.locale === 'fr') || {};

    // ── Avatar
    const avatarEl = document.getElementById('modalAvatar');
    if (member.photo) {
        avatarEl.outerHTML = `<img id="modalAvatar" src="/storage/${member.photo}" class="mgmt-avatar mgmt-avatar--modal" alt="photo">`;
    } else {
        const initial = (ar.name || fr.name || 'M').charAt(0).toUpperCase();
        const el = document.getElementById('modalAvatar');
        el.className = 'mgmt-avatar mgmt-avatar--placeholder mgmt-avatar--modal';
        el.textContent = initial;
    }

    // ── Header name + badge
    document.getElementById('modalName').textContent = ar.name || fr.name || '—';
    const badge = document.getElementById('modalStatusBadge');
    badge.textContent = member.status.charAt(0).toUpperCase() + member.status.slice(1);
    badge.className = 'badge ' + (
        member.status === 'approved' ? 'badge--honorary' :
        member.status === 'rejected' ? 'badge--rejected' : 'badge--former'
    );

    // ── Documents from joinRequest
const docs = member.documents || [];
    const docsHtml = docs.length
        ? `<div class="modal-docs-grid">
            ${docs.map((doc, i) => `
                <a href="/storage/${doc.file_path}" target="_blank" class="modal-doc-card">
                    <span class="modal-doc-icon">${doc.type === 'certificate' ? '🎓' : '📄'}</span>
                    <span>Document ${i + 1}</span>
                    <span class="modal-doc-badge">${doc.type}</span>
                </a>
            `).join('')}
           </div>`
        : `<p class="modal-empty-docs">No documents attached.</p>`;

    // ── CV row
    const cvHtml = member.cv
        ? `<a href="/storage/${member.cv}" target="_blank" class="btn-row btn-row--edit">📄 View CV</a>`
        : `<span style="color:#94a3b8">No CV uploaded</span>`;

    // ── Rows helper
    const row = (label, value) => `
        <tr>
            <td>${label}</td>
            <td>${value || '<span style="color:#94a3b8">—</span>'}</td>
        </tr>`;

    document.getElementById('memberModalBody').innerHTML = `

        {{-- BASIC INFO --}}
        <p class="modal-section-title">Basic Info</p>
        <table class="modal-info-table">
            ${row('Email', member.email)}
            ${row('CV', cvHtml)}
        </table>

        {{-- ARABIC --}}
        <p class="modal-section-title">Arabic (عربي)</p>
        <table class="modal-info-table">
            ${row('Name', ar.name)}
            ${row('Specialization', ar.specialization)}
            ${row('Degree', ar.degree)}
            ${row('University', ar.graduation_university)}
            ${row('Current Job', ar.current_job)}
            ${row('Workplace', ar.workplace)}
            ${row('Interests', ar.interests)}
            ${row('Bio', ar.bio)}
        </table>

        {{-- FRENCH --}}
        <p class="modal-section-title">French (Français)</p>
        <table class="modal-info-table">
            ${row('Name', fr.name)}
            ${row('Specialization', fr.specialization)}
            ${row('Degree', fr.degree)}
            ${row('University', fr.graduation_university)}
            ${row('Current Job', fr.current_job)}
            ${row('Workplace', fr.workplace)}
            ${row('Interests', fr.interests)}
            ${row('Bio', fr.bio)}
        </table>

        {{-- DOCUMENTS --}}
        <p class="modal-section-title">Documents</p>
        ${docsHtml}
    `;

    document.getElementById('memberModal').style.display = 'flex';
}

function closeMemberModal() {
    document.getElementById('memberModal').style.display = 'none';
}

// Close on Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeMemberModal();
});
</script>

@endsection
