<?php

namespace Cirtool\Handmail\Livewire;

use Cirtool\Handmail\BlockType;
use Cirtool\Handmail\Handmail;
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
        $factory = app(Handmail::class)->getBlockFactory();

        $this->structure['layout'] = $factory->find($value, BlockType::Layout)
            ->data(['model' => 'layout'])->toArray();
    }

    public function appendBlock(string $name)
    {
        $factory = app(Handmail::class)->getBlockFactory();
        $block = $factory->find($name);

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
        $factory = app(Handmail::class)->getBlockFactory();
        return $factory->all();
    }

    public function modelValueDefined($key, $value): void
    {
        $publicProperties = array_keys($this->getPublicPropertiesDefinedBySubClass());
        
        if (in_array($this->beforeFirstDot($key), $publicProperties)) {
            data_set($this, $key, $value);
        }
    }

    public function getBlocksProperty(): array
    {
        $factory = app(Handmail::class)->getBlockFactory();
        $blocks = [];

        foreach ($this->structure['blocks'] as $key => $block) {
            $blocks[$key] =$factory->find($block['name'])->context($block);
        }

        return $blocks;
    }

    public function getLayoutsProperty(): Collection
    {
        $factory = app(Handmail::class)->getBlockFactory();
        return $factory->all(BlockType::Layout);
    }

    public function findLayout(string $name)
    {
        $factory = app(Handmail::class)->getBlockFactory();
        return $factory->find($name, BlockType::Layout);
    }
    
    protected function fireBlockEvent(string $event): void
    {
        $factory = app(Handmail::class)->getBlockFactory();

        $layout = $factory->find($this->structure['layout']['name'], BlockType::Layout)
            ->context($this->structure['layout']);

        if (method_exists($layout, $event)) {
            $this->structure['layout'] = $layout->{$event}();
        }

        foreach ($this->blocks as $key => $block) {
            if (method_exists($block, $event)) {
                $this->structure['blocks'][$key] = $block->{$event}();
            }
        }
    }
}
