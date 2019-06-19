<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


/**
 * Class MainController
 * @package App\Controller
 */

class MainController extends Controller
{
    /**
     * @Route("/", name="home"))
     */
    public function home () {
        return $this->render('default/home.html.twig');
    }

    /**
     * @Route("/", name="explain"))
     */
    public function explain () {
        return $this->render('pages/explain.html.twig');
    }

    /**
     * @Route("/", name="productors"))
     */
    public function productors () {
        return $this->render('pages/productors.html.twig');
    }

    /**
     * @Route("/", name="gallery"))
     */
    public function gallery () {
        return $this->render('pages/gallery.html.twig');
    }

    /**
     * @Route("/", name="contact"))
     */
    public function contact () {
        return $this->render('pages/contact.html.twig');
    }

}