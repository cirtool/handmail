<?php

namespace Cirtool\Handmail\Form;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\TemporaryUploadedFile;

class FileField extends Field
{
    public string $label;

    public function data(array $input): Collection
    {
        return parent::data($input)->merge(['value' => '']);
    }

    public function saving(): void
    {
        if (
            $this->context['value'] && 
            TemporaryUploadedFile::canUnserialize($this->context['value'])
        ) {
            $temporaryFile = 
                TemporaryUploadedFile::unserializeFromLivewireRequest($this->context['value']);
            
            $this->context['value'] = $temporaryFile->store(
                config('handmail.file_uploader.directory'), 
                config('handmail.file_uploader.disk')
            );
        }
    }

    public function getRenderData()
    {
        if (
            $this->context['value'] && 
            TemporaryUploadedFile::canUnserialize($this->context['value'])
        ) {
            return TemporaryUploadedFile::unserializeFromLivewireRequest($this->context['value'])
                ->temporaryUrl();
        } elseif ($this->context['value']) {
            return Storage::disk(config('handmail.file_uploader.disk'))
                ->url($this->context['value']);
        }

        return null;
    }

    public function getSize()
    {
        return Storage::disk(config('handmail.file_uploader.disk'))
            ->size($this->context['value']);
    }

    public function getMimeType()
    {
        return Storage::disk(config('handmail.file_uploader.disk'))
            ->mimeType($this->context['value']);
    }

    protected function view(): string
    {
        return 'handmail::form.file-field';
    }

    protected function properties(): Collection
    {
        return parent::properties()->merge(['label']);
    }
}
