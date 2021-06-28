<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddFund extends Component
{
    public User $user;

    public string $amount = '';

    public array $wallets = ['bonus', 'commission', 'purchased', 'earning'];

    public string $destination = 'bonus';

    public string $name = '';

    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'destination' => ['required', Rule::in($this->wallets)],
            'name' => 'required|max:100',
        ];
    }

    public function render()
    {
        return view('livewire.admin.add-fund');
    }

    public function submit()
    {
        $this->validate();
        $this->user->getWallet($this->destination)->depositFloat($this->amount, [
            'name' => $this->name,
        ]);

//        $this->dispatchBrowserEvent('alert', [
//            'type' => 'success',
//            'message' => 'Fund Added.',
//        ]);

//        $this->reset('amount', 'name');
        session()->flash('success', 'Fund Added.');
        $this->redirect(back()->getTargetUrl());
    }
}
