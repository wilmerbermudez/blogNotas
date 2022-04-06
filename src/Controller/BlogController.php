<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="app_blog")
     */
    public function index(): Response
    {
        return $this->render ('blog/index.html.twig');
    }

    /**
     * @Route("/blog/crear", name="crear_entrada")
     */
    public function crearNoticia(): Response
    {
        return $this->render ('blog/crearNoti.html.twig');
    }

    /**
     * @Route("/blog/guardar", name="guardar_noticia")
     */
    public function guardarNoticia(Request $request): Response
    {
        //dd($request);
        return $this->render ('blog/crearNoti.html.twig');
    }
}
