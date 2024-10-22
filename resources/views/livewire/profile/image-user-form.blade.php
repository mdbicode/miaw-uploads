<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $image;
    public $uploadedImage;

    public function mount(): void
    {
        $this->uploadedImage = Auth::user()->image;
    }

    public function updateImageProfile(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'image' => ['nullable', 'image', 'max:1024'],
        ]);
        
        if ($validated) {
            if ($this->uploadedImage) {
                Storage::disk('public')->delete($this->uploadedImage);
            }
            $path = $this->image->store('profile-image', 'public');
            $user->update(['image' => $path]);
            $this->uploadedImage = $path; // Update gambar secara real-time
        }
    }
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
    <img src="{{ asset('storage/' . $uploadedImage) }}" alt="Profile Image" width="250px" height="250px">
    <form wire:submit.prevent="updateImageProfile" enctype="multipart/form-data">
        <div>
            <input type="file" wire:model="image" name="image" wire:target="image" wire:loading.attr="disabled" accept="image/*">
            @error('image') <span class="error">{{ $message }}</span> @enderror
            <button type="submit" wire:loading.attr="disabled">Save Image</button>
        </div>
    </form>
</section>
