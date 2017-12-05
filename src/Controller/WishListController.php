<?php

namespace App\Controller;

use App\Entity\WishList;
use App\Form\WishListType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WishListController extends AbstractController
{
    /**
     * @Route("/", name="wish_list_index")
     */
    public function index(){
        return $this->redirectToRoute('wish_list_list');
    }


    /**
     * @Route("/wishlist/list", name="wish_list_list")
     */
    public function showList()
    {
        $em = $this->getDoctrine()->getManager();
        $wishLists = $em->getRepository(WishList::class)->findAll();

        return $this->render('WishList/list.html.twig', array(
            'wishLists' => $wishLists,
        ));
    }

    /**
     * @Route("/wishlist/show/{id}", name="wish_list_show", requirements={"id":"\d+"})
     */
    public function show(int $id)
    {
        $wishList = $this->getDoctrine()->getRepository(WishList::class)->find($id);


        return $this->render('WishList/show.html.twig', array(
            'wishlist' => $wishList,
        ));
    }


    /**
     * @Route("/wishlist/create", name="wish_list_create")
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $wishList = new WishList();

        $form = $this->createForm(WishListType::class, $wishList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wishList = $form->getData();
            $em->persist($wishList);
            $em->flush();

            return $this->redirectToRoute('wish_list_show', array('id' => $wishList->getId()));
        }

        return $this->render('WishList/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
