<?php
namespace App\Service;

use App\Model\CommentModel;

class CommentService
{
    private CommentModel $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function addComment(string $comment, string $email): void
    {
        $this->commentModel->addComment($comment, $email);
    }

    public function getComments(int $limit): ?array
    {
        return $this->commentModel->getComments($limit);
    }

    public function getPaginatedComments(int $page, int $limit = 10): array
    {
        return $this->commentModel->getPaginatedComments($page, $limit);
    }
}

