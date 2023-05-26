<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{

    /**
     * List all categories order by DESC and limit 3
     *
     * @param CategoryRepository $categoryRepository
     * 
     * @return Response
     */
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(
        string $categoryName,
        CategoryRepository $categoryRepository,
        ProgramRepository $programRepository
    ): Response
    {
        $category = $categoryRepository->findOneByName($categoryName);

        if (null === $category) {
            throw $this->createNotFoundException('No category');
        }

        $programs = $programRepository->findByCategory($category, ['id' => 'DESC'], 2);

        return $this->render('category/show.html.twig', [
            'programs' => $programs
        ]);
    }
}