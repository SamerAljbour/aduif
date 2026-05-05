{{--
    management/_level.blade.php
    ───────────────────────────
    Receives a Collection of Management nodes at the SAME depth.
    Groups them by position so that multiple secretaries / treasurers
    appear side-by-side, then recurses into their children.

    Usage:
        @include('management._level', ['nodes' => $someCollection])
--}}

@php
    /*
     * We want:
     *   1. Render the nodes grouped by position, in position-rank order.
     *   2. For each position group, gather ALL children from ALL members
     *      of that group and render them as the next level.
     *
     * Position rank (controls top-to-bottom order):
     */
    $rankMap = [
        'president'      => 1,
        'vice_president' => 2,
        'secretary'      => 3,
        'treasurer'      => 4,
        'board_member'   => 5,
    ];

    // Group nodes by position, preserving rank order
    $groups = $nodes
        ->groupBy('position')
        ->sortBy(fn($g, $pos) => $rankMap[$pos] ?? 99);
@endphp

@foreach($groups as $position => $members)

    @php
        $isSingle = $members->count() === 1;

        // Collect ALL children from every member of this position group
        $allChildren = $members->flatMap(fn($m) => $m->allChildren ?? collect());

        $label = \App\Models\Management::positionLabel($position);
    @endphp

    {{-- ── Node block for this position group ── --}}
    <div class="org-node">

        {{-- Siblings row (or single card) --}}
        <div class="siblings-row {{ $isSingle ? 'single' : '' }}">

            @foreach($members as $member)
                @php
                    $locale      = app()->getLocale();
                    $translation = $member->translations->firstWhere('locale', $locale)
                                ?? $member->translations->firstWhere('locale', 'en');
                    $name  = $translation?->name ?? '—';
                    $bio   = $translation?->bio   ?? '';
                    $photo = $member->photo ? asset('storage/'.$member->photo) : null;
                @endphp

                <div class="sibling-branch">
                    {{-- Drop-line into each card when there are siblings --}}
                    @if(!$isSingle)
                        <div class="conn-v" style="height:32px;"></div>
                    @endif

                    {{-- The card --}}
                    <div class="org-card card--{{ $position }}"
                         data-mgmt-id="{{ $member->id }}"
                         data-position="{{ $position }}"
                         data-name="{{ $name }}"
                         data-photo="{{ $photo ?? '' }}"
                         data-email="{{ $member->email }}"
                         data-bio="{{ $bio }}"
                         data-badge="{{ $label }}"
                         data-date-from=""
                         data-date-to=""
                         data-type="current"
                         onclick="openMgmtModal('{{ $member->id }}')"
                         tabindex="0"
                         role="button"
                         aria-label="{{ $name }}">

                        {{-- Photo --}}
                        @if($photo)
                            <img class="card-photo" src="{{ $photo }}" alt="{{ $name }}">
                        @else
                            <div class="card-photo-ph">👤</div>
                        @endif

                        <div class="card-name">{{ $name }}</div>
                        <span class="card-badge">{{ $label }}</span>
                        <span class="card-hint">انقر للتفاصيل</span>
                    </div>
                </div>
            @endforeach

        </div>{{-- /siblings-row --}}

        {{-- ── Children of this entire position group ── --}}
        @if($allChildren->isNotEmpty())
            <div class="children-wrap">
                <div class="conn-v"></div>
                @include('management._level', ['nodes' => $allChildren])
            </div>
        @endif

    </div>{{-- /org-node --}}

@endforeach
