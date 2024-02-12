<?php

namespace Cirtool\Handmail\Controllers\Templates;

use Cirtool\Handmail\Controllers\Controller;
use Cirtool\Handmail\Handmail;
use Cirtool\Handmail\Models\Template;
use Illuminate\Http\Request;

class TemplateWebviewController extends Controller
{
    public function __construct(protected Handmail $handmail)
    {
        
    }

    public function __invoke(Request $request, Template $template)
    {
        if ($request->query('preview')) {
            $preview = $request->session()->get($request->query('preview'));
            return $template->webview($preview);
        }

        return $template->webview();
    }
}
