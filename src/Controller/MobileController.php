<?php

namespace App\Controller;

use App\Entity\Mobile;
use App\Form\MobileType;
use App\Repository\MobileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
//use App\Exception\ResourceValidationException;


class MobileController extends FOSRestController
{
    
    /**
     *@Get(
     *     path = "/allMobille",
     *     name = "mobile_all",
     *     
     * )
     *@View
     */
    public function index(MobileRepository $mobileRepository)
    {
        return $mobileRepository->findAll();
        /*return $this->render('mobile/index.html.twig', [
            'mobiles' => $mobileRepository->findAll(),
        ]);*/
    }

    
    /**
    *@Post(
    *   path ="/new", 
    *   name = "mobile_new"
    * )
    *@View(StatusCode=201)
    *@ParamConverter("mobile", 
    *converter="fos_rest.request_body", 
    *options=
    *{
    *   "validator"={ "groups"="Create" }
    *})
    */  
    public function new(Mobile $mobile, ConstraintViolationList $violations)
    {
        //dump($mobile); die;
        /*$errors = $this->get('validator')->validate($mobile);

        if (count($errors)) 
        {
            return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }*/
        if (count($violations)) 
        {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($mobile);
        $entityManager->flush();
        
        return $this->view($mobile, 
            Response::HTTP_CREATED, 
            ['Location' => $this->generateUrl('mobile_new', ['id' => $mobile->getId(), UrlGeneratorInterface::ABSOLUTE_URL])
        ]);
       
    }

    
    /**
     *@Get(
     *     path = "/mobile/{id}",
     *     name = "mobile_show",
     *     requirements = {"id"="\d+"}
     * )
     *@View
     */
    public function show(Mobile $mobile)
    {
        return $mobile;
       /* return $this->render('mobile/show.html.twig', [
            'mobile' => $mobile,
        ]);*/
    }

    /**
     * @Route("/{id}/edit", name="mobile_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mobile $mobile): Response
    {
        $form = $this->createForm(MobileType::class, $mobile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mobile_index');
        }

        return $this->render('mobile/edit.html.twig', [
            'mobile' => $mobile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mobile_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mobile $mobile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mobile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mobile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mobile_index');
    }
}
