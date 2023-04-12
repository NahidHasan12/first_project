<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CurdRequest extends FormRequest
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
            'name'         =>  ['required'],
            'roll'         =>  ['required'],
            'reg'          =>  ['required'],
            'department'   =>  ['required'],
            'number'       =>  ['required'],
            'mail'         =>  ['required','email'],
            'img'          =>  ['required']
        ];

        if(request()->editId != ''){
           $rules['img'][0]='nullable';
        }
        return $rules;
    }

    public function messages()
    {
        return[

        ];
    }
}
