<?php

namespace Cirtool\Handmail\Livewire;

use Cirtool\Handmail\Facades\Handmail;
use Cirtool\Handmail\Form\BlockField;
use Illuminate\Support\Collection;
use Livewire\Component;

abstract class EmailEditor extends Component
{
    public array $structure = [];

    public string $selectedLayout;

    protected $listeners = ['modelValueDefined'];

    public function storeOnSession(): void
    {
        session([$this->getSessionKey() => $this->structure]);
    }

    public function getSessionKey(): string
    {
        return 'email-' . $this->template->uuid . '-' . $this->id;
    }

    public function updatingSelectedLayout($value, $key)
    {
        $this->structure['layout'] = Handmail::findLayout($value)
            ->data(['model' => 'layout'])->toArray();
    }

    public function appendBlock(string $name)
    {
        $block = Handmail::findBlock($name);

        $this->structure['blocks'][] = $block->data([
            'model' => 'structure.blocks.' . count($this->structure['blocks'])
        ])->toArray();
    }

    public function removeBlock(string $id)
    {
        $index = collect($this->structure['blocks'])
            ->search(fn ($block) => $block['id'] == $id);

        unset($this->structure['blocks'][$index]);
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

        foreach ($this->structure['blocks'] as $key => $block) {
            $blocks[$key] = Handmail::findBlock($block['name'])->context($block);
        }

        return $blocks;
    }
    
    protected function fireBlockEvent(string $event): void
    {
        $layout = Handmail::findLayout($this->structure['layout']['name'])
            ->context($this->structure['layout']);

        if (method_exists($layout, $event)) {
            $this->structure['layout'] = $layout->{$event}();
        }

        foreach ($this->getBlocks() as $key => $block) {
            if (method_exists($block, $event)) {
                $this->structure['blocks'][$key] = $block->{$event}();
            }
        }
    }
}
