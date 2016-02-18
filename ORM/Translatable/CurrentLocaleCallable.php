<?php

namespace Unifik\DoctrineBehaviorsBundle\ORM\Translatable;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class CurrentLocaleCallable
 */
class CurrentLocaleCallable
{
    private $container;

    /**
     * Constructor
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Called when used in a closure
     *
     * @return mixed|string
     */
    public function __invoke()
    {
        if (!$this->container->isScopeActive('request')) {
            return;
        }

        $request = $this->container->get('request');

        // Request Locale
        if ($locale = $request->getLocale()) {
            return $locale;
        }

        // System locale
        return $this->container->getParameter('locale');
    }
}

