<?php

namespace App\DTOs;

class   TaskDTO
{
    public function __construct(
        public ?int $id = null,
        public ?int $assigner = null,
        public ?int $assignee = null,
        public ?string $subject = null,
        public ?string $description = null,
        public ?string $status = null,
        public ?string $priority = null,
        public ?string $due_date = null)
    {}
}
