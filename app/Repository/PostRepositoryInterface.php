<?php
declare(strict_types=1);


namespace App\Repository;


use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function getDataWithPagination(): LengthAwarePaginator;
}
