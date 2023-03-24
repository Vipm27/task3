<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/getbook/{id}", methods={"GET"})
     */
    public function getItem(int $id): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Book not found');
        }

        $data = [
            'id' => $book->getId(),
            'author' => $book->getAuthor(),
            'title' => $book->getTitle(),
        ];

        return $this->json($data);
    }

}

