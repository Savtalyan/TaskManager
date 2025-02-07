<?php

namespace App\Http\Requests\Task;

use App\DTOs\TaskDTO;
use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'assignee' => 'string',
            'assigner' => 'string',
            'status' => 'string',
            'priority' => 'string',
            'subject' => 'string',
            'description' => 'string',
            'due_date' => 'string',
        ];
    }

    public function toDto(): TaskDto
    {
        return new TaskDTO(
            assigner: $this->get('assigner'),
            assignee: $this->get('assignee'),
            subject: $this->get('subject'),
            description: $this->get('description'),
            status: $this->get('status'),
            priority: $this->get('priority'),
            due_date: $this->get('due_date'),
        );
    }
}
