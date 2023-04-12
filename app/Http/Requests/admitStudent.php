<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class admitStudent extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(
        response()->json([
            'status'=>false,
            'errors'=>$validator->errors()
        ],200)
       );
    }
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'    =>  ['required'],
            'mail'    =>  ['required','email'],
            'phone'   =>  ['required'],
            'roll'    =>  ['required'],
            'reg'     =>  ['required'],
            'board'   =>  ['required'],
            'session' =>  ['required'],
            'avatar'  =>  ['required']
        ];

        if(request()->updateId != ''){
           $rules['avatar'][0]='nullable';
        }
        return $rules;
    }

    public function messages()
    {
        return[

        ];
    }
}
