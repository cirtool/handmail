<?php

namespace Cirtool\Handmail\Traits;

use Cirtool\Handmail\Handmail;
use Illuminate\Support\Str;
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

        $layoutData = $handmail->findLayout($structure['layout']['name'])
            ->context($structure['layout'])->getRenderData();

        $layoutData['content'] = '';

        foreach ($structure['blocks'] as $block) {
            $layoutData['content'] .= 
                $handmail->findBlock($block['name'])->context($block)->render();
        }

        return $twig->render($structure['layout']['name'], $layoutData);
    }
}
