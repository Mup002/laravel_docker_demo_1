<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStorePostRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules() : array
    {
        return [
            '*.customer_id' => ['required'],
            '*.title' => ['required'],
            '*.content' => ['required']
        ];
    }

    protected function prepareForValidation()
    {
        $data=[];
        $this->merge($data);
    }
}
