<?php

namespace Cirtool\Handmail\Livewire;

use Cirtool\Handmail\Facades\Handmail;
use Cirtool\Handmail\Form\BlockField;
use Illuminate\Support\Collection;
use Livewire\Component;

abstract class EmailEditor extends Component
{
    public array $layout = [];

    public string $selectedLayout;

    public array $blocks = [];

    protected $listeners = ['modelValueDefined'];

    public function storeOnSession(): void
    {
        session([$this->getSessionKey() => [
            'layout' => $this->layout,
            'blocks' => $this->blocks
        ]]);
    }

    public function getSessionKey(): string
    {
        return 'email-' . $this->template->uuid . '-' . $this->id;
    }

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

    public function modelValueDefined($key, $value): void
    {
        $publicProperties = array_keys($this->getPublicPropertiesDefinedBySubClass());
        
        if (in_array($this->beforeFirstDot($key), $publicProperties)) {
            data_set($this, $key, $value);
        }
    }

    public function getBlocks(): array
    {
        $blocks = [];

        foreach ($this->blocks as $key => $block) {
            $blocks[$key] = Handmail::findBlock($block['name'])->context($block);
        }

        return $blocks;
    }
    
    protected function fireBlockEvent(string $event): void
    {
        $layout = Handmail::findLayout($this->layout['name'])->context($this->layout);

        if (method_exists($layout, $event)) {
            $this->layout = $layout->{$event}();
        }

        foreach ($this->getBlocks() as $key => $block) {
            if (method_exists($block, $event)) {
                $this->blocks[$key] = $block->{$event}();
            }
        }
    }
}
