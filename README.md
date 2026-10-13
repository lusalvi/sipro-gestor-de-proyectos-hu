<p align="center">
  <img src="/resources/docs/banner.png" alt="SiPro Banner">
</p>

# SiPro — Sistema de Gestión de Proyectos del Hospital Universitario

**SiPro** es una herramienta de gestión de proyectos adaptada para el área de informática del **Hospital Universitario de la Universidad Nacional de Cuyo (Mendoza, Argentina)**.
 
Está basada en [LaraCollab](https://github.com/vstruhar/lara-collab), un proyecto open-source de gestión de proyectos construido con Laravel y React, desarrollado originalmente por [Vladimír Struhar](https://github.com/vstruhar) y otros colaboradores. Todo el crédito por la base original les pertenece a ellos.
 
Este fork adapta y amplía LaraCollab para las necesidades específicas del HU: eliminando los módulos comerciales (facturación, clientes, reportes de ganancia) que no aplican en un contexto institucional, incorporando una estructura organizacional por **áreas**, y sumando funcionalidades nuevas desarrolladas por el equipo de informática del hospital.

---
 
## Diferencias respecto al proyecto original
 
### Lo que se eliminó
 
- Módulo de facturación e invoices
- Gestión de empresas cliente y sus reportes
- Campos de precio fijo por tarea
- Reportes de tiempo facturado y ganancia por usuario
### Lo que se adaptó
 
| Original | SiPro |
|---|---|
| `ClientCompany` (empresa cliente) | `Area` (área del hospital) |
| Roles orientados a clientes/freelance | Roles institucionales con aislamiento por área |
| Interfaz en inglés | Interfaz traducida al español |
 
### Lo que se agregó
 
- **Áreas organizacionales**: agrupan usuarios y proyectos bajo una unidad del hospital. Los administradores de área solo acceden a sus propios recursos.
- **Jerarquía de roles** con tres niveles: superadmin (acceso total), admin de área, y usuario regular.
- **Tipos de issue / árbol de tareas**: Épica → Historia / Tarea → Subtarea, con jerarquía padre-hijo y reglas de anidamiento.
- **Cronograma Gantt** por proyecto, con navegación por semana, mes y trimestre; edición de fechas y asignación directa desde la vista.
- **Vista lista** de tareas con columnas redimensionables, edición inline y drag & drop para reordenar.
- **Agenda personal**: planificador por día, navegación entre fechas, recordatorios con notificación y soporte de rangos horarios.
- **Diseño responsive** en toda la aplicación.
- **Prioridades de tarea** configurables (etiqueta, color, orden).
- **Colores en grupos de tareas**.
---
 
## Capturas de pantalla

<p align="center">
  <img src="/resources/docs/screenshots/1-dashboard-light.png" width="45%" alt="Dashboard Light">
  <img src="/resources/docs/screenshots/1-dashboard-dark.png" width="45%" alt="Dashboard Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/2-projects-light.png" width="45%" alt="Projects Light">
  <img src="/resources/docs/screenshots/2-projects-dark.png" width="45%" alt="Projects Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/3-personal-tasks-light.png" width="45%" alt="Personal Tasks Light">
  <img src="/resources/docs/screenshots/3-personal-tasks-dark.png" width="45%" alt="Personal Tasks Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/11-add-task-light.png" width="45%" alt="Add Task Light">
  <img src="/resources/docs/screenshots/11-add-task-dark.png" width="45%" alt="Add Task Dark">
</p>


<p align="center">
  <img src="/resources/docs/screenshots/12-list-tasks-light.png" width="45%" alt="Task List Light">
  <img src="/resources/docs/screenshots/12-list-tasks-dark.png" width="45%" alt="Task List Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/13-kanban-light.png" width="45%" alt="Tasks Kanban Light">
  <img src="/resources/docs/screenshots/13-kanban-dark.png" width="45%" alt="Tasks Kanban Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/14-calendar-light.png" width="45%" alt="Calendar Light">
  <img src="/resources/docs/screenshots/14-calendar-dark.png" width="45%" alt="Calendar Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/15-schedule-light.png" width="45%" alt="Schedule Light">
  <img src="/resources/docs/screenshots/15-schedule-dark.png" width="45%" alt="Schedule Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/4-my-work-light.png" width="45%" alt="My Work Light">
  <img src="/resources/docs/screenshots/4-my-work-dark.png" width="45%" alt="My Work Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/5-areas-light.png" width="45%" alt="Areas Light">
  <img src="/resources/docs/screenshots/5-areas-dark.png" width="45%" alt="Areas Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/6-users-light.png" width="45%" alt="Users Light">
  <img src="/resources/docs/screenshots/6-users-dark.png" width="45%" alt="Users Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/7-roles-light.png" width="45%" alt="Roles Light">
  <img src="/resources/docs/screenshots/7-roles-dark.png" width="45%" alt="Roles Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/8-labels-light.png" width="45%" alt="Labels Light">
  <img src="/resources/docs/screenshots/8-labels-dark.png" width="45%" alt="Labels Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/9-profile-light.png" width="45%" alt="Profile Light">
  <img src="/resources/docs/screenshots/9-profile-dark.png" width="45%" alt="Profile Dark">
</p>

<p align="center">
  <img src="/resources/docs/screenshots/10-notifications-light.png" width="45%" alt="Notifications Light">
  <img src="/resources/docs/screenshots/10-notifications-dark.png" width="45%" alt="Notifications Dark">
</p>

## Stack tecnológico
 
| Capa | Tecnología |
|---|---|
| Backend | [Laravel 11](https://laravel.com) (PHP 8.2+) |
| Frontend | [React 18](https://react.dev) + [Inertia.js](https://inertiajs.com) |
| UI Components | [Mantine 7](https://mantine.dev) + [Tabler Icons](https://tabler.io/icons) |
| Editor de texto enriquecido | [Tiptap 2](https://tiptap.dev) |
| Drag & Drop | [@dnd-kit](https://dndkit.com) + [@hello-pangea/dnd](https://github.com/hello-pangea/dnd) |
| Calendario | [FullCalendar 6](https://fullcalendar.io) |
| Tiempo real | WebSockets via [Pusher](https://pusher.com) / alternativa open-source |
| Permisos | [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) |
| Auditoría | [owen-it/laravel-auditing](https://laravel-auditing.com) |
| Archivado | [joelbutcher/laravel-archivable](https://github.com/joelbutcher/laravel-archivable) |
| Procesado de imágenes | [Intervention Image 3](https://image.intervention.io) |
| Build / bundler | [Vite 5](https://vitejs.dev) |
| Estado global (JS) | [Zustand](https://zustand-demo.pmnd.rs) |
| Base de datos | MySQL 8 (también compatible con PostgreSQL, SQLite, SQL Server) |
| Contenedor (dev) | [Laravel Sail](https://laravel.com/docs/sail) + Docker |
 
---
 
## Requisitos previos
 
- PHP **8.2** o superior
- Composer
- Node.js y npm
- Base de datos MySQL 8 (recomendada) o compatible
---


---
 
## Instalación
 
### 1. Clonar el repositorio
 
```bash
git clone https://github.com/lusalvi/sipro-gestor-de-proyectos-hu.git
cd sipro-gestor-de-proyectos-hu
```
 
### 2. Instalar dependencias
 
```bash
composer install
npm install
```
 
### 3. Configurar el entorno
 
```bash
cp .env.example .env
php artisan key:generate
```
 
Editar `.env` con los datos de la base de datos (variables con prefijo `DB_`) y el nombre de la aplicación:
 
```env
APP_NAME=SiPro
APP_URL=http://localhost
 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sipro
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
 
ADMIN_NAME="Admin"
ADMIN_EMAIL=admin@mail.com
ADMIN_PASSWORD=password
```
 
### 4. Ejecutar migraciones
 
```bash
php artisan migrate --seed
```
 
Al ejecutar, se preguntará si cargar datos de desarrollo. Elegir **yes** para testing o **no** para producción.
 
### 5. Crear enlace de almacenamiento
 
```bash
php artisan storage:link
```
 
### 6. Iniciar el servidor de desarrollo
 
```bash
npm run dev
```
 
> **Nota**: El proyecto usa [Laravel Sail](https://laravel.com/docs/sail) para desarrollo con Docker. Si se prefiere ese entorno, el archivo `docker-compose.yml` incluido configura PHP 8.3, MySQL 8 y Mailpit.
 
---
 
## Despliegue en producción
 
### 1. Instalar dependencias de producción y compilar assets
 
```bash
composer install --no-dev --optimize-autoloader
npm run build
```
 
### 2. Optimizar la aplicación
 
```bash
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
 
### 3. Configurar el scheduler de Laravel
 
Agregar al crontab del servidor (`crontab -e`):
 
```bash
* * * * * cd /ruta-al-proyecto && php artisan schedule:run >> /dev/null 2>&1
```
 
El scheduler gestiona el envío de recordatorios de tareas personales y las notificaciones de vencimiento.
 
### 4. Configurar el worker de colas (recomendado)
 
En `.env`:
 
```env
QUEUE_CONNECTION=database
```
 
Configurar [Supervisor](https://laravel.com/docs/queues#supervisor-configuration) para mantener el worker activo:
 
```bash
php artisan queue:work --queue=default,email
```
 
### 5. Configurar el email
 
Completar en `.env` las variables con prefijo `MAIL_` con los datos del servidor SMTP institucional.
 
---
 
## Credenciales por defecto
 
Tras correr las migraciones con seed se crea un usuario administrador con los valores definidos en `.env`:
 
- **Email**: `admin@mail.com` (o el valor de `ADMIN_EMAIL`)
- **Contraseña**: `password` (o el valor de `ADMIN_PASSWORD`)
> ⚠️ Cambiar la contraseña inmediatamente después del primer login.
 
---
 
## Configuración adicional
 
### WebSockets (notificaciones en tiempo real)
 
Configurar [Pusher](https://pusher.com) o una [alternativa open-source](https://laravel.com/docs/broadcasting#open-source-alternatives) como Soketi. Completar en `.env` las variables con prefijo `PUSHER_`.
 
### Login con Google (opcional)
 
1. Crear un [OAuth Client ID](https://console.cloud.google.com/apis/credentials) en Google Cloud Console (tipo: "Web application").
2. Agregar al `.env`:
```env
GOOGLE_CLIENT_ID=tu_client_id
GOOGLE_CLIENT_SECRET=tu_client_secret
GOOGLE_REDIRECT_URI=https://tu-dominio/callback/google
```
 
---
 
## Estructura de roles y áreas
 
SiPro implementa una jerarquía de tres niveles:
 
| Rol | Alcance |
|---|---|
| **Superadmin** | Acceso total a todas las áreas, proyectos y usuarios del sistema. |
| **Admin** | Gestión completa dentro de su área asignada. No puede ver ni modificar recursos de otras áreas. |
| **Usuario** | Acceso a los proyectos en los que tiene permiso explícito. |
 
Cada usuario puede estar asignado a un **Área** (ej: Guardia, Sistemas, Laboratorio). Las áreas agrupan proyectos y usuarios, y el aislamiento entre ellas es automático por rol.
 
---
 
## Créditos
 
Este proyecto está basado en **LaraCollab**, desarrollado originalmente por [Vladimír Struhar](https://github.com/vstruhar/lara-collab) y [colaboradores de la comunidad](https://github.com/vstruhar/lara-collab/graphs/contributors?all=1). Se distribuye bajo la licencia MIT.
 
Las adaptaciones, nuevas funcionalidades y ajustes institucionales fueron desarrollados por el equipo de informática del Hospital Universitario (UNCuyo).
 
---
 
## Licencia
 
Este proyecto mantiene la licencia [MIT](https://opensource.org/licenses/MIT) del proyecto original.
