<?php

namespace Cirtool\Handmail\Traits;

use Cirtool\Handmail\BlockType;
use Cirtool\Handmail\Handmail;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait HasWebview
{
    public function webview(?array $structure = null)
    {
        if ($structure === null) {
            $structure = $this->structure;
        }
        
        $handmail = app(Handmail::class);
        $twig = $handmail->getTwig();
        $factory = $handmail->getBlockFactory();

        $layoutData = $factory->find($structure['layout']['name'], BlockType::Layout)
            ->context($structure['layout'])->getRenderData();

        $layoutData['content'] = '';

        foreach ($structure['blocks'] as $block) {
            $layoutData['content'] .= 
                $factory->find($block['name'])->context($block)->render();
        }

        return $twig->render($structure['layout']['name'], $layoutData);
    }
}
