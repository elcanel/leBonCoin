<?php
namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    private $session;

    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository, SessionInterface $session): Response
    {
        $this->session = $session;
        $properties = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
       'properties' => $properties,
            'admin' => $this->session->get('id')
    ]);
    }

}