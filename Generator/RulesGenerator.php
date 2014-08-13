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
    
    /**
     * Path to the entity to load validators
     * 
     * @var string
     */
    protected $entity;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * Load class metadata and transoform for JS
     */
    public function generateRules($entity)
    {
        $this->entity = $entity;
        
        // Load class metadata
        $metadatas = $this->container
            ->get('validator')
            ->getMetadataFactory()
            ->getMetadataFor($this->entity);
        
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
            // Get the constraint name : last word after last "\"
            $constraintName = substr(strrchr(get_class($constraint), '\\'), 1);
            
            // Call the corresponding service to get the json encoded rule
            $serviceName = 'jquery.validator.rules.'.strtolower($constraintName);
            
            if ($this->container->has($serviceName)) {
                $rules[] = $this->container->get($serviceName)->getJSRule($constraint);
            }
        }
        
        return $rules;
    }
}