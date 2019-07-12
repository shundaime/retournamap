<?php


namespace App\Controller\Admin;


use App\Entity\GalleryImage;
use App\Form\GalleryType;
use App\Repository\GalleryImageRepository;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminGalleryController extends AbstractController
{
    /**
     * @var GalleryImageRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(GalleryImageRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/gallery", name="admin.gallery.index")
     * @return Response
     */
    public function index()
    {
        $images = $this->repository->findAll();
        return $this->render('admin/gallery/index.html.twig', ['images' => $images]);
    }

    /**
     * @Route("/admin/gallery/new", name="admin.gallery.new")
     */
    public function new(Request $request,  FileUploader $fileUploader)
    {
        $image = new GalleryImage();
        $form = $this->createForm(GalleryType::class, $image, ['validation_groups' => ['Default', 'new']]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($image);
            $this->em->flush();
            $this->addFlash('success', "Image créée avec succès");
            return $this->redirectToRoute('admin.gallery.index');
        }
        return $this->render('admin/gallery/new.html.twig',
            [   'image' => $image,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/gallery/{id}", name="admin.gallery.edit", methods="GET|POST")
     * @param GalleryImage $image
     * @param Request $request
     * @return Response
     */
    public function edit(GalleryImage $image, Request $request)
    {
        $form = $this->createForm(GalleryType::class, $image);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($image);
            $this->em->flush();
            $this->addFlash('success', "Image modifiée avec succès");
            return $this->redirectToRoute('admin.gallery.index');
        }

        return $this->render('admin/gallery/edit.html.twig',
            [   'image' => $image,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/gallery/{id}", name="admin.gallery.delete", methods="DELETE")
     * @param GalleryImage $galleryImage
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(GalleryImage $galleryImage, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $galleryImage->getId(), $request->get('_token'))){
            $this->em->remove($galleryImage);
            $this->em->flush();
            $this->addFlash('success', "Image supprimée avec succès");
        }
        return $this->redirectToRoute('admin.gallery.index');
    }
}