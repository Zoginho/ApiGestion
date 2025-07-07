<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    /**
     * Log an activity for this model.
     */
    protected function logActivity(string $eventType, string $description, array $oldValues = null, array $newValues = null): void
    {
        ActivityLog::create([
            'event_type' => $eventType,
            'loggable_type' => get_class($this),
            'loggable_id' => $this->id,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'user_id' => auth()->id(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Boot the trait.
     */
    protected static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            $model->logActivity('created', "Created {$model->getModelName()}: {$model->getLogDescription()}");
        });

        static::updated(function ($model) {
            $changes = $model->getChanges();
            unset($changes['updated_at']);

            if (!empty($changes)) {
                            $model->logActivity(
                    'updated',
                    "Updated {$model->getModelName()}: {$model->getLogDescription()}",
                    $model->getOriginal(),
                    $changes
                );
            }
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted', "Deleted {$model->getModelName()}: {$model->getLogDescription()}");
        });
    }

    /**
     * Get the model name for logging.
     */
    protected function getModelName(): string
    {
        return class_basename($this);
    }

    /**
     * Get the description for logging.
     */
    protected function getLogDescription(): string
    {
        return $this->name ?? $this->title ?? $this->id;
    }
}
