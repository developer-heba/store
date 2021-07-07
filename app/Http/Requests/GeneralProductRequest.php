<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ProductQty;

class GeneralProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'slug' => 'required|unique:products,slug',
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            'categories' => 'array|min:1', //[]
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'nullable',
           
            'document' => 'array|min:1',
            'document.*' => 'string',
            'price' => 'nullable|min:0|numeric',
            'special_price' => 'nullable|numeric',
            'sku' => 'nullable|min:3|max:10',
            'manage_stock' => 'required|in:0,1',
            'in_stock' => 'in:0,1',
            //'qty' => 'required_if:manage_stock,==,1',
            'qty'  =>[new ProductQty($this ->manage_stock )]

        ];
    }

}
