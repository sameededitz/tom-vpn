<?php

namespace App\Livewire;

use App\Models\Plan;
use App\Models\PromoCode;
use Livewire\Component;

class CodeAdd extends Component
{
    public $plans;

    public $plan_id;

    public $quantity;

    public $expires_at;

    public function mount()
    {
        $this->plans = Plan::where('id', '!=', 1)->get();
    }

    protected function rules()
    {
        return [
            'plan_id' => 'required|exists:plans,id',
            'quantity' => 'required|integer',
            'expires_at' => 'required|integer'
        ];
    }

    public function submit()
    {
        $this->validate();
        for ($i = 0; $i < $this->quantity; $i++) {
            PromoCode::create([
                'code' => PromoCode::generateCode(),
                'plan_id' => $this->plan_id,
                'expires_at' => now()->addDays((int) $this->expires_at)
            ]);
        }

        return redirect()->route('all-promos')->with([
            'status' => 'success',
            'message' => 'Promo codes created successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.code-add');
    }
}
