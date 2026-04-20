@extends('adminLayouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        {{ session('error') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Management</h1>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">All Managers</h5>

            <a href="{{ route('managements.create') }}"
   class="btn btn-primary btn-sm rounded-pill px-3 action-btn">
    <i class="bi bi-plus-lg"></i> Add a Manager
</a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name (AR)</th>
                        <th>Name (FR)</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($managements as $m)
                        <tr>
                            <td>
                                @if($m->photo)
                                    <img src="{{ asset('storage/'.$m->photo) }}"
                                         width="50"
                                         class="rounded">
                                @endif
                            </td>

                            <td>{{ optional($m->translation('ar')->first())->name }}</td>
                            <td>{{ optional($m->translation('fr')->first())->name }}</td>
                            <td>{{ $m->email }}</td>
                            <td>{{ $m->position }}</td>
                            <td>{{ ucfirst($m->type) }}</td>

                            <td>
                               <a href="{{ route('managements.edit', $m->id) }}"
                                    class="btn btn-info btn-sm rounded-pill px-3 text-white action-btn">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                <form action="{{ route('managements.destroy', $m->id) }}"
                                    method="POST"
                                    style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button class=" btn btn-danger btn-sm rounded-pill px-3 action-btn"
                                            onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
<script>
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(alert => {
        alert.classList.remove('show');
        alert.classList.add('hide');
    });
}, 4000);
</script>
