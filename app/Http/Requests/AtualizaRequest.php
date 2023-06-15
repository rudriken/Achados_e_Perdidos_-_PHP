<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtualizaRequest extends FormRequest
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
            "nome"                          => ["required", "min:3", "max:255"],
            "endereco"                      => ["required", "min:3", "max:255"],
            "contato"                       => ["required", "min:3", "max:255"],
            "descricao"                     => ["max:255"],
            "usuario.nome"                  => ["required", "min:3", "max:255"],
            "usuario.email"                 => [
                "required", "min:3", "max:255", "email",
            ],
            "usuario.password"              => ["confirmed"],
            "usuario.password_confirmation" => [],
        ];
    }
}
