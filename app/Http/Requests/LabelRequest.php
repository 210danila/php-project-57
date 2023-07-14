<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Label;

class LabelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Label::class) && Gate::allows('update', Label::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:labels',
            'description' => 'nullable'
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
            'name.unique' => __('Метка с таким именем уже существует'),
            'name.max' => __('Длина имени метки не должна превышать 255 символов'),
        ];
    }
}
