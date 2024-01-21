<?php

namespace Cirtool\Handmail\Livewire;

use Cirtool\Handmail\Facades\Handmail;
use Illuminate\Support\Collection;
use Livewire\Component;

abstract class EmailEditor extends Component
{
    public array $layout = [];

    public string $selectedLayout;

    public array $blocks = [];

    public function updatingSelectedLayout($value, $key)
    {
        $this->layout = Handmail::findLayout($value)
            ->data(['model' => 'layout'])->toArray();
    }

    public function appendBlock(string $name)
    {
        $block = Handmail::findBlock($name);

        $this->blocks[] = $block->data([
            'model' => 'blocks.' . count($this->blocks)
        ])->toArray();
    }

    public function removeBlock(string $id)
    {
        $index = collect($this->blocks)
            ->search(fn ($block) => $block['id'] == $id);

        unset($this->blocks[$index]);
    }

    public function getAvailableBlocks(): Collection
    {
        return Handmail::getBlocks();
    }
}
