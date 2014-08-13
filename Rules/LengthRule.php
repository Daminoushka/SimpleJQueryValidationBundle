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
                'minlength' => $constraint->minMessage,
                'maxlength' => $constraint->maxMessage,
            )
        );
        
        return json_encode($rule);
    }
}