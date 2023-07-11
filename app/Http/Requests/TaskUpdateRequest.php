<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Task;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update', Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:tasks,name,' . $this->route('task')->id,
            'description' => 'nullable',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable',
            'labels' => 'nullable|array'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        if (!isset($this->route('task')->id)) {
            return [];
        }
        return [
            'name.required' => __('Это обязательное поле'),
            'name.unique' => __('Задача с таким именем уже существует'),
            'status_id.required' => __('Это обязательное поле')
        ];
    }
}
