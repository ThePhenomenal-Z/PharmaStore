<?php

namespace App\Http\Requests;

use App\Models\Medcine;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreMedcineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "enSciName"=>['required'],
            "arSciName"=>['required'],
            "enUseName"=>['required','unique:medcines'],
            "arUseName"=>['required'],
            //"enCatigory"=>['required'],
            //"arCatigory"=>['required'],
            "companyName"=>['required'],
            "qtn"=>['required'],
            "expiredDate"=>['required'],
            "price"=> ['required'],
           "description"=> ['required'],
           "category_id"=>['required','exists:categories,id']
        ];
    }
    // protected function failedValidation(Validator $validator)
    // {
    //     $exception = $validator->getException();

    //     throw (new $exception($validator))
    //                 ->errorBag($this->errorBag)
    //                 ->redirectTo($this->getRedirectUrl());
    // }
}
