<?php

namespace App\Controller;

use App\Entity\WishList;
use App\Form\WishListType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class WishListController
 * @package App\Controller
 * @Route("/wishlist", name="wishlist_")
 */
class WishListController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->redirectToRoute('wishlist_list');
    }

    /**
     * @Route("/list", name="list")
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
     * @Route("/show/{id}", name="show", requirements={"id":"\d+"})
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(int $id)
    {
        $wishList = $this->getDoctrine()->getRepository(WishList::class)->find($id);

        return $this->render('WishList/show.html.twig', array(
            'wishlist' => $wishList,
        ));
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, TranslatorInterface $translator)
    {
        $em = $this->getDoctrine()->getManager();

        $wishList = new WishList();

        $form = $this->createForm(WishListType::class, $wishList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wishList = $form->getData();
            $em->persist($wishList);
            $em->flush();

            $this->addFlash('success', $translator->trans('list.create.success'));
            return $this->redirectToRoute('wishlist_show', array('id' => $wishList->getId()));
        }

        return $this->render('WishList/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param Request $request
     * @param TranslatorInterface $translator
     * @param WishList $wishList
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, TranslatorInterface $translator, WishList $wishList)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(WishListType::class, $wishList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wishList = $form->getData();
            $em->persist($wishList);
            $em->flush();

            $this->addFlash('success', $translator->trans('list.edit.success'));
            return $this->redirectToRoute('wishlist_show', array('id' => $wishList->getId()));
        }

        return $this->render('WishList/edit.html.twig', array(
            'id' => $wishList->getId(),
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param WishList $wishList
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(WishList $wishList, TranslatorInterface $translator)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($wishList);
        $em->flush();
        $this->addFlash('success', $translator->trans('list.delete.success'));
        return $this->redirectToRoute('wishlist_list');
    }
}
