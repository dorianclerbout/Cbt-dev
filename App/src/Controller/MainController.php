<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(Request $request): Response
    {
        $message = new Contact;

        $form = $this->createForm(ContactType::class, $message);
        
        $contact = $form->handleRequest($request);
      
        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
         
        }

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/web-development", name="app_dev")
     */
    public function web(): Response
    {
        
        return $this->render('dev/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
