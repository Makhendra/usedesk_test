<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ClientRequest extends FormRequest
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
            'name' => $this->getMethod() == 'POST' ? 'required'  : 'nullable',
            'last_name' => $this->getMethod() == 'POST' ? 'required'  : 'nullable',
        ];
    }

    protected function failedValidation($validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(
                ['success' => false, 'message' => $errors, 'data' => []],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
