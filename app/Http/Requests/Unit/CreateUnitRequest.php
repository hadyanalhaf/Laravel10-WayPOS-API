<?php

namespace App\Http\Requests\Unit;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CreateUnitRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3|string|unique:unit,name',
            'short_name' => 'required|string|max:3|unique:unit,short_name'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'error_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'data' => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
