<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Objeto_Request extends FormRequest
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
        if ($this->getContentType() === "form") {
            return [
                "imagem_objeto" => ["required", "image"],
            ];
        }
        return [
            "nome"      => ["required", "min:3", "max:255"],
            "descricao" => ["required", "min:3", "max:255"],
        ];
    }
}
