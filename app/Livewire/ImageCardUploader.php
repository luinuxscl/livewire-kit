<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Option;

class ImageCardUploader extends Component
{
    use WithFileUploads;

    public string $table;
    public string $field;
    public string $folder;
    public ?\Illuminate\Http\UploadedFile $file = null;
    public ?string $currentValue = null;

    public function mount(string $table, string $field, string $folder)
    {
        $this->table = $table;
        $this->field = $field;
        $this->folder = $folder;
        $this->currentValue = Option::getValue($this->field);
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'image|max:2048',
        ]);

        if ($this->currentValue && Storage::disk('public')->exists($this->currentValue)) {
            Storage::disk('public')->delete($this->currentValue);
        }

        $filename = uniqid() . '_' . $this->file->getClientOriginalName();
        $path = $this->file->storeAs($this->folder, $filename, 'public');

        Option::setValue(
            $this->field,
            $path,
            'string',
            $this->folder,
            true,
            auth()->id() ?? null
        );

        $this->currentValue = $path;
        $this->file = null;

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => __('Imagen subida correctamente'),
        ]);
    }

    public function render()
    {
        return view('livewire.image-card-uploader');
    }
}
