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

        // Если книга не найдена, возвращаем JSON-ответ с сообщением об ошибке и статусом ответа HTTP 404 Not Found
        if (!$book) {
            return $this->json(['error' => 'Book not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        // Если в теле запроса есть параметр 'author', обновляем соответствующее поле в объекте Book
        if (isset($data['author'])) {
            $book->setAuthor($data['author']);
        }

        if (isset($data['title'])) {
            $book->setTitle($data['title']);
        }

        // Сохранение изменений в базе данных
        $this->entityManager->flush();

        return $this->json(['message' => 'Book updated successfully']);
    }
}
