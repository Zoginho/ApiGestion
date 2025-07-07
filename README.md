# API de Gestión de Proyectos

Una API RESTful completa para el sistema de gestión de proyectos desarrollada con Laravel 12, que incluye autenticación, autorización basada en roles, y documentación automática con Swagger/OpenAPI.

## 🚀 Características

- **Autenticación**: Laravel Sanctum para autenticación API
- **Autorización**: Sistema de roles (Admin, Project Manager, Developer)
- **Entidades principales**:
  - Users (usuarios con roles)
  - Projects (proyectos con fechas y estados)
  - Tasks (tareas asignables a usuarios)
  - Activity Logs (registro automático de eventos)
- **Documentación**: Swagger/OpenAPI automática
- **Arquitectura**: Patrón Repository + Service Layer
- **Validación**: Request classes personalizadas
- **Respuestas**: Resource classes para formateo JSON consistente

## 📋 Requisitos

- PHP >= 8.2
- Laravel >= 12.0
- MySQL >= 8.0
- Composer
- Node.js (para desarrollo frontend)

## 🛠️ Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <repository-url>
   cd ApiGestion
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   npm install
   ```

3. **Configurar variables de entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar base de datos**
   Editar `.env` con las credenciales de tu base de datos:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=api_gestion
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Generar documentación Swagger**
   ```bash
   php artisan l5-swagger:generate
   ```

7. **Iniciar servidor de desarrollo**
   ```bash
   php artisan serve
   ```

## 📚 Estructura del Proyecto

```
ApiGestion/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/           # Controllers de la API
│   │   ├── Middleware/        # Middlewares personalizados
│   │   ├── Requests/          # Request classes para validación
│   │   └── Resources/         # Resource classes para respuestas JSON
│   ├── Models/                # Modelos Eloquent
│   ├── Repositories/          # Patrón Repository
│   ├── Services/              # Capa de servicios
│   └── Traits/                # Traits reutilizables
├── database/
│   ├── migrations/            # Migraciones de base de datos
│   └── seeders/               # Seeders para datos de prueba
├── routes/
│   └── api.php               # Rutas de la API
└── config/
    └── l5-swagger.php        # Configuración de Swagger
```

## 🔐 Autenticación y Autorización

### Roles de Usuario
- **Admin**: Acceso completo a todas las funcionalidades
- **Project Manager**: Gestión de proyectos y tareas
- **Developer**: Visualización y actualización de tareas asignadas

### Endpoints de Autenticación
- `POST /api/auth/register` - Registro de usuarios
- `POST /api/auth/login` - Inicio de sesión
- `POST /api/auth/logout` - Cierre de sesión
- `GET /api/auth/me` - Obtener usuario autenticado

## 📖 Endpoints de la API

### Proyectos
- `GET /api/projects` - Listar todos los proyectos
- `POST /api/projects` - Crear nuevo proyecto
- `GET /api/projects/{id}` - Obtener proyecto específico
- `PUT /api/projects/{id}` - Actualizar proyecto
- `DELETE /api/projects/{id}` - Eliminar proyecto
- `GET /api/projects/active` - Proyectos activos
- `GET /api/projects/completed` - Proyectos completados

### Tareas
- `GET /api/tasks` - Listar todas las tareas
- `POST /api/tasks` - Crear nueva tarea
- `GET /api/tasks/{id}` - Obtener tarea específica
- `PUT /api/tasks/{id}` - Actualizar tarea
- `DELETE /api/tasks/{id}` - Eliminar tarea
- `GET /api/tasks/assigned` - Tareas asignadas al usuario
- `GET /api/tasks/pending` - Tareas pendientes
- `GET /api/tasks/high-priority` - Tareas de alta prioridad
- `GET /api/tasks/project/{projectId}` - Tareas por proyecto

### Logs de Actividad
- `GET /api/activity-logs` - Listar logs de actividad
- `GET /api/activity-logs/recent` - Logs recientes
- `GET /api/activity-logs/{id}` - Obtener log específico
- `GET /api/activity-logs/by-user/{userId}` - Logs por usuario
- `GET /api/activity-logs/by-event/{eventType}` - Logs por tipo de evento

## 📖 Documentación de la API

La documentación completa de la API está disponible en:
- **Swagger UI**: `http://localhost:8000/api/documentation`
- **JSON Schema**: `http://localhost:8000/docs/api-docs.json`

## 🧪 Datos de Prueba

El sistema incluye datos de prueba con los siguientes usuarios:

### Usuarios de Prueba
- **Admin**: `admin@example.com` / `password`
- **Project Manager**: `manager@example.com` / `password`
- **Developer 1**: `dev1@example.com` / `password`
- **Developer 2**: `dev2@example.com` / `password`
- **Developer 3**: `dev3@example.com` / `password`

### Proyectos de Ejemplo
- E-commerce Platform
- Mobile App Development
- CRM System
- Website Redesign
- API Integration

## 🔧 Configuración Avanzada

### Middleware de Roles
```php
// En routes/api.php
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    // Rutas solo para administradores
});
```

### Logging de Actividades
El sistema registra automáticamente todas las operaciones CRUD en la tabla `activity_logs` usando el trait `LogsActivity`.

### Paginación
Todos los endpoints de listado soportan paginación:
```
GET /api/projects?page=1&per_page=15
```

## 🚀 Despliegue

### Producción
1. Configurar variables de entorno para producción
2. Ejecutar `composer install --optimize-autoloader --no-dev`
3. Ejecutar `php artisan config:cache`
4. Ejecutar `php artisan route:cache`
5. Configurar servidor web (Apache/Nginx)


## 📊 Monitoreo y Logs

### Logs de Aplicación
- Ubicación: `storage/logs/laravel.log`
- Configuración: `config/logging.php`

### Métricas Recomendadas
- Tiempo de respuesta de endpoints
- Uso de memoria y CPU
- Errores de base de datos
- Actividad de usuarios

## 🔒 Seguridad

### Implementado
- Autenticación con Laravel Sanctum
- Validación de entrada con Request classes
- Autorización basada en roles
- Logging de actividades
- Protección CSRF (para web)

### Recomendaciones Adicionales
- Rate limiting
- Validación de IPs
- Auditoría de seguridad
- Backup automático de base de datos

## 🧪 Testing

```bash
# Ejecutar tests
php artisan test

# Tests con coverage
php artisan test --coverage
```

## 📈 Escalabilidad

### Estrategias Implementadas
- Separación de capas (Repository, Service, Controller)
- Paginación en todos los listados
- Índices en base de datos
- Caching de consultas frecuentes

### Futuras Mejoras
- Implementación de Redis para cache
- Microservicios por bounded contexts
- API Gateway
- Load balancing

## 🤝 Contribución

1. Fork el proyecto
2. Crear rama feature (`git checkout -b feature/AmazingFeature`)
3. Commit cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir Pull Request


## 📞 Soporte

- **Email**: angeeldominguez20@gmail.com
- **Documentación**: [Swagger UI](http://localhost:8000/api/documentation)


## 🎯 Roadmap

- [ ] Implementación de notificaciones en tiempo real
- [ ] Dashboard con métricas
- [ ] Exportación de reportes
- [ ] Integración con herramientas externas
- [ ] API GraphQL
- [ ] Mobile app nativa

---

**Desarrollado con ❤️ usando Laravel 12**
