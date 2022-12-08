<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\File as CustomFile;
use Illuminate\Validation\Rules\File;


class StoreFileRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'type' => [
                'required',
                Rule::in([CustomFile::FILE_TYPE_1, CustomFile::FILE_TYPE_2, CustomFile::FILE_TYPE_3]),
            ],
            'file' => [
                'required',
                File::types(['jpg', 'png', 'pdf','docx'])
                    ->max(5 * 1024),
            ],
        ]; 
    }
}
