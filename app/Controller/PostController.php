<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Comment;
use App\Model\Post;

class PostController extends AbstractController
{
    public function createAction()
    {
        if (!$this->isPost() || !$this->auth->isLoggedIn()) {
            header('Location: /');
            return;
        }

        $postContent = $_POST['new_post'] ?? '';

        if (!$postContent) {
            // set error message
            header('Location: /');
            return;
        }

        Post::insert([
            'content' => $postContent,
            'user_id' => $this->auth->getCurrentUser()->getId()
        ]);

        header('Location: /');
    }

    public function deleteAction()
    {
        $postId = $_GET['id'] ?? null;
        if (!$postId || !$this->auth->isLoggedIn()) {
            header('Location: /');
            return;
        }

        $post = Post::getOne('id', $postId);

        if ($post->getUserId() == $this->auth->getCurrentUser()->getId()) {
            Post::delete('id', $postId);
        }

        header('Location: /');
    }

    public function createCommentAction()
    {
        header('Content-Type: application/json');

        if (!$this->isPost() || !$this->auth->isLoggedIn()) {
            http_response_code(400);
            return '';
        }

        $postId = $_POST['postId'] ?? null;
        $commentContent = $_POST['commentContent'] ?? null;

        if (!$postId || !$commentContent) {
            http_response_code(400);
            return '';
        }

        $commentId = Comment::insert([
            'user_id' => $this->auth->getCurrentUser()->getId(),
            'post_id' => $postId,
            'content' => $commentContent
        ]);

        if (!$commentId) {
            http_response_code(400);
            return '';
        }

        $comment = Comment::getOne('id', $commentId);

        return json_encode([
            'comment_id' => $comment->getId(),
            'post_id' => $comment->getPostId(),
            'content' => $comment->getContent(),
            'date' => $comment->getDate()
        ]);
    }
}
