<?php
declare(strict_types=1);

namespace App\Repository\BaseRepository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
     public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return Collection
     */

    public function getData(): Collection
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id): void
    {
        $this->model->find($id)->delete();
    }

    /**
     * @return Int
     */
    public function count(): int
    {
        return (int) $this->model->count();
    }

    /**
     * @param $id
     * @param $request
     * @return void
     */
    public function update(int $id, Request $request)
    {
        $this->model->find($id)->update($request->all());
    }
}
