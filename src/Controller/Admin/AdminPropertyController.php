<?php
namespace App\Controller\Admin;

use App\Form\PropertyType;
use App\Form\AnimauxType;
use App\Entity\Admin;
use App\Entity\Property;
use App\Entity\Animaux;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;

class AdminPropertyController extends AbstractController {

     /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    private $session;

    public function __construct(PropertyRepository $repository, ObjectManager $em, SessionInterface $session)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * @Route("/admin/{id}", name="admin.property.index")
     * @param Admin $admin
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Admin $admin)
    {

        $properties = $this->em->getRepository(Property::class)->findByUser($admin->getId());
        //dd($admin->getId());
        return $this->render('admin/property/index.html.twig', [
            'admin' => $this->session->get('id'),
            'properties' => $properties
        ]/*, compact('properties')*/);

    }

    /**
     * @Route("/admin/{id}/property/create", name="admin.property.new")
     * @param Admin $admin
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request, Admin $admin){

        $Property = new Property();
        $Property->setIdUser($admin->getId());
        $Property->setUser($admin);
        //dd($Property);
        $form = $this->createForm(PropertyType::class, $Property);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){



            $this->em->persist($Property);

            $this->em->flush();



            return $this->redirectToRoute('admin.property.edit', [
                'idad' => $this->session->get('id'),
                'id' => $Property->getId()
            ]);
        }



        return $this->render('admin/property/new.html.twig', [
            'admin' => $this->session->get('id'),
            'Property' => $Property,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/admin/{idad}/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $Property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit( Property $Property, Request $request)
    {


        $form = $this->createForm(PropertyType::class, $Property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Edité avec succès');
            return $this->redirectToRoute('admin.property.index', ['id' => $this->session->get('id')] );
        }
        return $this->render('admin/property/edit.html.twig', [
            'admin' => $this->session->get('id'),
            'Property' => $Property,
            'form' => $form->createView()
    ]);
    }

    /**
     * @Route("/admin/{idad}/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $Property
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Property $Property) {

        //dd($Property->getAnimaux());

        $this->em->remove($Property);
        $this->em->flush();
        $this->addFlash('success', 'Supprimé avec succès');
        return $this->redirectToRoute('admin.property.index', ['id' => $this->session->get('id')]);
    }
}