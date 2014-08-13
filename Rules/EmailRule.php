<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class EmailRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'required' => true,
            'email' => true,
            'messages' => array(
                'required' => $constraint->message,
                'email' => $constraint->message,
            )
        );
        
        return json_encode($rule);
    }
}