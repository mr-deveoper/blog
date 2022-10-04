<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
        return [
            'title' => [ 'required', 'string', 'min:5', 'max:255' ],
            'description' => [ 'required', 'string', 'min:10' ],
            'publication_date' => [ 'required', 'date']
        ];
    }

    public function validated() {
        return array_merge($this->validator->validated(), [
            'user_id' => auth()->user()->id
        ]);
    }
}
