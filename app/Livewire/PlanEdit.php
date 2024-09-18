<?php

namespace App\Livewire;

use App\Models\Plan;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PlanEdit extends Component
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

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->bundle_id = $plan->bundle_id;
        $this->name = $plan->name;
        $this->description = $plan->description;
        $this->price = $plan->price;
        $this->duration = $plan->duration;
    }

    public function update()
    {
        $this->validate();
        $this->plan->update([
            'bundle_id' => $this->bundle_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
        ]);
        return redirect()->route('all-plans')->with([
            'status' => 'success',
            'message' => 'Plan Updated Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.plan-edit');
    }
}
