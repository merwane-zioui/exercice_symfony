<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComparisonController extends AbstractController
{
    #[Route('/comparison', name: 'app_comparison')]
    public function index(): Response
    {
        return $this->render('comparison/index.html.twig', [
            'controller_name' => 'ComparisonController',
        ]);
    }
}
