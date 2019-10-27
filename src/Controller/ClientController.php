<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use App\Exception\ResourceValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;


class ClientController extends AbstractFOSRestController
{


    /**
     *@Get(
     *     path = "/api/clients/",
     *     name = "client_all",
     *     
     * )
     *@View
     * 
     *@IsGranted("ROLE_SUPER_ADMIN")
     * 
     */
    public function getClients(ClientRepository $clientRepository)
    {
        return $clientRepository->findAll();
    }

        /**
    *@Post(
    *   path ="/api/clients/", 
    *   name = "client_new"
    * )
    *@View(StatusCode=201)
    *@ParamConverter("client", 
    *converter="fos_rest.request_body", 
    *options=
    *{
    *   "validator"={ "groups"="Create" }
    *})
    *@IsGranted("ROLE_USER")
    *     requirements={
    *         {
    *             "name"="id",
    *             "dataType"="integer",
    *             "requirements"="\d+",
    *             "description"="The client unique identifier."
    *         }
    *     }
    * )
    */  
    public function addClient(Client $client, ConstraintViolationList $violations)
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
        $entityManager->persist($client);
        $entityManager->flush();
        
        return $this->view($client, 
            Response::HTTP_CREATED, 
            ['Location' => $this->generateUrl('client_new', ['id' => $client->getId(), UrlGeneratorInterface::ABSOLUTE_URL])
        ]);
       
    }

    /**
     *@Get(
     *     path = "/api/clients/{id}",
     *     name = "client_show",
     *     requirements = {"id"="\d+"}
     * )
     *@View
     *@IsGranted("ROLE_SUPER_ADMIN")
     */
    public function getClient(Client $client)
    {
        return $client;   
    }

    /**
     *@Delete(
     *     path = "/api/clients/{id}",
     *     name = "client_delete",
     *     requirements = {"id"="\d+"}
     * )
     *@View
     *@IsGranted("ROLE_SUPER_ADMIN")
     */
    public function delete(Client $client)
    {
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
    }
}
