<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookGetCollectionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/getcollectionbooks", methods={"GET"})
     */
    public function getCollection(Request $request): Response
    {
        $books = $this->entityManager->getRepository(Book::class)->findAll();

        $data = [];
        foreach ($books as $book) {
            $data[] = [
                'id' => $book->getId(),
                'author' => $book->getAuthor(),
                'title' => $book->getTitle(),
            ];
        }

        return $this->json($data);
    }

}
