<?php

namespace Cirtool\Handmail\Livewire\Templates;

use Cirtool\Handmail\BlockType;
use Livewire\Component;
use Cirtool\Handmail\Handmail;
use Cirtool\Handmail\Models\Template;
use Illuminate\Support\Collection;

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
        $this->layout = ($this->layouts)->first()->name;
    }

    public function render()
    {
        return view('handmail::livewire.templates.create-template');
    }

    public function store()
    {
        $validated = $this->validate();
        $factory = app(Handmail::class)->getBlockFactory();

        $template = Template::make($validated);
        $template->structure = [
            'layout' => $factory->find($validated['layout'], BlockType::Layout)
                ->data(['model' => 'structure.layout']),
            'blocks' => []
        ];
        $template->save();

        return redirect()->route('handmail.edit-template', [
            'template' => $template
        ]);
    }

    public function getLayoutsProperty(): Collection
    {
        $factory = app(Handmail::class)->getBlockFactory();
        return $factory->all(BlockType::Layout);
    }
}
