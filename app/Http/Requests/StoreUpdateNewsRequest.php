<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateNewsRequest extends FormRequest
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
        $id = $this->segment(2);

        return [
            'title' => "required|min:3|max:255|unique:news,title,{$id},id",
            'image' => 'nullable|image',
            'description' => "required|min:3|max:1000/",
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Título da notícia é obrigatório!',
            'title.min' => 'Título da notícia deve conter no mínimo 3 caracteres!',
            'title.max' => 'Título da notícia deve conter no máximo 1000 caracteres!',
            'title.unique' => 'Já existe uma notícia com esse título!',
            'description.required' => 'Descrição da notícia é obrigatório!',
            'description.min' => 'Descrição da notícia deve conter no mínimo 3 caracteres!',
            'description.max' => 'Descrição da notícia deve conter no máximo 255 caracteres!',
        ];
    }
}
