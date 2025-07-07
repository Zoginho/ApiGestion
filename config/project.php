<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Project Management Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for the project management
    | system including pagination, roles, and other settings.
    |
    */

    'pagination' => [
        'default_per_page' => 15,
        'max_per_page' => 100,
    ],

    'roles' => [
        'admin' => 'admin',
        'project_manager' => 'project_manager',
        'developer' => 'developer',
    ],

    'project_statuses' => [
        'active' => 'active',
        'completed' => 'completed',
        'on_hold' => 'on_hold',
        'cancelled' => 'cancelled',
    ],

    'task_priorities' => [
        'low' => 'low',
        'medium' => 'medium',
        'high' => 'high',
        'urgent' => 'urgent',
    ],

    'task_statuses' => [
        'pending' => 'pending',
        'in_progress' => 'in_progress',
        'completed' => 'completed',
        'cancelled' => 'cancelled',
    ],

    'activity_log' => [
        'enabled' => env('ACTIVITY_LOG_ENABLED', true),
        'retention_days' => env('ACTIVITY_LOG_RETENTION_DAYS', 365),
    ],

    'api' => [
        'version' => '1.0.0',
        'rate_limit' => env('API_RATE_LIMIT', 60),
        'rate_limit_window' => env('API_RATE_LIMIT_WINDOW', 60),
    ],
];
