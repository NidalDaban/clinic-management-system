@php
    $user = Auth::user();
    $defaultMale = 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';
    $defaultFemale = 'https://cdn-icons-png.flaticon.com/512/3135/3135789.png';
    $defaultImage = $user->gender === 'female' ? $defaultFemale : $defaultMale;
@endphp

@auth
    <div class="card-body media align-items-center">

        <img id="profileImagePreview" src="{{ $user->image_path ? asset('storage/' . $user->image_path) : $defaultImage }}"
            alt="Profile Image" class="d-block ui-w-80 rounded-circle" style="width: 80px; height: 80px; object-fit: cover;"
            data-default="{{ $defaultImage }}">

        <div class="media-body ml-4">

            <div class="d-flex align-items-center mb-2">
                <label class="btn btn-outline-primary mb-0">
                    Upload New Photo
                    <input type="file" class="account-settings-fileinput" name="image" hidden>
                </label>

                @if ($user->image_path)
                    <button type="button" class="btn btn-outline-danger ml-2 mb-0" id="removeImageBtn">
                        Remove Photo
                    </button>
                @endif
            </div>

            <input type="hidden" name="remove_image" id="removeImageInput" value="0">
            <div class="text-light small">Allowed JPG, PNG. Max size 2MB</div>
        </div>
    </div>

    <hr class="border-light m-0">
@endauth
