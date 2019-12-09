<?php
namespace App\Controller\Admin;

use App\Form\AdminType;
use App\Form\AdminConType;
use App\Repository\AdminRepository;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use MongoDB\Driver\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Admin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController {

    /**
     * @var AdminRepository
     */
    private $repository;

    /**
     * @var PropertyRepository
     */
    private $prep;

    /**
     * @var ObjectManager
     */
    private $em;

    private $session;

    public function __construct(AdminRepository $repository, PropertyRepository $prep, ObjectManager $em, SessionInterface $session)
    {
        $this->repository = $repository;
        $this->prep = $prep;
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * @Route("/admin", name="admin.Property.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }


    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request){

        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($admin);
            $this->em->flush();
            $this->addFlash('success', 'Inscris avec succès, à vous de vous connecter');
            return $this->redirectToRoute('home');
        }


        return $this->render('pages/inscription.html.twig', [
            'admin' => $admin,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request){

        $form = $this->createForm(AdminConType::class);
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){

            $userData = $form->getData();
            $user = $this->em->getRepository(Admin::class)->findOneByEmail($userData->getMail());


            if($user)
            {

                if($user->getMdp() == $userData->getMdp())
                {
                    $this->session->set('id', $user->getId());
                    $this->session->set('name', $user->getName());
                    $this->session->set('mail', $user->getMail());
                    $this->session->set('mdp', $user->getMdp());
                    $this->addFlash('success', 'Vous êtes connecté(e)');
                    $properties = $this->prep->findByUser($user->getId());


                    return $this->render('admin/property/index.html.twig', [
                        'admin'=>$user->getId(),
                        'properties'=>$properties

                    ]);
                }

                else $this->addFlash('error', 'Vous n\'êtes pas connecté(e)');



            }
            else
            {
                $this->addFlash('error', 'Vous n\'êtes pas connecté(e)');

            }


        }

        return $this->render('pages/connexion.html.twig', [
            'form' => $form->createView(),

        ]);
    }


    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(Request $request)
    {
        $this->session->set('id', null);
        $this->session->set('name', null);
        $this->session->set('mail', null);
        $this->session->set('mdp', null);
        $this->addFlash('success', 'Vous êtes déconnecté(e)');
        return $this->redirectToRoute('home');
    }



    /**
     * @Route("/modifier/{id}", name="modifier")
     * @param Admin $admin
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function modifier(Request $request, Admin $admin){

        //dd($admin);
        $form = $this->createForm(AdminType::class);
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){

            $userData = $form->getData();
            //dd($userData);
            $user = $this->em->getRepository(Admin::class)->findOneByEmail($userData->getMail());


            if($user)
            {

                $user->setName($userData->getName());
                $user->setMail($userData->getMail());
                $user->setMdp($userData->getMdp());
                $user->setPhone($userData->getPhone());
                //dd($user->getName());

                $this->session->set('id', $user->getId());
                $this->session->set('name', $user->getName());
                $this->session->set('phone', $user->getPhone());
                $this->session->set('mail', $user->getMail());
                $this->session->set('mdp', $user->getMdp());
                $this->addFlash('success', 'Profil édité avec succès');
                $properties = $this->prep->findByUser($user->getId());

                $this->em->flush();
                return $this->render('admin/property/index.html.twig', [
                    'admin'=>$user->getId(),
                    'properties'=>$properties

                ]);






            }
            else
            {
                $this->addFlash('error', 'Vous n\'êtes pas connecté(e)');

            }


        }

        return $this->render('pages/modifier.html.twig', [
            'admin'=>$admin->getId(),
            'form' => $form->createView(),

        ]);
    }
}