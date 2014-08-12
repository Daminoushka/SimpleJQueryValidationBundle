<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class GreaterThanRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'greaterThan' => array(
                'compared_value' => $constraint->value,
                'message' => str_replace('{{ compared_value }}', $constraint->value, $constraint->message),
            )
        );
        
        return json_encode($rule);
    }
}