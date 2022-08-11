<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PairCreateRequest extends FormRequest
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
            'user_id'=>'max:200',
            'name'=>'required',
            'kolvo'=>'max:200000',
            'x1'=>'numeric',
            'x2'=>'numeric',
            'x3'=>'numeric',
            'x4'=>'numeric',
            'x5'=>'numeric',
            'x6'=>'numeric',
            'x7'=>'numeric',
            'x8'=>'numeric',
            'x9'=>'numeric',
            'x10'=>'numeric',
            'x11'=>'numeric',
            'x12'=>'numeric',
            'x13'=>'numeric',
            'x14'=>'numeric',
            'x15'=>'numeric',
            'x16'=>'numeric',
            'x17'=>'numeric',
            'x18'=>'numeric',
            'x19'=>'numeric',
            'x20'=>'numeric',
            'y1'=>'numeric',
            'y2'=>'numeric',
            'y3'=>'numeric',
            'y4'=>'numeric',
            'y5'=>'numeric',
            'y6'=>'numeric',
            'y7'=>'numeric',
            'y8'=>'numeric',
            'y9'=>'numeric',
            'y10'=>'numeric',
            'y11'=>'numeric',
            'y12'=>'numeric',
            'y13'=>'numeric',
            'y14'=>'numeric',
            'y15'=>'numeric',
            'y16'=>'numeric',
            'y17'=>'numeric',
            'y18'=>'numeric',
            'y19'=>'numeric',
            'y20'=>'numeric',
        ];
    }
}
