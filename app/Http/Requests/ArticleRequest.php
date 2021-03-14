<?php

namespace Corp\Http\Requests;

use Corp\Http\Requests\Request;

class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
        return \Auth::user()->canDo('ADD_ARTICLES');
    }

//    Переопределим метод родительского класса FormRequest класса Request
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance(); //Вызовим метод getValidatorInstance, родительского класса, тем самым получим доступ к validator

        $validator->sometimes('alias', 'unique:articles|max:255', function ( $input ) {
            return !empty($input->alias); //Если не пусто в alias то вернем true
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            //
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required|integer'
        ];
    }
}