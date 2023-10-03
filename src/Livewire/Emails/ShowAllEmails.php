<?php

namespace Cirtool\Handmail\Livewire\Emails;

use Livewire\Component;

class ShowAllEmails extends Component
{
    public function render()
    {
        return view('handmail::livewire.emails.show-all-emails')
            ->layout('handmail::components.layouts.panel');
    }
}
