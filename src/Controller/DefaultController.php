<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index(Request $request)
    {
        $locale = $request->getLocale() ?? $request->getDefaultLocale();
        return $this->redirectToRoute('wish_list_index', array('_locale' => $locale));
    }
}
