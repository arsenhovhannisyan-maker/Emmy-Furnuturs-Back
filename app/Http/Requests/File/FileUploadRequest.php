<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $configKey = $this->input('config_key');
        $config = is_string($configKey) ? config("files.$configKey") : null;
        $isCropped = is_array($config) && ($config['is_cropped'] ?? false);

        if ($isCropped) {
            return [
                'file' => 'required|string|max:200000',
                'name' => 'required|string_with_max',
                'config_key' => 'required|string_with_max',
            ];
        }

        $fileValidation = (is_array($config) && isset($config['validation']))
            ? $config['validation']
            : 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000';

        return [
            'file' => $fileValidation,
            'config_key' => 'required|string_with_max',
        ];
    }
}
