<?php
/**
 * Created by PhpStorm.
 * User: thibaut
 * Date: 03/12/17
 * Time: 11:36
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LuckyController
 * @package App\Controller
 */
class LuckyController extends Controller
{
    /**
     * @Route("/")
     * @return Response
     */
    public function index()
    {
        return new Response(
            '<html><body>I\'m here!</body></html>'
        );
    }

    /**
     * @Route("/lucky/number")
     * @return Response
     */
    public function number()
    {
        $number = mt_rand(0, 100);

        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        ));
    }
}

