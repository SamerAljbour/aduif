@extends('userLayouts.app')

@section('content')

<style>
/* ─── Variables ──────────────────────────────────────────── */
:root {
    --gold:         #c9a84c;
    --gold-light:   #f0d080;
    --gold-glow:    rgba(201,168,76,.22);
    --silver:       #6b7a99;
    --bronze:       #a0714f;
    --blue:         #4c7ec9;
    --bg:           #f0f2f8;
    --card-bg:      #ffffff;
    --text-dark:    #1a2340;
    --text-muted:   #6b7a99;
    --connector:    #b0bcd8;
    --radius:       20px;
    --tr:           .22s cubic-bezier(.4,0,.2,1);
}

/* ─── Page ───────────────────────────────────────────────── */
.org-page {
    background: var(--bg);
    min-height: 100vh;
    padding: 56px 24px 100px;
    font-family: 'Segoe UI', Tahoma, system-ui, sans-serif;
    direction: rtl;
}
.org-page .page-title {
    text-align: center;
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 56px;
}
.org-page .page-title span {
    border-bottom: 3px solid var(--gold);
    padding-bottom: 6px;
}

/* ─── Tree ───────────────────────────────────────────────── */
.org-tree { display:flex; flex-direction:column; align-items:center; }
.org-node { display:flex; flex-direction:column; align-items:center; }

/* ─── Connectors ─────────────────────────────────────────── */
.conn-v {
    width: 2px;
    height: 44px;
    background: var(--connector);
    flex-shrink: 0;
}
.siblings-row {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 28px;
    flex-wrap: wrap;
    position: relative;
}
/* horizontal bar spanning across siblings */
.siblings-row::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    height: 2px;
    background: var(--connector);
    /* width: calc(100% - 218px); leave margin equal to half a card */
    width: calc(100% - 124px);
    min-width: 2px;
}
/* single child — no horizontal bar needed */
.siblings-row.single::before { display: none; }

.sibling-branch { display:flex; flex-direction:column; align-items:center; }
.children-wrap  { display:flex; flex-direction:column; align-items:center; width:100%; }

/* ─── CARD ───────────────────────────────────────────────── */
.org-card {
    background: var(--card-bg);
    border-radius: var(--radius);
    box-shadow: 0 2px 18px rgba(30,40,90,.08);
    padding: 28px 22px 22px;
    width: 220px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    border: 2.5px solid transparent;
    transition: transform var(--tr), box-shadow var(--tr), border-color var(--tr);
    text-align: center;
    user-select: none;
}
.org-card:hover     { transform:translateY(-5px); box-shadow:0 12px 38px rgba(30,40,90,.15); }
.org-card:focus-visible { outline:3px solid var(--gold); outline-offset:2px; }

