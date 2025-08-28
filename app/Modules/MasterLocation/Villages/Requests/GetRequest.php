<?php

namespace App\Modules\MasterLocation\Villages\Requests;

use App\Base\Classes\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends BaseRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string'],
            'sort' => ['nullable', 'string'],
            'paginate' => ['nullable', 'numeric'],
        ];
    }
}
