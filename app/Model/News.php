<?php

namespace App\Model;
use App\Core\Model;

class News extends Model
{
	private $table = 'news';

	public function all()
	{
		return $this->model->select('SELECT * FROM `' . $this->table . '`');
	}

	public function create(array $payload): string
	{
		$this->model->exec(
			'INSERT INTO `' . $this->table . '` (`title`, `body`, `created_at`) VALUES (:title, :body, :created_at)',
			[
				':title' => $payload['title'],
				':body' => $payload['body'],
				':created_at' => date('Y-m-d'),
			]
		);

		return $this->model->lastInsertId();
	}

	public function delete(int $id): bool
	{
		return $this->model->exec('DELETE FROM `' . $this->table . '` WHERE `id` = :id', [':id' => $id]);
	}
}