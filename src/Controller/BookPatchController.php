<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookPatchController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/patchbook/{id}", methods={"PATCH"})
     */
    public function patch(Request $request, int $id): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);
        if (!$book) {
            return $this->json(['error' => 'Book not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['author'])) {
            $book->setAuthor($data['author']);
        }

        if (isset($data['title'])) {
            $book->setTitle($data['title']);
        }

        $this->entityManager->flush();

        return $this->json(['message' => 'Book updated successfully']);
    }
}
