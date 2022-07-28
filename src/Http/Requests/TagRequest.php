<?php

namespace Aqamarine\AlphaNews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        $model = Config::get('alphanews.models.tag');
        $table = (new $model)->getTable();
        return ['name' => 'required|string|max:255|unique:'.$table];
    }

}
