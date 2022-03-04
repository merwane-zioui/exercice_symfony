<?php

namespace App\Controller;

use App\Repository\ComparisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comparison;

class HistoryController extends AbstractController
{
    #[Route('/history', name: 'app_history')]
    public function index(ComparisonRepository $doctrine): Response
    {
        $history = $doctrine->findAll();

        return $this->render('history/index.html.twig', [
            'controller_name' => 'HistoryController',
            'history' => $history
        ]);
    }
}
