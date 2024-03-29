<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => ['required', 'string','min:5'],
            'project_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'file' => ['mimes:jpeg,png,jpg,xlsx,pdf,csv,docx,txt'],
        ];
    }
}
