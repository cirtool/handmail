<?php

namespace Cirtool\Handmail\Livewire\Templates;

use Livewire\Component;
use Livewire\WithPagination;
use Cirtool\Handmail\Models\Template;

class ShowAllTemplates extends Component
{
    use WithPagination;

    public function render()
    {
        return view('handmail::livewire.templates.show-all-templates', [
            'templates' => Template::paginate()
        ])->layout('handmail::components.layouts.panel');
    }
}
