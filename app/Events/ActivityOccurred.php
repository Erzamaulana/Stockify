<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityOccurred
{
    use Dispatchable, SerializesModels;

    public $userId;
    public $action;
    public $description;

    /**
     * Create a new event instance.
     *
     * @param int $userId
     * @param string $action
     * @param string|null $description
     */
    public function __construct(int $userId, string $action, ?string $description = null)
    {
        $this->userId = $userId;
        $this->action = $action;
        $this->description = $description;
    }
}
