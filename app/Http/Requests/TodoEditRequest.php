<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'id.required' => 'ID is required',
            'title.required' => 'Title is required',
            'content.required' => 'Content is required'
        ];
    }
}
