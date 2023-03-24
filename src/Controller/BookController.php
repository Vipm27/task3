<?php

// Определяем пространство имен для класса контроллера
namespace App\Controller;

// Импортируем необходимые классы
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Определяем класс контроллера
class MovieController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/getmovie/{id}", methods={"GET"})
     */
    // Определяем метод контроллера для получения данных о книге по её ID
    public function getItem(int $id): Response
    {
        $book = $this->entityManager->getRepository(Movie::class)->find($id);


        if (!$book) {
            throw $this->createNotFoundException('Movie not found');
        }

        $data = [
            'id' => $book->getId(),
            'author' => $book->getAuthor(),
            'title' => $book->getTitle(),
        ];

        return $this->json($data);
    }
}

