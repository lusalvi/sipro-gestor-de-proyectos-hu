<?php

namespace Database\Seeders;

use App\Models\PersonalTask;
use App\Models\TaskPriority;
use App\Models\User;
use Illuminate\Database\Seeder;

class PersonalTasksSeeder extends Seeder
{
    public function run(): void
    {
        $users      = User::all();
        $priorities = TaskPriority::orderBy('order')->get();

        foreach ($users as $user) {
            $this->seedForUser($user, $priorities);
        }
    }

    private function seedForUser(User $user, $priorities): void
    {
        $priorityIds = $priorities->pluck('id')->toArray();

        // ── Hoy ──────────────────────────────────────────────────────────────

        // Tarea de hoy con rango horario y recordatorio
        PersonalTask::create([
            'user_id'             => $user->id,
            'priority_id'         => $priorityIds[0] ?? null, // Alta
            'description'         => 'Reunión de seguimiento del sprint',
            'notes'               => 'Revisar el estado de las épicas abiertas antes de entrar.',
            'scheduled_for'       => today(),
            'scheduled_time'      => '09:00:00',
            'scheduled_end_time'  => '09:30:00',
            'reminder_minutes'    => 15,
            'completed_at'        => null,
        ]);

        // Tarea de hoy solo con hora de inicio (sin fin)
        PersonalTask::create([
            'user_id'          => $user->id,
            'priority_id'      => $priorityIds[1] ?? null, // Media
            'description'      => 'Actualizar documentación del módulo de autenticación',
            'notes'            => null,
            'scheduled_for'    => today(),
            'scheduled_time'   => '11:00:00',
            'reminder_minutes' => 30,
            'completed_at'     => null,
        ]);

        // Tarea de hoy sin hora (solo fecha), ya completada
        PersonalTask::create([
            'user_id'        => $user->id,
            'priority_id'    => $priorityIds[2] ?? null, // Baja
            'description'    => 'Revisar pull requests pendientes',
            'notes'          => null,
            'scheduled_for'  => today(),
            'completed_at'   => now()->subHours(2),
        ]);

        // ── Días anteriores (arrastre lazy — aparecen como "Pendientes anteriores") ─

        PersonalTask::create([
            'user_id'        => $user->id,
            'priority_id'    => $priorityIds[0] ?? null,
            'description'    => 'Responder consulta del área de guardia',
            'notes'          => 'Ticket #412 — problema con la impresión de turnos.',
            'scheduled_for'  => today()->subDays(2),
            'completed_at'   => null,
        ]);

        PersonalTask::create([
            'user_id'             => $user->id,
            'priority_id'         => $priorityIds[1] ?? null,
            'description'         => 'Configurar entorno de staging',
            'notes'               => null,
            'scheduled_for'       => today()->subDays(4),
            'scheduled_time'      => '14:00:00',
            'scheduled_end_time'  => '16:00:00',
            'completed_at'        => null,
        ]);

        // ── Días futuros ──────────────────────────────────────────────────────

        // Mañana: con rango horario y recordatorio
        PersonalTask::create([
            'user_id'             => $user->id,
            'priority_id'         => $priorityIds[0] ?? null,
            'description'         => 'Demo del nuevo módulo de turnos',
            'notes'               => 'Preparar slides con los flujos principales.',
            'scheduled_for'       => today()->addDays(1),
            'scheduled_time'      => '10:00:00',
            'scheduled_end_time'  => '11:00:00',
            'reminder_minutes'    => 60,
            'completed_at'        => null,
        ]);

        // Pasado mañana: solo fecha, sin hora
        PersonalTask::create([
            'user_id'       => $user->id,
            'priority_id'   => $priorityIds[2] ?? null,
            'description'   => 'Revisar logs del servidor de producción',
            'notes'         => null,
            'scheduled_for' => today()->addDays(2),
            'completed_at'  => null,
        ]);

        // En una semana: con hora puntual (sin fin)
        PersonalTask::create([
            'user_id'          => $user->id,
            'priority_id'      => $priorityIds[1] ?? null,
            'description'      => 'Capacitación interna: buenas prácticas Laravel',
            'notes'            => 'Preparar ejemplos de Eloquent y migraciones.',
            'scheduled_for'    => today()->addDays(7),
            'scheduled_time'   => '15:00:00',
            'reminder_minutes' => 30,
            'completed_at'     => null,
        ]);
    }
}