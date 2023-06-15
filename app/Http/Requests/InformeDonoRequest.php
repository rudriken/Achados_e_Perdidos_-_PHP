<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformeDonoRequest extends FormRequest
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
            "dono_nome" => ["required", "min:3", "max:255"],
            "dono_cpf" => ["required", "min:11", "max:11", "cpf"]
        ];
    }
}
