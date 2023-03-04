<x-layout>
    <div class="container container--nerrow py-md-5">
        <h2 class="text-center mb-3">Upload a new avatar</h2>
        <form action="/manage-avatar" method="POST" enctype="multipart/form-data">
            @csrf
            <dir class="mb-3">
                <input type="file" name="avatar" >
                @error('avatar')
                    <p class="alert small alert-danger shadow-sm">{{ $message }}</p>
                @enderror
            </dir>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</x-layout>
