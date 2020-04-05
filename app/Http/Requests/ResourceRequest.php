<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function isRequested()
    {
        return $this->route('resource');
    }

    public function resource()
    {
        $resource = $this->route('resource');
        $model = "\\App\\Models\\" . Str::studly(Str::singular($resource));
        return $model;
    }

    public function model()
    {
        $resource = $this->resource();

        return new $resource;
    }
}
