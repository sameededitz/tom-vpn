<?php

namespace App\Livewire;

use App\Models\Plan;
use App\Models\PromoCode;
use App\Models\User;
use Livewire\Component;

class DashboardStats extends Component
{
    public $userCount;
    public $planCount;
    public $promoCodeCount;

    public function mount()
    {
        $this->userCount = User::count();
        $this->planCount = Plan::count();
        $this->promoCodeCount = PromoCode::count();
    }
    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
