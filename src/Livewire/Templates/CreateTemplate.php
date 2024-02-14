<?php

namespace Cirtool\Handmail\Livewire\Templates;

use Livewire\Component;
use Cirtool\Handmail\Facades\Handmail;
use Cirtool\Handmail\Models\Template;

class CreateTemplate extends Component
{
    public string $name = '';

    public string $layout;

    protected $rules = [
        'name' => 'required|min:3',
        'layout' => 'required'
    ];

    public function mount()
    {
        $this->layout = (Handmail::getLayouts()->first())->name;
    }

    public function render()
    {
        return view('handmail::livewire.templates.create-template');
    }

    public function store()
    {
        $validated = $this->validate();

        $template = Template::make($validated);
        $template->structure = [
            'layout' => Handmail::findLayout($validated['layout'])
                ->data(['model' => 'structure.layout']),
            'blocks' => []
        ];
        $template->save();

        return redirect()->route('handmail.edit-template', [
            'template' => $template
        ]);
    }
}
