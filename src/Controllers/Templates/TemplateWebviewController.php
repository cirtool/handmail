<?php

namespace Cirtool\Handmail\Controllers\Templates;

use Cirtool\Handmail\Controllers\Controller;
use Cirtool\Handmail\Models\Template;

class TemplateWebviewController extends Controller
{
    public function __invoke(Template $template)
    {
        return $template->webview();
    }
}
