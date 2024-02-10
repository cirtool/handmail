<?php

namespace Cirtool\Handmail\Controllers\Templates;

use Cirtool\Handmail\Controllers\Controller;
use Cirtool\Handmail\Facades\Handmail;
use Cirtool\Handmail\Models\Template;
use Illuminate\Http\Request;

class TemplateWebviewController extends Controller
{
    public function __invoke(Request $request, Template $template)
    {
        if ($request->query('preview')) {
            $preview = $request->session()->get($request->query('preview'));

            $layoutData = Handmail::findLayout($preview['layout']['name'])
                ->context($preview['layout'])->getRenderData();

            return view('handmail::webview', [
                'blocks' => $preview['blocks'], 
                'layoutName' => $preview['layout']['name'],
                'values' => $layoutData
            ]);
        }

        return $template->webview();
    }
}
