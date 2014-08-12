<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class NotBlankRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'required' => true,
            'messages' => array(
                'required' => $constraint->message,
            )
        );
        
        return json_encode($rule);
    }
}