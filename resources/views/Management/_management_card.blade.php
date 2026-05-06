@php
    $locale = app()->getLocale();
    $translation = $member->translations->firstWhere('locale', $locale)
        ?? $member->translations->firstWhere('locale', 'ar')
        ?? $member->translations->first();

    $name = $translation?->name ?? __('management.unknown_member');
    $bio = $translation?->bio ?? '';
    $position = \App\Models\Management::positionLabel($member->position);
    $photo = $member->photo ? asset('storage/' . $member->photo) : null;
    $email = $member->email;
    $phone = $member->phone ?? null;
    $from = $member->date_from ? \Carbon\Carbon::parse($member->date_from)->format('Y') : null;
    $to = $member->date_to ? \Carbon\Carbon::parse($member->date_to)->format('Y') : null;
    $badge = $badge ?? $position;
@endphp

<article class="mgmt-row-card">
    <div class="mgmt-row-card__media">
        @if($photo)
            <img src="{{ $photo }}" alt="{{ $name }}" class="mgmt-row-card__photo">
        @else
            <div class="mgmt-row-card__photo mgmt-row-card__photo--empty" aria-hidden="true">
                {{ mb_substr($name, 0, 1) }}
            </div>
        @endif
    </div>

    <div class="mgmt-row-card__content">
        <div class="mgmt-row-card__head">
            <div>
                <span class="mgmt-row-card__badge">{{ $badge }}</span>
                <h3 class="mgmt-row-card__name">{{ $name }}</h3>
            </div>
            <span class="mgmt-row-card__position">{{ $position }}</span>
        </div>

        @if($bio)
            <p class="mgmt-row-card__bio">{{ $bio }}</p>
        @endif

        <dl class="mgmt-row-card__details">
            @if($from || $to)
                <div>
                    <dt>{{ __('management.tenure') }}</dt>
                    <dd>{{ $from ?? '?' }} - {{ $to ?? __('management.present') }}</dd>
                </div>
            @endif

            @if($email)
                <div>
                    <dt>{{ __('management.email') }}</dt>
                    <dd><a href="mailto:{{ $email }}">{{ $email }}</a></dd>
                </div>
            @endif

            @if($phone)
                <div>
                    <dt>{{ __('management.phone') }}</dt>
                    <dd><a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></dd>
                </div>
            @endif
        </dl>
    </div>
</article>
