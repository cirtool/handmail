<?php

namespace Cirtool\Handmail\Livewire\Templates;

use Livewire\Component;
use Cirtool\Handmail\Models\Template;

class CreateTemplate extends Component
{
    public string $name = '';

    protected $rules = [
        'name' => 'required|min:3',
    ];

    public function render()
    {
        return view('handmail::livewire.templates.create-template');
    }

    public function store()
    {
        $validated = $this->validate();
        
        $template = Template::create($validated);

        return redirect()->route('handmail.edit-template', [
            'template' => $template
        ]);
    }
}
