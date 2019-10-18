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
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route("/fonctionnement", name="explain")
     */
    public function explain()
    {
        return $this->render('pages/explain.html.twig');
    }

    /**
     * @Route("/producteurs", name="productors")
     */
    public function productors()
    {
        return $this->render('pages/productors.html.twig');
    }

    /**
     * @Route("/galerie", name="gallery")
     */
    public function gallery()
    {
        return $this->render('pages/gallery.html.twig');
    }

    /**
     * @Route("/legal", name="legal")
     */
    public function legal()
    {
        return $this->render('pages/legal.html.twig');
    }

    /**
     * @Route("/status", name="status")
     */
    public function status()
    {
        return $this->render('pages/status.html.twig');
    }

    /**
     * @Route("/articles", name="articles")
     */
    public function articles()
    {
        return $this->render('pages/articles.html.twig');
    }
}
