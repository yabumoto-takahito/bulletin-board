<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'image' => 'file|image'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必ず入力して下さい。',
            'content.required' => '本文は必ず入力して下さい。',
            'category_id.required' => 'カテゴリーは必ず選択して下さい。'
        ];
    }
}
