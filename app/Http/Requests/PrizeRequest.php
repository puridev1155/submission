<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrizeRequest extends FormRequest
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
            'vol' => 'required',
            'award' => 'required',
            'name' => 'required',
            'email' =>'required|unique:prizes',
            'phone' => 'required|unique:prizes',
            'counts' => 'nullable',
            'success' => 'nullable',
            'agree' => 'required',
        ];
    }

    public function messages()
{
    return [
        'vol.required' => '필드 vol은(는) 필수입니다.',
        'award.required' => '필드 award는 필수입니다.',
        'name.required' => '필드 name은(는) 필수입니다.',
        'email.required' => '필드 email은(는) 필수입니다.',
        'email.email' => '필드 email은(는) 유효한 이메일 주소여야 합니다.',
        'phone.required' => '필드 phone은(는) 필수입니다.',
        'agree.required' => '필드 agree는(은) 필수입니다.',
        'phone.unique' => '이미 사용 중인 전화번호입니다.',
        'email.unique' => '이미 사용 중인 이메일입니다.',
    ];
}
}
