<?php

namespace Aqamarine\AlphaNews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        return ['name' => 'required|string|max:255|unique:tags'];
    }

}
