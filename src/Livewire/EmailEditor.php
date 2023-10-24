<?php

namespace Cirtool\Handmail\Livewire;

use Cirtool\Handmail\Facades\Handmail;
use Illuminate\Support\Collection;
use Livewire\Component;

abstract class EmailEditor extends Component
{
    public array $blocks = [];

    public function appendBlock(string $name)
    {
        $block = Handmail::findBlock($name);
    }

    public function getBlocks(): Collection
    {
        return Handmail::getBlocks();
    }
}
