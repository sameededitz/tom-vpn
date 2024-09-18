<?php

namespace App\Livewire;

use App\Models\Plan;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PlanAdd extends Component
{
    public $plan;

    #[Validate]
    public $name;

    #[Validate]
    public $bundle_id;

    #[Validate]
    public $description;

    #[Validate]
    public $price;

    #[Validate]
    public $duration;

    protected function rules()
    {
        return [
            'bundle_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|max:50',
            'price' => 'required',
            'duration' => 'required',
        ];
    }

    public function submit()
    {
        $this->validate();
        $plan = Plan::create([
            'bundle_id' => $this->bundle_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
        ]);

        return redirect()->route('all-plans')->with([
            'status' => 'success',
            'message' => 'Plan Added Successfully',
        ]);
    }
    public function render()
    {
        return view('livewire.plan-add');
    }
}
