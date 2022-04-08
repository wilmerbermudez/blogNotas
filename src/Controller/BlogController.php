<?php

namespace App\Controller;

use App\Entity\Entrada;
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
        $em = $this->getDoctrine()->getManager();

        $conexion = $em->getConnection();

        $noticias = $em->getRepository(Entrada::class)->findAll();
        return $this->render ('blog/index.html.twig', [
            'noticias' => $noticias
        ]);
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
        $em = $this->getDoctrine()->getManager();
        $conexion = $em->getConnection();
        $formato =$request->request->all();
        $archivo = $_FILES['imagen']['name'];
        $temp = $_FILES['imagen']['tmp_name'];
        move_uploaded_file($temp, 'images/'.$archivo);
        $entrada = new Entrada;
        $entrada->setTitulo($formato['titulo']);
        $entrada->setAutor('WILMER');
        $entrada->setImagen($archivo);
        $entrada->setDescripcion($formato['noticia']);
        $entrada->setFechaCreacion(new \DateTime());
        $em->persist($entrada);
        $flush = $em->flush();

        return $this->redirectToRoute('app_blog');
    }

    /**
     * @Route("/blog/update/{id}", name="update_noticia")
     */
    public function updateNoticia($id): Response
    {   
        $em = $this->getDoctrine()->getManager();
        $conexion = $em->getConnection();
        $noticias = $em->getRepository(Entrada::class)->find($id);

        return $this->render ('blog/updateNoti.html.twig', [
            'noticia' => $noticias
        ]);
    }

    /**
     * @Route("/blog/actualizar/{id}", name="actualizar_noticia")
     */
    public function actualizarNoticia(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $conexion = $em->getConnection();
        $formato =$request->request->all();
        $noticias = $em->getRepository(Entrada::class)->find($id);
        /* $archivo = $_FILES['imagen']['name'];
        $temp = $_FILES['imagen']['tmp_name'];
        move_uploaded_file($temp, 'images/'.$archivo); */
        $noticias->setTitulo($formato['titulo']);
        $noticias->setAutor('WILMER');
        //$noticias->setImagen($archivo);
        $noticias->setDescripcion($formato['noticia']);
        $noticias->setFechaCreacion(new \DateTime());
        $em->persist($noticias);
        $flush = $em->flush();

        return $this->redirectToRoute('app_blog');
    }

    /**
     * @Route("/blog/ver/{id}", name="ver_noticia")
     */
    public function verNoticia($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $conexion = $em->getConnection();
        $noticias = $em->getRepository(Entrada::class)->find($id);

        return $this->render ('blog/noticia.html.twig', [
            'noticia' => $noticias
        ]);
    }
}
