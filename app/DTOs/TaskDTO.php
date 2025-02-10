<?php

namespace App\DTOs;

class   TaskDTO
{
    public ?int $id = null;
    public ?int $assigner = null;
    public ?int $assignee = null;
    public ?string $subject = null;
    public ?string $description = null;
    public ?string $status = null;
    public ?string $priority = null;
    public ?string $due_date = null;

    public function __construct(
        int $id,
        int $assigner,
        int $assignee,
        string $subject,
        string $description,
        string $status,
        string $priority,
        string $due_date
    )
    {
        $this->id = $id;
        $this->assigner = $assigner;
        $this->assignee = $assignee;
        $this->subject = $subject;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->due_date = $due_date;
    }

    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'assigner' => $this->assigner,
            'assignee' => $this->assignee,
            'subject' => $this->subject,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => $this->due_date
            ];
    }
}
