<?php

namespace App\Controller;

use App\Entity\Lodging;
use App\Form\LodgingType;
use App\Repository\LodgingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/home')]
final class HomeController extends AbstractController
{
    #[Route(name: 'app_home_index', methods: ['GET'])]
    public function index(LodgingRepository $lodgingRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'lodgings' => $lodgingRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_home_show', methods: ['GET'])]
    public function show(Lodging $lodging): Response
    {
        return $this->render('lodging/show.html.twig', [
            'lodging' => $lodging,
        ]);
    }

}
