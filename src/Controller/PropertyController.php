<?php
namespace App\Controller;

use App\Entity\Animaux;
use App\Entity\Immobilier;
use App\Entity\Multimedia;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Entity\Vehicules;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use App\Repository\AdminRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

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
     */
    public function index(Request $request, EntityManagerInterface $em){

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            //dd($search->getCategorie());

            $search = $form->getData();
            $form = $this->createForm(PropertySearchType::class, $search);
            $form->handleRequest($request);

            $search = $form->getData();

            //dd($request);
            $Property = $this->em->getRepository(Property::class)->findAllVisibleQuery($search);
            $properties = array();


            if($search->getCategorie())
            {
                if($search->getCategorie() == 1)
                {

                    $repository = $em->getRepository(Animaux::class);

                    $animaux = $repository->findBySearch($search, $Property);

                    foreach($animaux as $animal)
                    {
                        $properties[] = $animal->getProperty();

                    }


                }
                elseif($search->getCategorie() == 2)
                {
                    $repository = $em->getRepository(Immobilier::class);

                    $immobiliers = $repository->findBySearch($search, $Property);

                    //dd($animaux);
                    foreach($immobiliers as $immobilier)
                    {
                        $properties[] = $immobilier->getProperty();

                    }
                }

                elseif($search->getCategorie() == 3)
                {
                    $repository = $em->getRepository(Multimedia::class);

                    $multis= $repository->findBySearch($search, $Property);

                    //dd($animaux);
                    foreach($multis as $multi)
                    {
                        $properties[] = $multi->getProperty();

                    }
                }

                elseif($search->getCategorie() == 4)
                {
                    $repository = $em->getRepository(Vehicules::class);

                    $vehis = $repository->findBySearch($search, $Property);

                    //dd($animaux);
                    foreach($vehis as $vehi)
                    {
                        $properties[] = $vehi->getProperty();

                    }
                }

                return $this->render('property/index.html.twig', [
                    'admin' => $this->session->get('id'),

                    'current_menu' => 'properties',
                    'properties' => $properties,
                    'form' => $form->createView()
                ]);
            }






            return $this->render('property/index.html.twig', [
                'admin' => $this->session->get('id'),
                'current_menu' => 'properties',
                'properties' => $Property,
                'form' => $form->createView()
            ]);
        }

        $Property = $this->em->getRepository(Property::class)->findAllVisibleQuery($search);


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

        switch ($Property->getCat())
        {
            case 1 : $cat=Property::CAT[1];break;
            case 2 : $cat=Property::CAT[2];break;
            case 3 : $cat=Property::CAT[3];break;
            case 4 : $cat=Property::CAT[4];break;
            case 5 : $cat=Property::CAT[5];break;
            default : $cat=Property::CAT[5];break;

        }


        return $this->render('property/show.html.twig', [
            'Property' => $Property,
            'Cat' => $cat,
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