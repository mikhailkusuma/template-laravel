<?php

namespace App\Base\Traits;

use App\Base\Classes\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

trait FailedValidation
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            JsonResponse::create($validator->errors())
                ->setCode("validation_error", Response::HTTP_BAD_REQUEST)
                ->setMeta("Validation Error", true)
                ->send()
        );
    }
}
