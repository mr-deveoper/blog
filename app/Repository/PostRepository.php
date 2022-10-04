<?php
/*
 * Created by VSCode.
 * Developer: Ahmed Ali ( ahmed@rowaad.net)
 * Date: 9/15/20, 8:23 PM
 * Last Modified: 9/15/20, 8:23 PM
 * Project Name: Safa
 * File Name: CategoryRepository.php
 */

declare(strict_types=1);

namespace App\Repository;

use App\Models\Post;
use App\Repository\BaseRepository\BaseRepository;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * PostRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getDataWithPagination(?string $sort = null, ?int $userId = null): LengthAwarePaginator
    {
        return $this->model
            ->with(['user'])
            ->when($userId, function ($q, $userId) {
                return $q->where('user_id', $userId);
            })
            ->when($sort, function ($q, $sort) {
                return $q->orderBy('publication_date', $sort);
            })
            ->paginate()
            ->withQueryString();
    }
}
