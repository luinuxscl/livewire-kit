<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Option;

class BrandingLogoUploader extends Component
{
    use WithFileUploads;

    public bool $dark = false;
    public string $disk = 'public';
    public string $folder = 'branding/img';
    public ?\Illuminate\Http\UploadedFile $file = null;
    public ?string $currentPath = null;
    public string $optionKey = '';

    public function mount(bool $dark = false)
    {
        $this->dark = $dark;
        $this->optionKey = 'site_logo_' . ($this->dark ? 'dark' : 'light');
        $option = Option::firstOrCreate(['key' => $this->optionKey]);
        $this->currentPath = $option->value;
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'image|dimensions:ratio=1/1,max_width=1000,max_height=1000',
        ]);

        if ($this->currentPath && Storage::disk($this->disk)->exists($this->currentPath)) {
            Storage::disk($this->disk)->delete($this->currentPath);
        }

        $extension = $this->file->getClientOriginalExtension();
        $filenameToStore = $this->optionKey . '.' . $extension;
        $path = $this->file->storeAs($this->folder, $filenameToStore, $this->disk);

        Option::setValue(
            $this->optionKey,
            $path,
            'string',
            $this->folder,
            true,
            auth()->id() ?? null
        );

        $this->currentPath = $path;
        $this->file = null;

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => __('Logo subido correctamente'),
        ]);
    }

    public function render()
    {
        return view('livewire.branding-logo-uploader');
    }
}
