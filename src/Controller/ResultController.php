<?php

namespace App\Controller;

use App\Repository\ComparisonRepository;
use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    #[Route('/result/{id}', name: 'app_result_comparison')]
    public function index(ApiService $apiService, int $id, ComparisonRepository $doctrine): Response
    {
        $comparison = $doctrine->find($id)->getPlayer();

        $datas = $apiService->getPlayerAverages($comparison);

        return $this->render('result/index.html.twig', [
            'controller_name' => 'ResultController',
            'averages' => $datas['response'],
            'not_found' => $datas['not_found']
        ]);
    }
}
