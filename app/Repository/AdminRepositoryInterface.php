<?php
declare(strict_types=1);


namespace App\Repository;


use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
}
