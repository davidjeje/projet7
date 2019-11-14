<?php

namespace App\Controller;

use App\Entity\Mobile;
use App\Form\MobileType;
use App\Repository\MobileRepository;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
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
     *@Doc\Operation(
     *     
     *     summary="get the list of mobile phones",
     *     description="get the list of mobile phones",
     *     
     *     @SWG\Response(
     *     response=200,
     *     description="Returns the list of mobile",
     *     @Model(type=Mobile::class, groups={"list"})),
     *     @SWG\Response(
     *         response="401",
     *         description="Returned when you use bad credentieals"
     *     )
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
    *     populateDefaultVars = false,
    *     serializerGroups = {"list"},
    *     statusCode = 201
    * )
    *@ParamConverter("mobile", 
    *converter="fos_rest.request_body")
    * @Doc\Operation(
    *     
    *     summary="Create a new mobile for the customers",
    *     description="Create a new mobile for the customers",
    *     @SWG\Parameter(
    *     name="Name, Screen, Design, Colour, Android, Processor, Ram, Camera, Storage, *     Drums, Sim Card, Compatibility, SAV",
    *     in="body",
    *     @Model(type=Mobile::class, groups={"details"}),
    *     description="Json object. There are thirteen parameters.",
    *     required=true),
    *     @SWG\Response(
    *     response=201,
    *     description="Create a new mobile",
    *     @Model(type=Mobile::class, groups={"details"})
    * ),
    *     @SWG\Response(
    *         response="401",
    *         description="Returned when you use bad credentieals"
    *     )
    * )
    *@SWG\Tag(name="mobile")
    *@Security(name="Bearer")
    *@IsGranted("ROLE_USER")
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

        /*if (count($violations)) 
        {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }*/
        if (count($violations)) 
        {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) 
            {
                $message .= sprintf("Champs %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
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
     *     path = "/api/mobiles/{id}/",
     *     name = "mobile_show",
     *     requirements = {"id"="\d+"}
     * )
     *@View( 
     *     serializerGroups = {"details"},
     *     statusCode = 200
     * )
     *@Doc\Operation(
     *     
     *     summary="get the details of mobile phones",
     *     description="get the details of mobile phones",
     *     @SWG\Response(
     *     response=200,
     *     description="Returns the details of mobile",
     *     @Model(type=Mobile::class)),
     *     @SWG\Response(
     *     response="401",
     *     description="Returned when you use bad credentieals")
     *) 
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
     *     path = "/api/mobile/{id}/",
     *     name = "mobile_delete",
     *     requirements = {"id"="\d+"}
     * )
     *@View(statusCode= 200)
     *@Doc\Operation(
     *     
     *     summary="delete the mobile phones",
     *     description="delete the mobile phones",
     *     @SWG\Response(
     *     response=200,
     *     description="Delete a mobile",
     *     @Model(type=Mobile::class)),
     *     @SWG\Response(
     *     response="401",
     *     description="Returned when you use bad credentieals")
     *) 
     *@SWG\Tag(name="mobile")
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
