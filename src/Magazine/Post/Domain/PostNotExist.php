<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain;

use App\Shared\Domain\DomainError;

final class PostNotExist extends DomainError
{
    public function __construct(private string $id)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'post_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The post <%s> does not exist', $this->id);
    }
}
