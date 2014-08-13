<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Rules;

class UrlRule
{
    public function getJSRule($constraint)
    {
        $rule = array(
            'url' => true,
            'messages' => array(
                'required' => $constraint->message,
            )
        );
        
        return json_encode($rule);
    }
}