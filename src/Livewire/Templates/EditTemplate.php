<?php

namespace Cirtool\Handmail\Livewire\Templates;

use Cirtool\Handmail\Facades\Handmail;
use Cirtool\Handmail\Livewire\EmailEditor;
use Cirtool\Handmail\Models\Template;

class EditTemplate extends EmailEditor
{
    public Template $template;

    protected $rules = [
        'template.name' => 'required|min:3',
    ];

    public function mount(Template $template)
    {
        $this->template = $template;

        $this->layout = $template['structure']['layout'];
        $this->selectedLayout = $this->layout['name'];

        $this->blocks = $template['structure']['blocks'];
    }

    public function render()
    {
        return view('handmail::livewire.templates.edit-template')
            ->layout('handmail::components.layouts.panel');
    }

    public function save()
    {
        $this->fireBlockEvent('saving');

        $this->template->structure = [
            'layout' => $this->layout, 
            'blocks' => $this->blocks
        ];

        $this->template->save();

        $this->fireBlockEvent('saved');
    }

    public function download()
    {
        return response()->streamDownload(function () {
            echo $this->template->webview();
        }, "{$this->template->name} - Template.html");
    }
}
