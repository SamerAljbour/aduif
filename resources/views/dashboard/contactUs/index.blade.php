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
        <h1 class="mgmt-title">Contact Messages</h1>
    </div>

    <div class="mgmt-card">

        {{-- CARD HEADER --}}
        <div class="mgmt-card__header">
            <span class="mgmt-card__label">All Contacts</span>

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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>message</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody id="mgmtTableBody">

                @forelse($contacts as $c)

                    <tr class="mgmt-row">

                        <td>{{ $c->name }}</td>

                        <td class="mgmt-email">
                            {{ $c->email }}
                        </td>

                        <td>
                            {{ $c->subject ?: '—' }}
                        </td>
                        <td>
                            {{ $c->message ?: '—' }}
                        </td>

                        <td>
                            {{ $c->created_at->format('Y-m-d h:i A') }}
                        </td>

                        {{-- <td>
                            <button
                                class="btn-row btn-row--edit"
                                onclick="openContactModal(this)"
                                data-contact='@json($c, JSON_HEX_APOS | JSON_HEX_QUOT)'
                            >
                                👁 View
                            </button>
                        </td> --}}

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="mgmt-empty">
                            No contact messages found.
                        </td>
                    </tr>

                @endforelse

</tbody>
            </table>

        </div>
         @if($contacts->hasPages())
            <div class="mgmt-pagination">
                {{ $contacts->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>

@endsection
