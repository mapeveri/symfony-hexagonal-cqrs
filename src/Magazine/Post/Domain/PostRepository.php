<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain;

use App\Magazine\Post\Domain\ValueObjects\PostId;

interface PostRepository
{
    public function getAll(): array;

    public function find(PostId $id): ?Post;

    public function save(Post $post): void;

    public function delete(Post $post): void;
}
