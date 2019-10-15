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
     *@IsGranted("ROLE_USER")
     * 
     */
    public function getMobiles(MobileRepository $mobileRepository)
    {
        return $mobileRepository->findAll();
        /*$repository = $this->getDoctrine()->getRepository(Song::class);
        $songs = $repository->findAll();
        return $this->handleView($this->view($songs));*/
    }
    
    /**
    *@Post(
    *   path ="/api/mobiles/", 
    *   name = "mobile_new"
    * )
    *@View(
    *     
    *     serializerGroups = {"list"},
    *     statusCode = 200
    * )
    *@ParamConverter("mobile", 
    *converter="fos_rest.request_body", 
    *options=
    *{
    *   "validator"={ "groups"="Create" }
    *})
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
     *@IsGranted("ROLE_USER")
     */
    public function getMobile(Mobile $mobile)
    {
        return $mobile;   
    }

}
