<?php

namespace App\Http\Services;

use App\Http\Repositories\ClassroomUserRepository;

class ClassroomUserService
{
    public function __construct(private ClassroomUserRepository $repository) {}

    public function manage(int $classroomId, int $userId, string $action): array
    {
        return $this->repository->manage($classroomId, $userId, $action);
    }
}
