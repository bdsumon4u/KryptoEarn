<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Setting extends Component
{
    public array $tabs = ['gateway'];
    public ?string $tab;

    public function mount($tab): void
    {
        $this->tab = $tab ?? data_get($this->tabs, 0);
    }

    public function render()
    {
        return view('livewire.admin.setting');
    }
}
