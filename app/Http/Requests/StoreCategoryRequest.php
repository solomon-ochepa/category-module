<?php

namespace Modules\Category\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category.parent_id'    => ['nullable', 'uuid'],
            'category.name'         => ['required', 'string', 'min:3', 'max:32'],
            'category.description'  => ['nullable', 'string', 'max:2048'],
            'category.icon'         => ['nullable', 'string', 'starts_with:fa'],
            'image'                 => ['nullable', 'image', 'mimes:png,jpg,svg']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return true;
        return $this->user()->can('category.create');
    }
}
