<?php
namespace App\Controller;

use App\Entity\Animaux;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use App\Repository\AdminRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;


    private $session;



    public function __construct(PropertyRepository $repository, ObjectManager $em, SessionInterface $session )
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * @Route("/biens", name="Property.index")
     * @return Response
     */
    public function index(Request $request): Response {

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);


        $Property = $this->em->getRepository(Property::class)->findAllVisibleQuery($search);

        //dd($search->getCategorie());


        if($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();

            $form = $this->createForm(PropertySearchType::class, $search);
            $form->handleRequest($request);

            $Property = $this->em->getRepository(Property::class)->findAllVisibleQuery($search);



//dd($search->getCategorie());
            if($search->getCategorie() == 1)
            {
                $animaux = $this->em->getRepository(Animaux::class)->findAll();
            }
        }




            //dd($Property);
        return $this->render('property/index.html.twig', [
            'properties' => $Property,
            'current_menu' => 'properties',
            'admin' => $this->session->get('id'),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/pages/inscription", name="pages.inscription")
     * @return Response
     */
    public function inscription(): Response {

        return $this->render('pages/inscription.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/connexion", name="pages.connexion")
     * @return Response
     */
    public function connexion(): Response {

        return $this->render('pages/connexion.html.twig', [
            'current_menu' => 'properties'
        ]);
    }


    /**
     * @Route("/deconnexion", name="pages.deconnexion")
     * @return Response
     */
    public function deconnexion(): Response {

        return $this->render('pages/home.html.twig', [
            'current_menu' => 'properties'
        ]);
    }


    /**
     * @Route("/modifier", name="pages.modifier")
     * @return Response
     */
    public function modifier(): Response {

        return $this->render('pages/modifier.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="Property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $Property
     * @return Response
     */
    public function show(Property $Property, string $slug): Response
    {

        if ($Property->getSlug() !== $slug){
            return $this->redirectToRoute('Property.show', [
                'id' => $Property->getId(),
                'slug'=> $Property->getSlug()
            ], 301);
        }



        return $this->render('property/show.html.twig', [
            'Property' => $Property,
            'vendeur' => $Property->getUser(),
            'username' => $this->session->get('name'),
            'userphone' => $this->session->get('phone'),
            'usermail' =>$this->session->get('mail'),
            'current_menu' => 'properties',
            'current_vendeur' => 'vendeur',
            'admin' => $this->session->get('id')
    ]);
    }

}