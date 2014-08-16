<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class LengthRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'minlength' => $constraint->min,
            'maxlength' => $constraint->max,
            'messages' => array(
                'minlength' => str_replace('{{ limit }}', $constraint->min, $constraint->minMessage),
                'maxlength' => str_replace('{{ limit }}', $constraint->max, $constraint->maxMessage),
            )
        );
        
        return json_encode($rule);
    }
}