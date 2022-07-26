<?php

namespace Aqamarine\AlphaNews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;

class PostCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        $model = Config::get('alphanews.models.post_category');
        $initializedModel = new $model();
        $table = $initializedModel->getTable();

        if ($this->isMethod('post')) {
            $validationRules = [
                'color' => 'required|string|max:255',
                'parent_category_id' => 'nullable|exists:'.$table.',id',
                'name' =>  ['required', 'string', 'max:255', 'unique:'.$table],
            ];
        } else {
            $validationRules = [
                'color' => 'string|max:255',
                'name' => 'string|max:255',
            ];
        }

        return $validationRules;
    }
}