.card-photo,.card-photo-ph {
    width: 90px; height: 90px;
    border-radius: 50%;
    border: 3.5px solid #dde3f0;
    object-fit: cover;
    background: linear-gradient(135deg,#e4e8f4,#c8d0e8);
    display: flex; align-items:center; justify-content:center;
    font-size: 2.3rem; color: var(--text-muted);
    flex-shrink: 0;
    transition: transform var(--tr);
}
.org-card:hover .card-photo,
.org-card:hover .card-photo-ph { transform:scale(1.07); }

.card-name  { font-size:1rem; font-weight:700; color:var(--text-dark); line-height:1.35; }
.card-badge { font-size:.78rem; font-weight:700; padding:5px 16px; border-radius:30px; white-space:nowrap; }
.card-hint  { font-size:.7rem; color:var(--text-muted); opacity:0; transition:opacity var(--tr); margin-top:-4px; }
.org-card:hover .card-hint { opacity:1; }

/* ── Position skins ── */
.card--president {
    width:260px;
    border-color:var(--gold);
    background:linear-gradient(145deg,#fffdf4,#fff8e1);
    box-shadow:0 6px 36px var(--gold-glow);
}
.card--president:hover { box-shadow:0 16px 52px var(--gold-glow); }
.card--president .card-photo,.card--president .card-photo-ph {
    width:110px; height:110px;
    border-color:var(--gold);
    box-shadow:0 0 0 5px rgba(201,168,76,.18);
}
.card--president .card-name  { font-size:1.12rem; }
.card--president .card-badge {
    background:linear-gradient(135deg,var(--gold),var(--gold-light));
    color:#fff; font-size:.84rem; padding:6px 22px;
}

.card--vice_president { border-color:rgba(107,122,153,.3); }
.card--vice_president:hover { border-color:var(--silver); }
.card--vice_president .card-photo,.card--vice_president .card-photo-ph { border-color:var(--silver); }
.card--vice_president .card-badge { background:linear-gradient(135deg,var(--silver),#8e9fc5); color:#fff; }

.card--secretary { border-color:rgba(160,113,79,.25); }
.card--secretary:hover { border-color:var(--bronze); }
.card--secretary .card-photo,.card--secretary .card-photo-ph { border-color:var(--bronze); }
.card--secretary .card-badge { background:linear-gradient(135deg,var(--bronze),#c49a6c); color:#fff; }

.card--treasurer { border-color:rgba(120,78,42,.22); }
.card--treasurer:hover { border-color:#7a4e2a; }
.card--treasurer .card-photo,.card--treasurer .card-photo-ph { border-color:#7a4e2a; }
.card--treasurer .card-badge { background:linear-gradient(135deg,#7a4e2a,#b07840); color:#fff; }

.card--board_member { border-color:rgba(76,126,201,.2); }
.card--board_member:hover { border-color:var(--blue); }
.card--board_member .card-photo,.card--board_member .card-photo-ph { border-color:var(--blue); }
.card--board_member .card-badge { background:linear-gradient(135deg,var(--blue),#80aaef); color:#fff; }

/* ─── MODAL ──────────────────────────────────────────────── */
.mgmt-overlay {
    display:none; position:fixed; inset:0;
    background:rgba(10,20,55,.52);
    backdrop-filter:blur(6px);
    -webkit-backdrop-filter:blur(6px);
    z-index:9999;
    align-items:center; justify-content:center;
    padding:20px;
}
.mgmt-overlay.open { display:flex; }
.mgmt-modal {
    background:#fff; border-radius:24px;
    padding:40px 36px 32px;
    max-width:500px; width:100%;
    position:relative;
    box-shadow:0 24px 80px rgba(0,0,0,.22);
    animation:modalPop .22s ease;
    direction:rtl; max-height:88vh; overflow-y:auto;
}
@keyframes modalPop {
    from { opacity:0; transform:translateY(24px) scale(.96); }
    to   { opacity:1; transform:none; }
}
.mgmt-modal-close {
    position:absolute; top:16px; left:20px;
    background:#f0f2f8; border:none;
    width:32px; height:32px; border-radius:50%;
    font-size:1.1rem; color:var(--text-muted);
    cursor:pointer; display:flex; align-items:center; justify-content:center;
    transition:background var(--tr),color var(--tr);
}
.mgmt-modal-close:hover { background:#e0e4ef; color:var(--text-dark); }
.modal-pos-badge { display:inline-block; font-size:.82rem; font-weight:700; padding:5px 18px; border-radius:30px; margin-bottom:20px; }
.modal-label { font-size:.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.6px; margin:20px 0 8px; }
.modal-bio   { font-size:.93rem; color:var(--text-dark); line-height:1.75; background:#f6f7fb; border-radius:12px; padding:14px 16px; }
.modal-email {
    display:inline-flex; align-items:center; gap:7px;
    font-size:.9rem; color:var(--blue); text-decoration:none; font-weight:600;
    padding:8px 14px; background:#eef4ff; border-radius:10px;
    transition:background var(--tr);
}
.modal-email:hover { background:#dce9ff; }
.modal-empty { color:var(--text-muted); font-size:.9rem; margin-top:8px; text-align:center; padding:16px 0; }

/* ─── Responsive ─────────────────────────────────────────── */
@media(max-width:700px){
    .org-card { width:165px; padding:18px 12px 14px; }
    .card--president { width:195px; }
    .card-photo,.card-photo-ph { width:68px; height:68px; font-size:1.6rem; }
    .card--president .card-photo,.card--president .card-photo-ph { width:80px; height:80px; }
    .siblings-row { gap:12px; }
    .mgmt-modal { padding:28px 18px 22px; }
}
</style>

<div class="org-page">
    <h2 class="page-title"><span>الهيكل الإداري</span></h2>

    <div class="org-tree">
        @include('management._level', ['nodes' => $tree])
    </div>
</div>

{{-- Modal --}}
<div class="mgmt-overlay" id="mgmtOverlay" role="dialog" aria-modal="true">
    <div class="mgmt-modal" id="mgmtModal" tabindex="-1">
        <button class="mgmt-modal-close" onclick="closeMgmtModal()" aria-label="إغلاق">✕</button>
        <div id="mgmtModalBody"></div>
    </div>
</div>

<script>
const mgmtMap = {};
document.querySelectorAll('.org-card').forEach(c => {
    mgmtMap[c.dataset.id] = {
        email: c.dataset.email || '',
        bio:   c.dataset.bio   || '',
        badge: c.dataset.badge || '',
        pos:   c.dataset.position || '',
    };
});

const badgeStyle = {
    president:      'background:linear-gradient(135deg,#c9a84c,#f0d080);color:#fff',
    vice_president: 'background:linear-gradient(135deg,#6b7a99,#8e9fc5);color:#fff',
    secretary:      'background:linear-gradient(135deg,#a0714f,#c49a6c);color:#fff',
    treasurer:      'background:linear-gradient(135deg,#7a4e2a,#b07840);color:#fff',
    board_member:   'background:linear-gradient(135deg,#4c7ec9,#80aaef);color:#fff',
};

function openMgmtModal(id) {
    const m = mgmtMap[id];
    if (!m) return;
    let html = `<span class="modal-pos-badge" style="${badgeStyle[m.pos]||''}">${m.badge}</span>`;
    if (m.bio)   html += `<div class="modal-label">نبذة</div><div class="modal-bio">${m.bio}</div>`;
    if (m.email) html += `<div class="modal-label">البريد الإلكتروني</div>
        <a class="modal-email" href="mailto:${m.email}">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 7 10-7"/>
          </svg>${m.email}</a>`;
    if (!m.bio && !m.email) html += `<p class="modal-empty">لا توجد تفاصيل إضافية.</p>`;
    document.getElementById('mgmtModalBody').innerHTML = html;
    document.getElementById('mgmtOverlay').classList.add('open');
    document.getElementById('mgmtModal').focus();
}
function closeMgmtModal() {
    document.getElementById('mgmtOverlay').classList.remove('open');
}
document.getElementById('mgmtOverlay').addEventListener('click', e => {
    if (e.target === e.currentTarget) closeMgmtModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMgmtModal(); });
</script>

@endsection
