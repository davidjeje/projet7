<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use App\Exception\ResourceValidationException;

class UserController extends FOSRestController
{
    /**
     *@Get(
     *     path = "/users/",
     *     name = "user_all",
     *     
     * )
     *@View
     */
    public function index(UserRepository $userRepository)
    {
        return  $userRepository->findAll();    
    }

    /**
    *@Post(
    *   path ="/users/", 
    *   name = "user_new"
    * )
    *@View(StatusCode=201)
    *@ParamConverter("user", 
    *converter="fos_rest.request_body", 
    *options=
    *{
    *   "validator"={ "groups"="Create" }
    *})
    */       
    public function new(User $user, ConstraintViolationList $violations)
    {
       //dump($user); die;
        /*$errors = $this->get('validator')->validate($user);

        if (count($errors)) 
        {
            return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }*/

        if (count($violations)) 
        {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }
        /*if (count($violations)) 
        {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) 
            {
                $message .= sprintf("Champs %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
        }*/
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        
        return $this->view($user, 
            Response::HTTP_CREATED, 
            ['Location' => $this->generateUrl('user_new', ['id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL])
        ]);
       
    }

    /**
     *@Get(
     *     path = "/users/{id}",
     *     name = "user_show",
     *     requirements = {"id"="\d+"}
     * )
     *@View
     */
    public function show(User $user)
    {
        return $user;  
    }

    /**
     *@Delete(
     *     path = "/users/{id}",
     *     name = "user_delete",
     *     requirements = {"id"="\d+"}
     * )
     *@View
     */
    public function delete(User $user)
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $user; // je dois retourner un message qui informe que la suppression c'est bien passé.
    }
}
