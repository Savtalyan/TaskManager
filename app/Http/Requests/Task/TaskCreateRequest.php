<?php

namespace App\Http\Requests\Task;

use App\DTOs\TaskDTO;
use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
            'assignee' => 'required|exists:users,id',
            'assigner' => 'required|exists:users,id',
            'priority' => 'required|string',
            'subject' => 'required|string',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ];
    }

    public function toDTO() : TaskDTO
    {
        return new TaskDTO(
            assigner: $this->get('assigner'),
            assignee: $this->get('assignee'),
            subject: $this->get('subject'),
            description: $this->get('description'),
            priority: $this->get('priority'),
            due_date: $this->get('due_date'),
        );
    }
}
