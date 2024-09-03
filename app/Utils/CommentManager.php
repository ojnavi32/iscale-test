<?php

namespace App\Utils;

use App\Model\Comment;

class CommentManager
{
    private static ?CommentManager $instance = null;

    public static function getInstance(): CommentManager
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function lists(): array
    {
        return (new Comment())->all();
    }

    public function deleteByNewsId(int $newsId): bool
    {
        return (new Comment())->deleteByNewsId($newsId);
    }

    /**
     * Add a comment for a specific news item
     *
     * @param string $body
     * @param int $newsId
     * @return string
     */
    public function addCommentForNews(string $body, int $newsId): string
    {
        return (new Comment())->create(['body' => $body, 'news_id' => $newsId]);
    }

    /**
     * Delete a comment by ID
     *
     * @param int $id
     * @return int
     */
    public function deleteComment(int $id): int
    {
        return (new Comment())->delete($id);
    }
}
