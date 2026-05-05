{{--
    management/_honorary_card.blade.php
    ─────────────────────────────────────
    Reusable single card for Tab 3 (honorary / consultant).
    Received variables:
        $member     — Management model
        $locale     — current locale string
        $cardTheme  — 'gold' | 'blue' | 'silver'
--}}

@php
    $tr    = $member->translations->firstWhere('locale', $locale)
          ?? $member->translations->firstWhere('locale', 'ar')
          ?? $member->translations->first();
    $name  = $tr?->name ?? '—';
    $bio   = $tr?->bio  ?? '';
    $label = \App\Models\Management::positionLabel($member->position);
    $photo = $member->photo ? asset('storage/' . $member->photo) : null;

    /* Theme → strip + badge CSS classes */
    $stripClass = match($cardTheme) {
        'silver' => 'member-card__strip--silver',
        'blue'   => 'member-card__strip--blue',
        default  => '',   // gold
    };
    $badgeClass = match($cardTheme) {
        'silver' => 'member-badge--silver',
        'blue'   => 'member-badge--blue',
        default  => '',   // gold
    };

    /* Type label override for badge text */
    $typeLabel = match($member->type) {
        'consultant' => __('management.consultant_label'),
        'honorary'   => __('management.honorary_label'),
        default      => $label,
    };
@endphp

<div class="member-card"
     data-mgmt-id="{{ $member->id }}"
     data-position="{{ $member->position }}"
     data-name="{{ $name }}"
     data-photo="{{ $photo ?? '' }}"
     data-email="{{ $member->email ?? '' }}"
     data-bio="{{ $bio }}"
     data-badge="{{ $typeLabel }}"
     data-date-from=""
     data-date-to=""
     data-type="{{ $member->type }}"
     onclick="openMgmtModal('{{ $member->id }}')"
     role="button"
     tabindex="0"
     style="cursor:pointer;"
     aria-label="{{ $name }}">

    {{-- Coloured top strip --}}
    <div class="member-card__strip {{ $stripClass }}"></div>

    <div class="member-card__body">

        {{-- Photo --}}
        @if($photo)
            <img class="member-avatar" src="{{ $photo }}" alt="{{ $name }}">
        @else
            <div class="member-avatar">👤</div>
        @endif

        {{-- Name --}}
        <div class="member-name">{{ $name }}</div>

        {{-- Position label --}}
        <div style="font-size:.82rem;color:var(--text-muted);font-weight:600;">
            {{ $label }}
        </div>

        {{-- Type badge (Honorary / Consultant) --}}
        <span class="member-badge {{ $badgeClass }}">{{ $typeLabel }}</span>

        {{-- Bio snippet --}}
        @if($bio)
            <p class="member-bio">{{ $bio }}</p>
        @endif

    </div>{{-- /member-card__body --}}
</div>{{-- /member-card --}}
