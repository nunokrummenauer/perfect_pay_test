<?php

namespace App\Http\Requests\Validations;

use Illuminate\Support\Facades\Validator;

class CustomRequestValidators
{
    public static function registerCustomValidators()
    {
        Validator::extend('ip_url', function ($attribute, $value, $parameters) {

            if (filter_var($value, FILTER_VALIDATE_IP)) {
                return true;
            } elseif (filter_var($value, FILTER_VALIDATE_URL)) {
                return true;
            } else {
                return false;
            }
        });

        Validator::extend('null', function ($attribute, $value, $parameters) {
            if ($value === "") {
                return false;
            }

            return $value === null;
        });

        Validator::extend('oid', function ($attribute, $value, $parameters) {
            return preg_match('/^([0-2])((\.0)|(\.[1-9][0-9]*))*$/', $value);
        });

    }
}
