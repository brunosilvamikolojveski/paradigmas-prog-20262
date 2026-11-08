<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\ClassroomUserRequest;
use App\Http\Resources\ClassroomResource;
use App\Http\Services\ClassroomService;
use App\Http\Services\ClassroomUserService;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __construct(private ClassroomService $classroomService, private ClassroomUserService $classroomUserService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ClassroomResource::collection($this->classroomService->getWithFilters($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request)
    {
        return new ClassroomResource($this->classroomService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ClassroomResource($this->classroomService->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRequest $request, string $id)
    {
        return new ClassroomResource($this->classroomService->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->classroomService->destroy($id);

        return response()->noContent();
    }

    public function manageUser(ClassroomUserRequest $request, string $classroom)
    {
        return response()->json($this->classroomUserService->manage(
            (int) $classroom,
            (int) $request->validated('user_id'),
            $request->validated('action'),
        ));
    }
}
