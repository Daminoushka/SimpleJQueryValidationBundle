<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Generator;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * Generate rules for JQuery Validate
 */
class RulesGenerator
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * Load class metadata and transform for JS
     */
    public function generateRules($form)
    {        
        $entity = get_class($form->vars['data']);
        
        // Load class metadata
        $metadatas = $this->container
            ->get('validator')
            ->getMetadataFactory()
            ->getMetadataFor($entity);
        
        $constraints = array();
        
        foreach ($metadatas->properties as $property) {
            // Get constraints ready for JS
            $constraints[$property->getName()] = $this->getConstraintsForJS($property->getConstraints());
        }
        
        return $constraints;
    }
    
    
    /*****
     * 
     * Private functions
     * 
     ****/
    
    /**
     * Transform Symfony constraints to JqueryValidate rules
     * 
     * @param array $constraints
     * @return array
     */
    private function getConstraintsForJS($constraints)
    {
        $rules = array();
        
        foreach ($constraints as $constraint) {
            $class = new \ReflectionClass($constraint);
            // Get the constraint name
            $constraintName = $class->getShortName();
            
            // Call the corresponding service to get the json encoded rule
            $serviceName = 'jquery.validator.rules.'.strtolower($constraintName);
            
            if ($this->container->has($serviceName)) {
                $rules[] = $this->container->get($serviceName)->getJSRule($constraint);
            }
        }
        
        return $rules;
    }
}