<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class EqualToRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'equalToValue' => array(
                'compared_value' => $constraint->value,
                'message' => str_replace('{{ compared_value }}', $constraint->value, $constraint->message),
            )
        );
        
        return json_encode($rule);
    }
}