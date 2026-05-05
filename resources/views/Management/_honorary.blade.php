{{--
    management/_honorary.blade.php
    ────────────────────────────────
    Tab 3 — Honorary members & Consultants.
    Receives: $honoraryMembers  (Collection of Management models, type IN ['honorary','consultant'])

    Each card shows:
      • Profile photo (circular)
      • Full name
      • Position / type badge  (no date range)
      • Bio snippet (3 lines, clamped)

    Clicking a card opens the shared modal (openMgmtModal).
--}}

@php
    $locale = app()->getLocale();
@endphp

@if($honoraryMembers->isEmpty())
    <p style="text-align:center;color:var(--text-muted);padding:60px 0;font-size:1rem;">
        {{ __('management.no_honorary') }}
    </p>
@else

    {{-- ── Optional: split into sub-sections (consultants first, then honorary) ── --}}
    @php
        $consultants = $honoraryMembers->where('type', 'consultant');
        $honorary    = $honoraryMembers->where('type', 'honorary');
    @endphp

    {{-- Consultants sub-section --}}
    @if($consultants->isNotEmpty())
        <h3 style="text-align:center;font-size:1.25rem;font-weight:800;color:var(--text-dark);
                   margin:0 0 28px;letter-spacing:-.3px;">
            <span style="border-bottom:2px solid var(--blue);padding-bottom:4px;">
                {{ __('management.consultants') }}
            </span>
        </h3>

        <div class="members-grid" style="margin-bottom:52px;">
            @foreach($consultants as $member)
                @include('management._honorary_card', [
                    'member'    => $member,
                    'locale'    => $locale,
                    'cardTheme' => 'blue',
                ])
            @endforeach
        </div>
    @endif

    {{-- Honorary sub-section --}}
    @if($honorary->isNotEmpty())
        <h3 style="text-align:center;font-size:1.25rem;font-weight:800;color:var(--text-dark);
                   margin:0 0 28px;letter-spacing:-.3px;">
            <span style="border-bottom:2px solid var(--gold);padding-bottom:4px;">
                {{ __('management.honorary') }}
            </span>
        </h3>

        <div class="members-grid">
            @foreach($honorary as $member)
                @include('management._honorary_card', [
                    'member'    => $member,
                    'locale'    => $locale,
                    'cardTheme' => 'gold',
                ])
            @endforeach
        </div>
    @endif

@endif
