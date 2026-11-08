<?php

namespace App\Http\Repositories;

use App\Models\Course;

class CourseRepository extends BaseRepository
{
    public function __construct(private Course $model)
    {
        parent::__construct($model);
    }

    public function getWithFilters(array $data)
    {
        $builder = $this->model->query()->with('classrooms');

        if ($name = data_get($data, 'name')) {
            $builder->where('name', 'like', '%' . $name . '%');
        }

        return $this->index($builder);
    }

    public function showWithClassrooms(string $id)
    {
        return $this->model->with('classrooms')->findOrFail($id);
    }
}
