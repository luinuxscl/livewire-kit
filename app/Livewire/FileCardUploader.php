<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileCardUploader extends Component
{
    use WithFileUploads;

    public string $title;
    public string $folder;
    public string $accept;
    public ?\Illuminate\Http\UploadedFile $file = null;
    public ?string $currentPath = null;
    public ?string $modelClass = null;
    public $modelId = null;
    public ?string $dbColumn = null;
    public ?string $filename = null;
    public string $disk = 'public';

    public function mount(string $title = 'Archivo', string $folder = 'uploads', string $accept = '*/*', string $disk = 'public', ?string $currentPath = null, ?string $modelClass = null, $modelId = null, ?string $dbColumn = null, ?string $filename = null)
    {
        $this->title = $title;
        $this->folder = $folder;
        $this->accept = $accept;
        $this->disk = $disk;
        $this->currentPath = $currentPath;
        $this->modelClass = $modelClass;
        $this->modelId = $modelId;
        $this->dbColumn = $dbColumn;
        $this->filename = $filename;
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'file|max:5120', // Máximo 5MB
        ]);

        if ($this->currentPath && Storage::disk($this->disk)->exists($this->currentPath)) {
            Storage::disk($this->disk)->delete($this->currentPath);
        }

        $extension = $this->file->getClientOriginalExtension();
        if ($this->filename) {
            $filenameToStore = Str::contains($this->filename, '.')
                ? $this->filename
                : $this->filename . '.' . $extension;
        } else {
            $filenameToStore = uniqid() . '_' . $this->file->getClientOriginalName();
        }
        $path = $this->file->storeAs($this->folder, $filenameToStore, $this->disk);

        $this->currentPath = $path;
        $this->dispatch('fileUploaded', $path);

        // Guardar en BD si se especificaron modelo, id y columna
        if ($this->modelClass && $this->modelId && $this->dbColumn) {
            $model = ($this->modelClass)::find($this->modelId);
            if ($model) {
                $model->{$this->dbColumn} = $path;
                $model->save();
            }
        }

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => __('File uploaded successfully'),
        ]);

        $this->file = null;
    }

    public function render()
    {
        return view('livewire.file-card-uploader');
    }
}
