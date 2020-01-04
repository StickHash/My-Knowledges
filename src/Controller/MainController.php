<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\KnowledgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MainController extends AbstractController
{
    private $encoders = [];
    private $normalizers = [];
    private $serializer;

    public function __construct()
    {
        $this->encoders = [new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }

    /**
     * @Route("/categories", name="categories")
     * @param CategoryRepository $categoryRepository
     * @return JsonResponse
     */
    public function showCategories(CategoryRepository $categoryRepository)
    {

        $categories = $categoryRepository->findAll();

        return $this->json($this->serializer->serialize($categories, 'json', ['attributes' => ['id', 'name']]));
    }

    /**
     * @Route("/all", name="all")
     * @param KnowledgeRepository $knowledgeRepository
     * @return JsonResponse
     */
    public function all(KnowledgeRepository $knowledgeRepository)
    {
        $knowledges = $knowledgeRepository->findAll();

        return $this->json($this->serializer->serialize($knowledges, 'json', ['attributes' => ['name', 'imgUrl', 'category' => ['name']]]));
    }

    /**
     * @Route("/knowledge/{id}", name="knowledge")
     * @param Category $category
     * @return JsonResponse
     */
    public function knowledgeByCategory(Category $category)
    {

        $knowledges = $category->getKnowledges();

        return $this->json($this->serializer->serialize($knowledges, 'json', ['attributes' => ['name', 'category' => ['name']]]));
    }
}
