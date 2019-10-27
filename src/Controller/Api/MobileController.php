<?php

namespace App\Controller\Api;

use App\Entity\Mobile;
use App\Form\MobileType;
use App\Repository\MobileRepository;
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


class MobileController extends AbstractFOSRestController
{
    
    /**
     *@Get(
     *     path = "/api/mobiles/",
     *     name = "mobile_all",
     *     
     * )
     *@View(
     *     
     *     serializerGroups = {"list"},
     *     statusCode = 200
     * )
     * 
     *@SWG\Response(
     *     response=200,
     *     description="Returns the list of mobile",
     *     @Model(type=Mobile::class)
     * )
     *@SWG\Parameter(
     *     name="MobileRepository",
     *     in="query",
     *     type="string",
     *     description="This parameter makes it possible to make a query in the database and 
     *     retrieve the list of mobiles."
     * )
     *@SWG\Tag(name="mobile")
     *@Security(name="Bearer")
     *@IsGranted("ROLE_USER")
     * 
     */
    public function getMobiles(MobileRepository $mobileRepository)
    {
        return $mobileRepository->findAll();
    }
    
    /**
    *@Post(
    *   path ="/api/mobiles/", 
    *   name = "mobile_new"
    * )
    *@View(
    *     
    *     serializerGroups = {"list"},
    *     statusCode = 201
    * )
    *@ParamConverter("mobile", 
    *converter="fos_rest.request_body", 
    *options=
    *{
    *   "validator"={ "groups"="Create" }
    *})
    *@SWG\Response(
    *     response=201,
    *     description="Create a new mobile",
    *     @Model(type=Mobile::class)
    * )
    *@SWG\Parameter(
    *     name="Mobile",
    *     in="query",
    *     type="string",
    *     description="There are two parameters, one is the creation of a mobile entity and 
    *     the other is an exception that identifies the errors."
    * )
    *@SWG\Tag(name="mobile")
    *@Security(name="Bearer")
    *@IsGranted("ROLE_SUPER_ADMIN")
    *     
    *     
    * )
    */  
    public function createMobiles(Mobile $mobile, ConstraintViolationList $violations)
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
        $entityManager->persist($mobile);
        $entityManager->flush();
        
        return $this->view($mobile, 
            Response::HTTP_CREATED, 
            ['Location' => $this->generateUrl('mobile_new', ['id' => $mobile->getId(), UrlGeneratorInterface::ABSOLUTE_URL])
        ]);
       
    }

    
    /**
     *@Get(
     *     path = "/api/mobiles/{id}",
     *     name = "mobile_show",
     *     requirements = {"id"="\d+"}
     * )
     *@View(
     *     
     *     serializerGroups = {"details"},
     *     statusCode = 200
     * )
     *@SWG\Response(
     *     response=200,
     *     description="Returns the details of mobile",
     *     @Model(type=Mobile::class)
     * )
     *@SWG\Parameter(
     *     name="Mobile entity",
     *     in="query",
     *     type="string",
     *     description="There are one parameter, a mobile entity who gets a mobile thanks to 
     *     the id."
     * )
     *@SWG\Tag(name="mobile")
     *@Security(name="Bearer")
     *@IsGranted("ROLE_USER")
     */
    public function getMobile(Mobile $mobile)
    {
        return $mobile;   
    }

    /**
     *@Delete(
     *     path = "/api/mobile/{id}",
     *     name = "mobile_delete",
     *     requirements = {"id"="\d+"}
     * )
     *@View(statusCode= 200)
     *@SWG\Response(
     *     response=200,
     *     description="Delete a mobile",
     *     @Model(type=Mobile::class)
     * )
     *@SWG\Parameter(
     *     name="Mobile",
     *     in="query",
     *     type="string",
     *     description="There are one parameter, a mobile entity who delete a mobile thanks 
     *     to the id."
     * )
     *@SWG\Tag(name="mobile_delete")
     *@Security(name="Bearer")
     *@IsGranted("ROLE_SUPER_ADMIN")
     */
    public function delete(Mobile $mobile)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($mobile);
        $entityManager->flush();        
    }

}
