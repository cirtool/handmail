<?php

namespace Cirtool\Handmail\Livewire\Templates;

use Cirtool\Handmail\Livewire\EmailEditor;
use Cirtool\Handmail\Models\Template;

class EditTemplate extends EmailEditor
{
    public function mount(Template $template)
    {

    }

    public function render()
    {
        return view('handmail::livewire.templates.edit-template')
            ->layout('handmail::components.layouts.panel');
    }
}
