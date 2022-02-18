<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PagesController
 * @package App\Controller
 */

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home()
    {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route("/fonctionnement", name="explain", methods={"GET"})
     */
    public function explain()
    {
        return $this->render('pages/explain.html.twig');
    }

    /**
     * @Route("/producteurs", name="productors", methods={"GET"})
     */
    public function productors()
    {
        return $this->render('pages/productors.html.twig');
    }

    /**
     * @Route("/galerie", name="gallery", methods={"GET"})
     */
    public function gallery()
    {
        return $this->render('pages/gallery.html.twig');
    }

    /**
     * @Route("/legal", name="legal", methods={"GET"})
     */
    public function legal()
    {
        return $this->render('pages/legal.html.twig');
    }

    /**
     * @Route("/status", name="status", methods={"GET"})
     */
    public function status()
    {
        return $this->render('pages/status.html.twig');
    }

    /**
     * @Route("/amapj", name="amapj", methods={"GET"})
     */
    public function amapj()
    {
        return $this->render('pages/amapj.html.twig');
    }
}
