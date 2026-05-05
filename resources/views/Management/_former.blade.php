{{--
    management/_former.blade.php
    ─────────────────────────────
    Tab 2 — Former / past board members.
    Receives: $formerMembers  (Collection of Management models, type = 'former')

    Each card shows:
      • Profile photo (circular)
      • Full name
      • Position badge
      • Date range  (date_from → date_to)
      • Bio snippet (3 lines, clamped)

    Clicking a card opens the shared modal (openMgmtModal).
--}}

@php
    $locale = app()->getLocale();
@endphp

@if($formerMembers->isEmpty())
    <p style="text-align:center;color:var(--text-muted);padding:60px 0;font-size:1rem;">
        {{ __('management.no_former') }}
    </p>
@else
    <div class="members-grid">
        @foreach($formerMembers as $member)
            @php
                $tr    = $member->translations->firstWhere('locale', $locale)
                      ?? $member->translations->firstWhere('locale', 'ar')
                      ?? $member->translations->first();
                $name  = $tr?->name ?? '—';
                $bio   = $tr?->bio  ?? '';
                $label = \App\Models\Management::positionLabel($member->position);
                $photo = $member->photo ? asset('storage/' . $member->photo) : null;

                /* Date range stored directly on the model (add these columns if needed) */
                $from  = isset($member->date_from) && $member->date_from
                            ? \Carbon\Carbon::parse($member->date_from)->format('Y')
                            : null;
                $to    = isset($member->date_to) && $member->date_to
                            ? \Carbon\Carbon::parse($member->date_to)->format('Y')
                            : null;

                /* Strip colour per position */
                $stripClass = match($member->position) {
                    'president'      => '',           // gold (default)
                    'vice_president' => 'member-card__strip--silver',
                    default          => 'member-card__strip--blue',
                };
                $badgeClass = match($member->position) {
                    'president'      => '',
                    'vice_president' => 'member-badge--silver',
                    default          => 'member-badge--blue',
                };
            @endphp

            {{-- ── Card ── --}}
            <div class="member-card"
                 data-mgmt-id="{{ $member->id }}"
                 data-position="{{ $member->position }}"
                 data-name="{{ $name }}"
                 data-photo="{{ $photo ?? '' }}"
                 data-email="{{ $member->email ?? '' }}"
                 data-bio="{{ $bio }}"
                 data-badge="{{ $label }}"
                 data-date-from="{{ $from ?? '' }}"
                 data-date-to="{{ $to ?? '' }}"
                 data-type="former"
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

                    {{-- Position badge --}}
                    <span class="member-badge {{ $badgeClass }}">{{ $label }}</span>

                    {{-- Date range --}}
                    @if($from || $to)
                        <div class="member-dates">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>
                            {{ $from ?? '?' }} — {{ $to ?? __('management.present') }}
                        </div>
                    @endif

                    {{-- Bio snippet --}}
                    @if($bio)
                        <p class="member-bio">{{ $bio }}</p>
                    @endif

                </div>{{-- /member-card__body --}}
            </div>{{-- /member-card --}}

        @endforeach
    </div>{{-- /members-grid --}}
@endif
