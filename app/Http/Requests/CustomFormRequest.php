<?php

namespace App\Http\Requests;

use App\Http\Requests\Validations\CustomRequestValidators;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException as IlluminateValidationException;

class CustomFormRequest extends FormRequest
{
    protected $error_code;
    protected $error_id;
    protected $message;
    /**
     * Removes null values from the only method
     *
     * @param array $keys
     * @return array
     */
    public function __construct()
    {
        $this->error_id = 3000;
        $this->message = "Erro de validação dos campos informados.";
        parent::__construct();
        CustomRequestValidators::registerCustomValidators();
    }

    public function rules()
    {
        return array();
    }

    public function only($keys)
    {
        $keys = is_array($keys) ? $keys : func_get_args();
        $arr = parent::only($keys);
        return array_filter($arr, function ($value, $key) {
            //Verifica se a chave existente no validParams também existe na requisição | usado para passar null
            if ($this->exists($key)) {
                return true;
            };
            return ($value !== null);
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function wantsJson()
    {
        return true;
    }

    public function withValidator(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $validator->after(function ($validator) {
            if (empty($validator->failed())) {
                $this->sanitize();
            } else {
                $routeName = \Request::route()->getName();
                // Log::ERROR('servico', '[ac.erro.entrada.dados] Falha ao validar campos. Rota: ' . $routeName, $validator->getMessageBag()->toArray());
            }
        });
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = (new IlluminateValidationException($validator))->errors();
        $response = [
            'error_id' => $this->error_id,
            'error_code' => $this->error_code,
            'message' => $this->message,
            'error_fields' => $errors,
        ];

        throw new HttpResponseException(
            response()->json($response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    public function sanitize()
    {
        if (empty($this->rules())) {
            return;
        }

        //Dot notation makes it possible to parse nested values without recursion
        $original = Arr::dot($this->all());
        $filtered = [];
        $rules = collect($this->rules());
        $keys = $rules->keys();
        $rules->each(function ($rules, $key) use ($original, $keys, &$filtered) {
            //Allow for array or pipe-delimited rule-sets
            if (is_string($rules)) {
                $rules = explode('|', $rules);
            }
            //In case a rule requires an element to be an array, look for nested rules
            $nestedRules = $keys->filter(function ($otherKey) use ($key) {
                return (strpos($otherKey, "$key.") === 0);
            });
            //If the input must be an array, default missing nested rules to a wildcard
            if (in_array('array', $rules) && $nestedRules->isEmpty()) {
                $key .= ".*";
            }
            foreach ($original as $dotIndex => $element) {
                //fnmatch respects wildcard asterisks
                if (fnmatch($key, $dotIndex)) {
                    //array_set respects dot-notation, building out a normal array
                    Arr::set($filtered, $dotIndex, $element);
                }
            }
        });
        //Replace all input values with the filtered set
        $this->replace($filtered);
    }
}
