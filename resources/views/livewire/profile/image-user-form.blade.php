<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    // public $image;
    public $uploadedImage;

    public function mount(): void
    {
        $this->uploadedImage = Auth::user()->image;
        // dd($this->uploadedImage);
    }

    // public function updateImageProfile(): void
    // {
    //     $user = Auth::user();

    //     $validated = $this->validate([
    //         'image' => ['nullable', 'image', 'max:1024'],
    //     ]);
    //     dd($this);
        
    //     if ($validated) {
    //         if ($this->uploadedImage) {
    //             Storage::disk('s3')->delete($this->uploadedImage);
    //         }
    //         $path = $this->image->store('profile-image', 's3');
    //         $user->update(['image' => $path]);
    //           // Update gambar secara real-time
    //     }
    // }
}
?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Image Profile') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Upload your image") }}
        </p>
    </header>
    <img src="{{ $uploadedImage }}" alt="Profile Image" width="250px" height="250px">
    {{-- <form method="POST" action="{{ route('upload.file') }} enctype="multipart/form-data">
        <div>
            <input type="file" name="image" id="image" accept="image/*">
            @error('image') <span class="error">{{ $message }}</span> @enderror
            <button type="submit">Save Image</button>
        </div>
    </form> --}}
    <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
</section>