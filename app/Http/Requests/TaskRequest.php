<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('store-or-update-task');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|unique:tasks',
                    'description' => 'nullable',
                    'status_id' => 'required',
                    'assigned_to_id' => 'nullable',
                    'labels' => 'nullable|array'
                ];
            case 'PUT':
            case 'PATCH':
                if (!isset($this->route('task')->id)) {
                    return [];
                }
                return [
                    'name' => 'required|unique:tasks,name,' . $this->route('task')->id,
                    'description' => 'nullable',
                    'status_id' => 'required',
                    'assigned_to_id' => 'nullable',
                    'labels' => 'nullable|array'
                ];
            default:
                return [];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Это обязательное поле',
            'name.unique' => 'Задача с таким именем уже существует',
            'status_id.required' => 'Это обязательное поле'
        ];
    }
}
