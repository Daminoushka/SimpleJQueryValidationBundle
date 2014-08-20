<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class RegexRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'regex' => array(
                'pattern' => $constraint->pattern,
                'message' =>  $constraint->message,
            )
        );
        
        return json_encode($rule);
    }
}