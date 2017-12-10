<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    protected $request;

    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }

    public function getFilters()
    {
        return array(
            new TwigFilter('price', array($this, 'priceFilter')),
        );
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('active', array($this, 'activeFunction')),
            new TwigFunction('locale', array($this, 'isLocaleFunction')),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

        return $price;
    }

    /**
     * Used in twig with {{ active('name_of_route') }}, it will return active if the link given match the current route
     * $Link can be string or array (useful for dropdown)
     *
     * @param mixed $link
     * @return string
     * @todo create test phpunit
     */
    public function activeFunction($link): string
    {
        $route = $this->request->getCurrentRequest()->get('_route');
        return (in_array($route, (array)$link)) ? 'active' : '';
    }

    /**
     * @param string $locale
     * @return string
     */
    public function isLocaleFunction(string $locale): string
    {
        return ($locale === $this->request->getCurrentRequest()->getLocale()) ? 'active' : '';
    }
}