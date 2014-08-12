<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class LessThanRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'lessThan' => array(
                'compared_value' => $constraint->value,
                'message' => str_replace('{{ compared_value }}', $constraint->value, $constraint->message),
            )
        );
        
        return json_encode($rule);
    }
}