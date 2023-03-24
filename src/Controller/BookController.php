<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/addbook", methods={"POST"})
     */
    public function post(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $book = new Book();
        $book->setAuthor($data['author']);
        $book->setTitle($data['title']);

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return $this->json(['id' => $book->getId()]);
    }

    /**
     * @Route("/updatebook/{id}", methods={"PUT"})
     */
    public function put(Request $request, $id): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id ' . $id);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['author'])) {
            $book->setAuthor($data['author']);
        }

        if (isset($data['title'])) {
            $book->setTitle($data['title']);
        }

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return $this->json(['id' => $book->getId()]);
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

    /**
     * @Route("/deletebook/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Book not found');
        }

        $this->entityManager->remove($book);
        $this->entityManager->flush();

        return $this->json(['message' => 'Book deleted']);
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

