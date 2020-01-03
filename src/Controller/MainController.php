<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\KnowledgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MainController extends AbstractController
{
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
     */
    public function showCategories(CategoryRepository $categoryRepository)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $categories = $categoryRepository->findAll();

        return $this->json($serializer->serialize($categories, 'json', ['attributes' => ['id', 'name']]));
    }

    /**
     * @Route("/all", name="all")
     */
    public function all(KnowledgeRepository $knowledgeRepository)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];


        $serializer = new Serializer($normalizers, $encoders);

        $knowledges = $knowledgeRepository->findAll();

        return $this->json($serializer->serialize($knowledges, 'json', ['attributes' => ['name', 'imgUrl', 'category' => ['name']]]));
    }

    /**
     * @Route("/knowledge/{id}", name="knowledge")
     */
    public function knowledgeByCategory(Category $category)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];


        $serializer = new Serializer($normalizers, $encoders);

        $knowledges = $category->getKnowledges();

        return $this->json($serializer->serialize($knowledges, 'json', ['attributes' => ['name', 'category' => ['name']]]));
    }
}
