<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $courseId = $this->route('course');

        return [
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:courses,name,' . $courseId],
            'description' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
