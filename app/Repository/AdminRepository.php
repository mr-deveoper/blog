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

use App\Models\User;
use App\Repository\BaseRepository\BaseRepository;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\This;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
