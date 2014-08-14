<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class RegexRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'pattern' => $constraint->pattern,
            'messages' => array(
                'pattern' => $constraint->message,
            )
        );
        
        return json_encode($rule);
    }
}