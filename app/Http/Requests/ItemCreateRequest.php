<?php 

namespace App\Http\Requests;


class ItemCreateRequest extends Request {
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'long_url' => 'Not valid URL!',
            'active_url' => 'Not valid URL!',            
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'long_url' => 'required|max:500|active_url',
        ];
    }

}