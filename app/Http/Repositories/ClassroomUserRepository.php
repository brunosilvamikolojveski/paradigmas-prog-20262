<?php

namespace App\Http\Repositories;

use App\Models\Classroom;
use App\Models\User;

class ClassroomUserRepository
{
    public function manage(int $classroomId, int $userId, string $action): array
    {
        $classroom = Classroom::findOrFail($classroomId);
        $user = User::findOrFail($userId);

        if ($action === 'add') {
            $classroom->users()->syncWithoutDetaching([$user->id]);
        } else {
            $classroom->users()->detach($user->id);
        }

        return [
            'classroom_id' => $classroom->id,
            'user_id' => $user->id,
            'action' => $action,
            'enrolled' => $classroom->users()->whereKey($user->id)->exists(),
        ];
    }
}
