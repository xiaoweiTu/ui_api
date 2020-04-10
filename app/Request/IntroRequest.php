<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class IntroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [];
        $uri   = $this->path();
        switch ($uri) {
            case 'self_intro/upload':
                $rules = [
                    'file' => 'required',
                ];
                break;
            case 'self_intro/editPassWord':
                $rules = [
                    'id'       => 'required',
                    'password' => 'required',
                ];
                break;
            case 'self_intro/homeLook':
                $rules = [
                    'password' => 'required',
                ];
                break;
        }
        return $rules;
    }

    public function attributes(): array
    {
        return [
            'file'     => '文件',
            'password' => '密码'
        ];
    }
}
