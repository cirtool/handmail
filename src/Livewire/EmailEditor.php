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
        $this->blocks[] = $block->data([
            'model' => 'blocks.' . count($this->blocks)
        ]);
    }

    public function getAvailableBlocks(): Collection
    {
        return Handmail::getBlocks();
    }
}
