<?php

namespace App\Utils;

use App\Model\News;

class NewsManager
{
	private $commentManager;

	public function __construct()
	{
		$this->commentManager = new CommentManager();
	}

    /**
     * List all news
     *
     * @return News[]
     */
    public function lists(): array
    {
		return (new News())->all();
    }

	public function newsWithComments(): array
	{
		$news = $this->lists();
		$comments = $this->commentManager->lists();
		
		$commentMap = [];
		foreach ($comments as $comment) {
			$commentMap[$comment['news_id']][] = $comment['body'];
		}

		$data = array_map(function($item) use ($commentMap) {
			return [
				'title'    => $item['title'],
				'body'     => $item['body'],
				'comments' => $commentMap[$item['id']] ?? [],
			];
		}, $news);

		return $data;
	}

    /**
     * Add a record to the news table
     *
     * @param string $title
     * @param string $body
     * @return string
     */
    public function addNews(string $title, string $body): string
    {
		return (new News())->create(['title' => $title, 'body' => $body]);
    }

    /**
     * Delete a news record and its linked comments
     *
     * @param int $id
     * @return int
     */
    public function deleteNews(int $id): bool
    {
		(new News())->delete($id);

		$this->commentManager->deleteByNewsId($id);

		return true;
    }
}
