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
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use App\Exception\ResourceValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class UserController extends AbstractFOSRestController
{
    /**
     *@Get(
     *     path = "/api/users",
     *     name = "user_all",
     *)
     *@View(
     *     
     *     serializerGroups = {"list"},
     *     statusCode = 200
     * )
     *@Doc\Operation(
     *     
     *     summary="get the list of user",
     *     description="get the list of user",
     *     @SWG\Response(
     *     response=200,
     *     description="Returns the list of user",
     *     @Model(type=User::class)),
     *     @SWG\Response(
     *         response="401",
     *         description="Returned when you use bad credentieals"
     *     )
     * )
     *@SWG\Tag(name="user")
     *@Security(name="Bearer")
     *@IsGranted("ROLE_USER")
     */

    public function allUsers(UserRepository $userRepository)
    {
        return  $userRepository->findAll();    
    }

    /**
    *@Post(
    *   path ="/api/users/", 
    *   name = "user_new"
    * )
    *@ParamConverter("user", 
    *converter="fos_rest.request_body", 
    *options=
    *{
    *   "validator"={ "groups"="Create" }
    *})
    *@View(
    *     
    *     serializerGroups = {"list"},
    *     statusCode = 201
    * )
    * @Doc\Operation(
    *     
    *     summary="Add a new user by the customers",
    *     description="Add a new user by the customers",
    *     @SWG\Parameter(
    *     name="User, ConstraintViolationList",
    *     in="body",
    *     @Model(type=User::class),
    *     description="Json object. There are nine parameters.",
    *     required=true),
    *     @SWG\Response(
    *     response=201,
    *     description="Add a new mobile",
    *     @Model(type=User::class)
    * ),
    *     @SWG\Response(
    *         response="401",
    *         description="Returned when you use bad credentieals"
    *     )
    * )
    *@SWG\Tag(name="user")
    *@Security(name="Bearer")
    *@IsGranted("ROLE_USER")
    */       
    public function addUsers(User $user, ConstraintViolationList $violations)
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
     *     path = "/api/users/{id}",
     *     name = "user_show",
     *     requirements = {"id"="\d+"}
     * )
     *@Rest\View(
     *     populateDefaultVars = false,
     *     serializerGroups = {"details"},
     *     statusCode = 200
     * )
     *@Doc\Operation(
     *     
     *     summary="get the details of user",
     *     description="get the details of user",
     *     @SWG\Parameter(
     *     name="User",
     *     in="query",
     *     type="integer",
     *     description="Json object. There are one parameter, who gets a
     *     user thanks to the id.",
     *     required=true),
     *     @SWG\Response(
     *     response=200,
     *     description="Returns the details of user",
     *     @Model(type=User::class)),
     *     @SWG\Response(
     *     response="401",
     *     description="Returned when you use bad credentieals")
     *) 
     *@SWG\Tag(name="user")
     *@Security(name="Bearer")
     *
     *@IsGranted("ROLE_USER")
     */
    public function showUser(User $user)
    {   
        return $user;  
    }

    /**
     *@Delete(
     *     path = "/api/user/{id}",
     *     name = "user_delete",
     *     requirements = {"id"="\d+"}
     * )
     *@View(statusCode= 200)
     *@Doc\Operation(
     *     
     *     summary="Delete the user",
     *     description="Delete the user",
     *     @SWG\Parameter(
     *     name="User",
     *     in="query",
     *     type="integer",
     *     description="There are one parameter, who delete a user thanks 
     *     to the id.",
     *     required=true),
     *     @SWG\Response(
     *     response=200,
     *     description="Delete a user",
     *     @Model(type=User::class)),
     *     @SWG\Response(
     *     response="401",
     *     description="Returned when you use bad credentieals")
     *) 
     *@SWG\Tag(name="user")
     *@Security(name="Bearer")
     *@IsGranted("ROLE_USER")
     */
    public function delete(User $user)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();        
    }

    
}
