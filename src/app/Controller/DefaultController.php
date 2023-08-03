<?php

namespace App\Controller;

use App\Service\CommentService;

class DefaultController
{
    private CommentService $commentService;

    public function __construct()
    {
        $this->commentService = new CommentService();
    }

    public function getIndex(): array
    {
        $page = $_GET['page'] ?? 1;

        $data = $this->commentService->getPaginatedComments($page);
        $data['currentPage'] = $page;

        return $data;
    }
}

