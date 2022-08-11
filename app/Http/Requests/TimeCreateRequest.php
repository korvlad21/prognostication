<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeCreateRequest extends FormRequest
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

        ];
    }
	 public function messages()
    {
        return [
            'name.required' => 'Необходимо указать название',
            'y1.numeric' => 'Не указано значение 2019-го года 1-го квартала',
            'y2.numeric' => 'Не указано значение 2019-го года 2-го квартала',
			'y3.numeric' => 'Не указано значение 2019-го года 3-го квартала',
			'y4.numeric' => 'Не указано значение 2019-го года 4-го квартала',
			'y5.numeric' => 'Не указано значение 2020-го года 1-го квартала',
            'y6.numeric' => 'Не указано значение 2020-го года 2-го квартала',
			'y7.numeric' => 'Не указано значение 2020-го года 3-го квартала',
			'y8.numeric' => 'Не указано значение 2020-го года 4-го квартала',
			'y9.numeric' => 'Не указано значение 2021-го года 1-го квартала',
            'y10.numeric' => 'Не указано значение 2021-го года 2-го квартала',
			'y11.numeric' => 'Не указано значение 2021-го года 3-го квартала',
			'y12.numeric' => 'Не указано значение 2021-го года 4-го квартала',

        ];
    }
}
