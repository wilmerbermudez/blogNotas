<?php

namespace App\Controller;

use App\Entity\Contacto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
    /**
     * @Route("/contacto", name="app_contacto")
     */
    public function index(): Response
    {   
        return $this->render('contacto/index.html.twig', [
            'controller_name' => 'ContactoController',
        ]);
    }

    /**
     * @Route("/contacto/crear", name="mensaje_contacto")
     */
    public function mensajeContacto(Request $request): Response
    {   
        
        $em = $this->getDoctrine()->getManager();
        $conexion = $em->getConnection();
        $formato =$request->request->all();
        //dd($formato);
        $mensaje = new Contacto;
        $mensaje->setNombre($formato['nombre']);
        $mensaje->setCorreo($formato['correo']);
        $mensaje->setMensaje($formato['mensaje']);
        $em->persist($mensaje);
        //dd($mensaje);
        $flush = $em->flush();

        return $this->render('contacto/index.html.twig', [
            'controller_name' => 'ContactoController',
        ]);
    }
}
