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
     * @Route("/", name="home"))
     */
    public function home () {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route("/fonctionnement", name="explain"))
     */
    public function explain () {
        return $this->render('pages/explain.html.twig');
    }

    /**
     * @Route("/producteurs", name="productors"))
     */
    public function productors () {
        return $this->render('pages/productors.html.twig');
    }

    /**
     * @Route("/galerie", name="gallery"))
     */
    public function gallery () {
        return $this->render('pages/gallery.html.twig');
    }

    /**
     * @Route("/contact", name="contact"))
     */
    public function contact () {
        return $this->render('pages/contact.html.twig');
    }

}