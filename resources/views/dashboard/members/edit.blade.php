@extends('adminLayouts.app')

@section('content')
@php
    $locales = [
        'en' => 'English',
        'ar' => 'Arabic',
        'fr' => 'French',
    ];

    $translationFields = [
        'name' => ['label' => 'Name', 'type' => 'text', 'required' => true],
        'specialization' => ['label' => 'Specialization', 'type' => 'text', 'required' => false],
        'degree' => ['label' => 'Degree', 'type' => 'text', 'required' => false],
        'graduation_university' => ['label' => 'Graduation University', 'type' => 'text', 'required' => false],
        'current_job' => ['label' => 'Current Job', 'type' => 'text', 'required' => false],
        'workplace' => ['label' => 'Workplace', 'type' => 'text', 'required' => false],
        'interests' => ['label' => 'Interests', 'type' => 'textarea', 'required' => false],
        'bio' => ['label' => 'Bio', 'type' => 'textarea', 'required' => false],
    ];
@endphp

@if (session('success'))
    <div class="alert-toast alert-toast--success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert-toast alert-toast--error">
        {{ session('error') }}
    </div>
@endif

<div class="mgmt-wrap">
    <div class="mgmt-header">
        <h1 class="mgmt-title">Edit Member</h1>
        <a href="{{ route('members.index') }}" class="btn-add">
            <span class="btn-add__icon">Back</span> Members
        </a>
    </div>

    <div class="mgmt-card">
        <form action="{{ route('members.update', $member) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mgmt-form__body">
                <div class="mgmt-card__header" style="margin: 0 0 16px; border-radius: 8px;">
                    <span class="mgmt-card__label">Member Data</span>
                </div>

                <div class="mgmt-form__row">
                    <div class="mgmt-form__group">
                        <label class="mgmt-form__label">Email</label>
                        <input type="email"
                               name="email"
                               class="mgmt-form__control @error('email') is-invalid @enderror"
                               value="{{ old('email', $member->email) }}">
                        @error('email')
                            <small class="mgmt-form__error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mgmt-form__group">
                        <label class="mgmt-form__label">Phone</label>
                        <input type="tel"
                               name="phone"
                               class="mgmt-form__control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $member->phone) }}">
                        @error('phone')
                            <small class="mgmt-form__error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mgmt-form__group">
                        <label class="mgmt-form__label">Status</label>
                        <select name="status" class="mgmt-form__control @error('status') is-invalid @enderror" required>
                            @foreach(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $status => $label)
                                <option value="{{ $status }}" {{ old('status', $member->status) === $status ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <small class="mgmt-form__error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mgmt-form__row">
                    <div class="mgmt-form__group">
                        <label class="mgmt-form__label">Photo</label>
                        <input type="file"
                               name="photo"
                               accept="image/*"
                               class="mgmt-form__control @error('photo') is-invalid @enderror"
                               onchange="previewMemberPhoto(event)">
                        @error('photo')
                            <small class="mgmt-form__error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mgmt-form__group mgmt-form__group--preview">
                        <label class="mgmt-form__label">Photo Preview</label>
                        <div class="mgmt-avatar-wrap">
                            <img id="memberPhotoPreview"
                                 src="{{ $member->photo ? asset('storage/'.$member->photo) : 'https://via.placeholder.com/130' }}"
                                 class="mgmt-avatar mgmt-avatar--preview"
                                 style="max-height:130px; object-fit:cover;">
                        </div>
                    </div>

                    <div class="mgmt-form__group">
                        <label class="mgmt-form__label">CV</label>
                        <input type="file"
                               name="cv"
                               accept=".pdf,.doc,.docx"
                               class="mgmt-form__control @error('cv') is-invalid @enderror">
                        @error('cv')
                            <small class="mgmt-form__error">{{ $message }}</small>
                        @enderror

                        @if($member->cv)
                            <a href="{{ asset('storage/'.$member->cv) }}" target="_blank" class="btn-row btn-row--edit" style="margin-top: 10px;">
                                Current CV
                            </a>
                        @endif
                    </div>
                </div>

                @foreach($locales as $locale => $label)
                    @php
                        $localeTranslation = $translationsByLocale->get($locale);
                    @endphp

                    <div class="mgmt-card__header" style="margin: 0 0 16px; border-radius: 8px;">
                        <span class="mgmt-card__label">{{ $label }} Profile</span>
                    </div>

                    <div class="mgmt-form__row">
                        @foreach($translationFields as $field => $config)
                            @php
                                $errorKey = "translations.$locale.$field";
                            @endphp

                            <div class="mgmt-form__group">
                                <label class="mgmt-form__label">
                                    {{ $config['label'] }} ({{ strtoupper($locale) }})
                                </label>

                                @if($config['type'] === 'textarea')
                                    <textarea name="translations[{{ $locale }}][{{ $field }}]"
                                              class="mgmt-form__control @error($errorKey) is-invalid @enderror"
                                              rows="3"
                                              {{ $config['required'] ? 'required' : '' }}>{{ old("translations.$locale.$field", $localeTranslation?->{$field} ?? '') }}</textarea>
                                @else
                                    <input type="text"
                                           name="translations[{{ $locale }}][{{ $field }}]"
                                           class="mgmt-form__control @error($errorKey) is-invalid @enderror"
                                           value="{{ old("translations.$locale.$field", $localeTranslation?->{$field} ?? '') }}"
                                           {{ $config['required'] ? 'required' : '' }}>
                                @endif

                                @error($errorKey)
                                    <small class="mgmt-form__error">{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="mgmt-form__actions">
                    <button type="submit" class="btn-add">Update Member</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewMemberPhoto(event) {
    if (!event.target.files.length) return;

    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('memberPhotoPreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

document.querySelectorAll('.alert-toast').forEach(function(el) {
    setTimeout(function() {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 400);
    }, 4000);
});
</script>

@endsection
