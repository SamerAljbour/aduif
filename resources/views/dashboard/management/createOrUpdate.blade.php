@extends('adminLayouts.app')

@section('content')

@if (isset($management))
<form action="{{ route('managements.update', $management->id) }}"
      method="POST"
      enctype="multipart/form-data">
@method('PUT')
@else
<form action="{{ route('managements.store') }}"
      method="POST"
      enctype="multipart/form-data">
@endif

@csrf

<div class="card shadow-sm">
    <div class="card-body p-4">

        {{-- ROW 1: NAMES --}}
        <div class="row mb-4">

            <div class="col-md-6">
                <label class="form-label fw-semibold">Name (Arabic)</label>

                <input type="text"
                       name="name_ar"
                       class="form-control form-control-lg @error('name_ar') is-invalid @enderror"
                       value="{{ old('name_ar', $ar->name ?? '') }}">

                @error('name_ar')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Name (French)</label>

                <input type="text"
                       name="name_fr"
                       class="form-control form-control-lg @error('name_fr') is-invalid @enderror"
                       value="{{ old('name_fr', $fr->name ?? '') }}">

                @error('name_fr')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        {{-- ROW 2: BIO --}}
        <div class="row mb-4">

            <div class="col-md-6">
                <label class="form-label fw-semibold">Bio (Arabic)</label>

                <textarea name="bio_ar"
                          class="form-control @error('bio_ar') is-invalid @enderror"
                          rows="3">{{ old('bio_ar', $ar->bio ?? '') }}</textarea>

                @error('bio_ar')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Bio (French)</label>

                <textarea name="bio_fr"
                          class="form-control @error('bio_fr') is-invalid @enderror"
                          rows="3">{{ old('bio_fr', $fr->bio ?? '') }}</textarea>

                @error('bio_fr')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        {{-- ROW 3: INFO --}}
        <div class="row mb-4">

            <div class="col-md-4">
                <label class="form-label fw-semibold">Email</label>

                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $management->email ?? '') }}">

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Position</label>

                <input type="text"
                       name="position"
                       class="form-control @error('position') is-invalid @enderror"
                       value="{{ old('position', $management->position ?? '') }}">

                @error('position')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Type</label>

                <select name="type"
                        class="form-control @error('type') is-invalid @enderror">

                    <option value="" {{ (isset($management) && $management->type=='')?'selected':'' }}>
                        Select Type
                    </option>
                    <option value="current" {{ (isset($management) && $management->type=='current')?'selected':'' }}>
                        Current
                    </option>

                    <option value="former" {{ (isset($management) && $management->type=='former')?'selected':'' }}>
                        Former
                    </option>

                    <option value="honorary" {{ (isset($management) && $management->type=='honorary')?'selected':'' }}>
                        Honorary
                    </option>

                </select>

                @error('type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        {{-- ROW 4: PHOTO + PREVIEW --}}
        <div class="row align-items-center mb-3">

            <div class="col-md-6">
                <label class="form-label fw-semibold">Photo</label>

                <input type="file"
                       name="photo"
                       class="form-control @error('photo') is-invalid @enderror"
                       onchange="previewImage(event)">

                @error('photo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 text-center">

                <label class="form-label fw-semibold d-block">Preview</label>

                <img id="preview"
                     src="{{ isset($management->photo)
                        ? asset('storage/'.$management->photo)
                        : 'https://via.placeholder.com/130' }}"
                     class="rounded shadow-sm"
                     style="max-height:130px; object-fit:cover;">

            </div>

        </div>

        {{-- BUTTON --}}
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary px-4">
                {{ isset($management) ? 'Update' : 'Save' }}
            </button>
        </div>

    </div>
</div>

</form>

{{-- IMAGE PREVIEW --}}
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection
