<?php

namespace Cirtool\Handmail\Livewire\Form;

use Cirtool\Handmail\Form\FileField;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class FileUploader extends Component
{
    use WithFileUploads;

    public array $context = [];

    public $file;

    public function mount(array $context)
    {
        $this->context = $context;
    }

    public function render()
    {
        /** @var FileField  */
        $block = (new FileField([]))->context($this->context);
        $data = $block->getRenderData();

        return view('handmail::livewire.form.file-uploader', [
            'fileUrl' => $data,
            'fileMimeType' => $data ? $block->getMimeType() : null,
            'fileSize' => $data ? $block->getSize() : null
        ]);
    }

    public function deleteFile()
    {
        $this->file = null;
        $this->fireModelValueDefined();
    }

    public function updatedFile()
    {
        $validator = Validator::make(
            ['file' => $this->file],
            ['file' => config('handmail.file_uploader.rule')]
        );
        
        if ($validator->fails()) {
            $this->dispatchBrowserEvent(
                'file-uploaded-has-errors-' . $this->id, 
                $validator->errors()->first()
            );
            return;
        }
        
        $this->fireModelValueDefined();
    }

    public function fireModelValueDefined()
    {
        $this->emitUp(
            'modelValueDefined', 
            $this->context['model'] . '.value', 
            $this->file ? $this->file->serializeForLivewireResponse() : null
        );
    }
}
