<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'name' => 'required',
             'type' => 'required|in:1,2',
             'slug' => 'required|unique:categories,slug,'.$this -> id
        ];
    }
   
    public function messages()
    {
        return [
             'name.required_name' => __('admin/validation.required_name'),
             'type.required_type' => __('admin/validation.required_type'),
             'slug.required_sulg' => __('admin/validation.required_sulg'),
             'slug.unique' => __('admin/validation.unique'),
        ];
    }
}

