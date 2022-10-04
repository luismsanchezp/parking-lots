<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Validation\Rules\Enum;
use App\Enums\GovIdTypeEnum;

class UserStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string|min:3|max:25|alpha",
            "surname" => "required|string|min:3|max:25|alpha",
            "email" => "required|string|min:3|max:254|email:rfc,dns|unique:users,email",
            "password" => "required|string|min:8|max:15",
            "id_type" => ["required","string","min:4","max:4",new Enum(GovIdTypeEnum::class)],
            "gov_id" => "required|string|min:10|max:10|numeric|unique:users,gov_id",
            "phone_number" => "required|string|min:10|max:10|numeric|unique:users,phone_number"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
