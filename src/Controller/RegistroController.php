<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\Usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RegistroController extends AbstractController
{
    /**
     * @Route("/registro", name="registro")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {   
        $user = new Usuarios();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            //$user->setClave($passwordEncoder->encodePassword($user,$form['clave']->getData()));
            $em->persist($user);
            $em->flush();
            $this->addFlash(
                'exito',
                'Registro exitoso');
            return $this->render ('home/index.html.twig');
        }
        return $this->render('registro/index.html.twig', [
            'formulario' => $form->createView(),
        ]);
    }
}
