<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'controller_name' => 'ProgramController',
        ]);
    }

    /**
     * Show a single program
     *
     * @param int $id
     *
     * @return Response
     *
     * @throws Exception
     */
    #[Route('/show/{id<\d+>}',
        name: 'show',
        requirements: ['id' => '\d+'],
        methods: ['GET'])]
    public function show(int $id): Response
    {
        //TODO: generate 404 error
        if (!is_numeric($id)) {
            throw new Exception('Invalid strength passed '.$id);
        }
        return $this->render('program/show.html.twig', [
            'id' => $id,
        ]);
    }
}
