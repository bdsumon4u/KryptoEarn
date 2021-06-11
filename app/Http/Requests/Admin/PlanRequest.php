<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class PlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'payout_days' => $this->get('payout_days', 'Mon, Fri.'),
            'instant_payouts' => $this->has('instant_payouts'),
            'is_active' => $this->has('is_active'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:20', $this->unique()],
            'price' => ['required', 'integer', $this->unique()],
            'validity' => ['required', 'integer'],
            'task_limit' => ['required', 'integer'],
            'earning_per_task' => ['required', 'integer'],
            'ref_commission_on_each_task' => ['required', 'integer'],
            'ref_commission_on_plan_upgrade' => ['required', 'integer'],
            'maximum_referrals' => ['required', 'integer'],
            'instant_payouts' => ['sometimes', 'boolean'],
            'minimum_withdraw' => ['required', 'integer'],
            'payout_days' => ['required', 'string', 'max:255'],
            'required_referrals_to_withdraw' => ['required', 'integer'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    private function unique()
    {
        if ($plan = $this->route('plan')) {
            return 'unique:plans,id,' . $plan->id;
        }

        return 'unique:plans';
    }

    public function validData()
    {
        return Arr::only($this->validated(), array_keys($this->rules()));
    }
}
