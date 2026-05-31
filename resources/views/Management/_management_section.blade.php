<section class="mgmt-section {{ !empty($active) ? 'is-active' : '' }}" id="{{ $id }}" role="tabpanel">
    <div class="mgmt-section__heading">
        <p>{{ __('management.section_label') }}</p>
        <h2>{{ $title }}</h2>
    </div>

    @if($members->isEmpty())
        <p class="mgmt-empty">{{ $empty }}</p>
    @else
        <div class="mgmt-section__list">
            @foreach($members as $member)
                @include('Management._management_card', [
                    'member' => $member,
                    'badge' => $badge ?? null,
                ])
            @endforeach
        </div>
    @endif
</section>
