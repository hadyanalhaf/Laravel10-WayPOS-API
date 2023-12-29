<?php

namespace App\Http\Requests\Partner;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
class CreatePartnerRequest extends FormRequest
{
    public function rules(){
        return [
            'name' => 'required|max:20|regex:/^[A-Za-z\s]+$/',
            'photo' => 'nullable',
            'address' => 'required|max:30',
        ];
    }

    public function failedValidation (Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'error_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'data' => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
