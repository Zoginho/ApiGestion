<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ecommerceProject = Project::where('name', 'E-commerce Platform')->first();
        $mobileProject = Project::where('name', 'Mobile App Development')->first();
        $crmProject = Project::where('name', 'CRM System')->first();
        $websiteProject = Project::where('name', 'Website Redesign')->first();
        $apiProject = Project::where('name', 'API Integration')->first();

        $manager = User::where('role', 'project_manager')->first();
        $dev1 = User::where('email', 'dev1@example.com')->first();
        $dev2 = User::where('email', 'dev2@example.com')->first();
        $dev3 = User::where('email', 'dev3@example.com')->first();

        // E-commerce Platform Tasks
        Task::create([
            'title' => 'Diseñar base de datos',
            'description' => 'Crear el esquema de base de datos para productos, usuarios, pedidos y pagos.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => '2024-01-15',
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $dev1->id,
            'created_by' => $manager->id,
        ]);

        Task::create([
            'title' => 'Implementar autenticación',
            'description' => 'Sistema de login/registro con JWT tokens y validación de roles.',
            'priority' => 'high',
            'status' => 'in_progress',
            'due_date' => '2024-01-30',
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $dev2->id,
            'created_by' => $manager->id,
        ]);

        Task::create([
            'title' => 'Desarrollar carrito de compras',
            'description' => 'Funcionalidad completa del carrito con persistencia y cálculos de totales.',
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => '2024-02-15',
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $dev3->id,
            'created_by' => $manager->id,
        ]);

        // Mobile App Tasks
        Task::create([
            'title' => 'Configurar React Native',
            'description' => 'Configuración inicial del proyecto React Native con navegación y estado global.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => '2024-02-10',
            'project_id' => $mobileProject->id,
            'assigned_to' => $dev1->id,
            'created_by' => $manager->id,
        ]);

        Task::create([
            'title' => 'Implementar sincronización offline',
            'description' => 'Sistema de sincronización de datos cuando no hay conexión a internet.',
            'priority' => 'urgent',
            'status' => 'in_progress',
            'due_date' => '2024-03-01',
            'project_id' => $mobileProject->id,
            'assigned_to' => $dev2->id,
            'created_by' => $manager->id,
        ]);

        // CRM System Tasks
        Task::create([
            'title' => 'Diseñar módulo de ventas',
            'description' => 'Interfaz y lógica para gestión de oportunidades de venta y pipeline.',
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => '2024-04-15',
            'project_id' => $crmProject->id,
            'assigned_to' => $dev3->id,
            'created_by' => $manager->id,
        ]);

        // Website Redesign Tasks
        Task::create([
            'title' => 'Crear wireframes',
            'description' => 'Diseño de wireframes para todas las páginas del sitio web.',
            'priority' => 'low',
            'status' => 'completed',
            'due_date' => '2024-01-25',
            'project_id' => $websiteProject->id,
            'assigned_to' => $dev1->id,
            'created_by' => $manager->id,
        ]);

        Task::create([
            'title' => 'Implementar responsive design',
            'description' => 'Asegurar que el sitio web funcione correctamente en todos los dispositivos.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => '2024-03-15',
            'project_id' => $websiteProject->id,
            'assigned_to' => $dev2->id,
            'created_by' => $manager->id,
        ]);

        // API Integration Tasks
        Task::create([
            'title' => 'Integrar Stripe API',
            'description' => 'Implementar procesamiento de pagos con Stripe incluyendo webhooks.',
            'priority' => 'urgent',
            'status' => 'in_progress',
            'due_date' => '2024-05-01',
            'project_id' => $apiProject->id,
            'assigned_to' => $dev1->id,
            'created_by' => $manager->id,
        ]);

        Task::create([
            'title' => 'Configurar SendGrid',
            'description' => 'Integración de SendGrid para envío de emails transaccionales.',
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => '2024-05-15',
            'project_id' => $apiProject->id,
            'assigned_to' => $dev3->id,
            'created_by' => $manager->id,
        ]);
    }
}
