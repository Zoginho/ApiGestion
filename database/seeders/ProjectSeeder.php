<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::where('role', 'project_manager')->first();
        $admin = User::where('role', 'admin')->first();

        // Create sample projects
        Project::create([
            'name' => 'E-commerce Platform',
            'description' => 'Desarrollo de una plataforma de comercio electrónico completa con carrito de compras, pagos y gestión de inventario.',
            'start_date' => '2024-01-01',
            'end_date' => '2024-06-30',
            'status' => 'active',
            'created_by' => $manager->id,
        ]);

        Project::create([
            'name' => 'Mobile App Development',
            'description' => 'Aplicación móvil para gestión de tareas y proyectos con sincronización en tiempo real.',
            'start_date' => '2024-02-01',
            'end_date' => '2024-08-31',
            'status' => 'active',
            'created_by' => $manager->id,
        ]);

        Project::create([
            'name' => 'CRM System',
            'description' => 'Sistema de gestión de relaciones con clientes con módulos de ventas, marketing y soporte.',
            'start_date' => '2024-03-01',
            'end_date' => '2024-09-30',
            'status' => 'on_hold',
            'created_by' => $admin->id,
        ]);

        Project::create([
            'name' => 'Website Redesign',
            'description' => 'Rediseño completo del sitio web corporativo con nuevas funcionalidades y mejor UX/UI.',
            'start_date' => '2024-01-15',
            'end_date' => '2024-04-15',
            'status' => 'completed',
            'created_by' => $manager->id,
        ]);

        Project::create([
            'name' => 'API Integration',
            'description' => 'Integración de APIs de terceros para procesamiento de pagos y envío de notificaciones.',
            'start_date' => '2024-04-01',
            'end_date' => '2024-07-31',
            'status' => 'active',
            'created_by' => $admin->id,
        ]);
    }
}
