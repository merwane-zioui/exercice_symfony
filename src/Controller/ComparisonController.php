<?php

namespace App\Controller;

use App\Entity\Comparison;
use App\Repository\ComparisonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApiService;

class ComparisonController extends AbstractController
{
    #[Route('/comparison', name: 'app_comparison')]
    public function index(Request $request, ApiService $apiService): Response
    {
        $sessionComparisons = $request->getSession()
            ->get('comparisons');

        return $this->render('comparison/index.html.twig', [
            'controller_name' => 'ComparisonController',
        ]);
    }

    #[Route('/comparison/create', name: 'app_comparison_create')]
    public function createComparisonAction(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $sessionComparisons = $request->getSession();

        $comparisons = $sessionComparisons->get('comparisons');

        $comparison = new Comparison();
        $comparison->setDate(new \DateTime());
        $comparison->setPlayer($comparisons);

        $entityManager->persist($comparison);

        $entityManager->flush();

        $sessionComparisons->remove('comparisons');

        return $this->redirectToRoute('app_result_comparison', [
            'id'=>$comparison->getId()
        ]);
    }

    #[Route('/comparison/add/{id}', name: 'app_comparison_add')]
    public function addComparisonAction(Request $request, int $id): Response
    {
        $sessionComparisons = $request->getSession();

        $comparisons = $sessionComparisons->get('comparisons');

        if($comparisons==null) {
            $comparisons = [];
        }

        if(!in_array($id, $comparisons)) {
            $comparisons[] = $id;
            $sessionComparisons->set('comparisons', $comparisons);
        }

        return $this->redirectToRoute('app_comparison', [
        ]);
    }

    #[Route('/comparison/remove/{id}', name: 'app_comparison_remove')]
    public function removeComparisonAction(Request $request, int $id): Response
    {
        $sessionComparisons = $request->getSession();

        $comparisons = $sessionComparisons->get('comparisons');

        if (($key = array_search($id, $comparisons)) !== false) {
            unset($comparisons[$key]);
            $sessionComparisons->set('comparisons', $comparisons);
        }

        return $this->redirectToRoute('app_comparison', [
        ]);
    }

    #[Route('/addToComparator/{playerid}')]
    public function addComparisonAjax(Request $request, $playerid)
    {
        $sessionComparisons = $request->getSession();
        $comparisons = $sessionComparisons->get('comparisons');
        $response = new Response();
        if($comparisons==null) {
            $comparisons = [];
        }

        if(!in_array($playerid, $comparisons)) {
            $comparisons[] = $playerid;
            $sessionComparisons->set('comparisons', $comparisons);
            return $response->setStatusCode(Response::HTTP_OK);
        }

        else {
            return $response->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
        }

    }

    #[Route('/removeFromComparator/{playerid}')]
    public function removeComparisonAjax(Request $request, $playerid)
    {
        $sessionComparisons = $request->getSession();
        $comparisons = $sessionComparisons->get('comparisons');
        $response = new Response();

        if (($key = array_search($playerid, $comparisons)) !== false) {
            unset($comparisons[$key]);
            $sessionComparisons->set('comparisons', $comparisons);
            return $response->setStatusCode(Response::HTTP_OK);
        }

        else {
            return $response->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
        }

    }

}
