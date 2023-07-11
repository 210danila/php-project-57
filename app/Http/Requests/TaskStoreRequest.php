<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Task;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:tasks',
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
        return [
            'name.required' => __('Это обязательное поле'),
            'name.unique' => __('Задача с таким именем уже существует'),
            'name.max' => __('Длина задачи не должна превышать 255 символов'),
            'status_id.required' => __('Это обязательное поле'),
        ];
    }
}
