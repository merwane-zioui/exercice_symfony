<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApiService;
use App\Form\SearchType;

class SearchController extends AbstractController
{

    #[Route('/search', name: 'app_search')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            return $this->redirectToRoute('app_result', [
                'name'=>$data['name'],
                'page'=>1
            ]);
        }

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/search/{name}/{page}', name: 'app_result')]
    public function searchResult(ApiService $apiService, String $name, int $page, Request $request): Response
    {
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            return $this->redirectToRoute('app_result', [
                'name'=>$data['name'],
                'page'=>1
            ]);
        }

        $results = $apiService->getPlayersByName($name, $page);
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'results' => $results,
            'form' => $form->createView()
        ]);
    }
}
