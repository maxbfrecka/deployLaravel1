<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            //this should ensure that the email has been typed and formatted
            'email'=>'required|email',
            'name'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
        ];

        // return [
        //     //this should ensure that the email has been typed and formatted
        //     'email'=>'required|email',
        //     'name'=>'required',
        //     'address_line1'=>'required',
        //     'address_city'=>'required',
        //     'address_state'=>'required',
        //     'address_zip'=>'required',
        // ];
    }
}
