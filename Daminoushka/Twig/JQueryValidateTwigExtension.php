<?php

namespace Daminoushka\SimpleJQueryValidationBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class JQueryValidateTwigExtension extends \Twig_Extension
{
    protected $container;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    public function getFunctions()
    {
        return array(
            'jquery_validate' => new \Twig_Function_Method($this, 'jQueryValidate', array('is_safe' => array('all')))
        );
    }
    
    public function jQueryValidate($form)
    {
        $constraints = $this->container->get('jquery.validator.generator')->generateRules(get_class($form->vars['data']));
        
        return $this->container
            ->get('templating')
            ->render('DaminoushkaSimpleJQueryValidationBundle::jQueryValidator.html.twig', array('form' => $form, 'constraints' => $constraints));
    }
    
    public function getName()
    {
        return 'jQueryValidate';
    }
}