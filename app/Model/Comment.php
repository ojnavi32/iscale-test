<?php

namespace App\Model;
use App\Core\Model;

class Comment extends Model
{
	private $table = 'comment';

	public function all()
	{
		return $this->model->select('SELECT * FROM `' . $this->table . '`');
	}

	public function create(array $payload): string
	{
		$this->model->exec(
			'INSERT INTO `' . $this->table . '` (`body`, `created_at`, `news_id`) VALUES (:body, :created_at, :news_id)',
			[
				':body' => $payload['body'],
				':created_at' => date('Y-m-d'),
				':news_id' => $payload['news_id'],
			]
		);

		return $this->model->lastInsertId();
	}

	public function delete(int $id): bool
	{
		return $this->model->exec('DELETE FROM `' . $this->table . '` WHERE `id` = :id', [':id' => $id]);
	}

	public function deleteByNewsId(int $newsId): bool
	{
		return $this->model->exec('DELETE FROM `' . $this->table . '` WHERE `news_id` = :news_id', [':news_id' => $newsId]);
	}
}