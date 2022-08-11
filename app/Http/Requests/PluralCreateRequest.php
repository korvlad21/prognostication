<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PluralCreateRequest extends FormRequest
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
            'x1_1'=>'numeric',
            'x1_2'=>'numeric',
            'x1_3'=>'numeric',
            'x1_4'=>'numeric',
            'x1_5'=>'numeric',
            'x1_6'=>'numeric',
            'x1_7'=>'numeric',
            'x1_8'=>'numeric',
            'x1_9'=>'numeric',
            'x1_10'=>'numeric',
            'x1_11'=>'numeric',
            'x1_12'=>'numeric',
            'x1_13'=>'numeric',
            'x1_14'=>'numeric',
            'x1_15'=>'numeric',
            'x1_16'=>'numeric',
            'x1_17'=>'numeric',
            'x1_18'=>'numeric',
            'x1_19'=>'numeric',
            'x1_20'=>'numeric',
            'x2_1'=>'numeric',
            'x2_2'=>'numeric',
            'x2_3'=>'numeric',
            'x2_4'=>'numeric',
            'x2_5'=>'numeric',
            'x2_6'=>'numeric',
            'x2_7'=>'numeric',
            'x2_8'=>'numeric',
            'x2_9'=>'numeric',
            'x2_10'=>'numeric',
            'x2_11'=>'numeric',
            'x2_12'=>'numeric',
            'x2_13'=>'numeric',
            'x2_14'=>'numeric',
            'x2_15'=>'numeric',
            'x2_16'=>'numeric',
            'x2_17'=>'numeric',
            'x2_18'=>'numeric',
            'x2_19'=>'numeric',
            'x2_20'=>'numeric',
        ];
    }
}
