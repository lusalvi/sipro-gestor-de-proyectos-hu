<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskGroup;
use App\Models\TaskPriority;
use App\Models\User;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::with(['taskGroups'])->get();
        $admin = User::role('admin')->first();
        $users = User::all();
        $labels = Label::all();
        $priorities = TaskPriority::orderBy('order')->get();

        foreach ($projects as $project) {
            $number = 1;

            foreach ($project->taskGroups as $index => $taskGroup) {
                if ($index === 0) {
                    // ── Primer grupo: árboles Épica → hijos ──────────────────
                    $number = $this->seedEpics($taskGroup, $project, $admin, $users, $labels, $priorities, $number);
                } else {
                    // ── Resto de grupos: tareas simples con fechas y prioridad ─
                    $number = $this->seedSimpleTasks($taskGroup, $project, $admin, $users, $labels, $priorities, $number);
                }
            }
        }
    }

    // ── Épicas con hijos ──────────────────────────────────────────────────────
    private function seedEpics(
        TaskGroup $taskGroup,
        Project $project,
        User $admin,
        $users,
        $labels,
        $priorities,
        int $number
    ): int {
        // Épica 1: tiene Historias, cada Historia tiene Subtareas
        $epic1 = $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Épica: Módulo de autenticación',
            'issue_type' => 'Epica',
            'start_on' => now()->subDays(20),
            'due_on' => now()->addDays(30),
        ]);
        $this->attachLabels($epic1, $labels, 1);

        $historia1 = $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Historia: Login con usuario y contraseña',
            'issue_type' => 'Historia',
            'parent_task_id' => $epic1->id,
            'start_on' => now()->subDays(15),
            'due_on' => now()->addDays(5),
        ]);

        $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Subtarea: Diseñar formulario de login',
            'issue_type' => 'Subtarea',
            'parent_task_id' => $historia1->id,
            'start_on' => now()->subDays(14),
            'due_on' => now()->subDays(8),
            'completed_at' => now()->subDays(8),
        ]);

        $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Subtarea: Implementar validación de credenciales',
            'issue_type' => 'Subtarea',
            'parent_task_id' => $historia1->id,
            'start_on' => now()->subDays(7),
            'due_on' => now()->addDays(3),
        ]);

        $historia2 = $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Historia: Recuperación de contraseña por email',
            'issue_type' => 'Historia',
            'parent_task_id' => $epic1->id,
            'start_on' => now()->addDays(6),
            'due_on' => now()->addDays(20),
        ]);

        $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Subtarea: Enviar email con token de reset',
            'issue_type' => 'Subtarea',
            'parent_task_id' => $historia2->id,
            'start_on' => now()->addDays(6),
            'due_on' => now()->addDays(12),
        ]);

        $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Subtarea: Pantalla de nueva contraseña',
            'issue_type' => 'Subtarea',
            'parent_task_id' => $historia2->id,
            'start_on' => now()->addDays(13),
            'due_on' => now()->addDays(20),
        ]);

        // Épica 2: tiene Tareas directas, cada Tarea tiene Subtareas
        $epic2 = $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Épica: Gestión de turnos',
            'issue_type' => 'Epica',
            'start_on' => now()->subDays(5),
            'due_on' => now()->addDays(60),
        ]);
        $this->attachLabels($epic2, $labels, 2);

        $tarea1 = $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Tarea: Calendario de disponibilidad',
            'issue_type' => 'Tarea',
            'parent_task_id' => $epic2->id,
            'start_on' => now()->subDays(5),
            'due_on' => now()->addDays(15),
        ]);

        $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Subtarea: Integrar librería de calendario',
            'issue_type' => 'Subtarea',
            'parent_task_id' => $tarea1->id,
            'start_on' => now()->subDays(4),
            'due_on' => now()->addDays(2),
            'completed_at' => now()->subDays(1),
        ]);

        $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
            'name' => 'Subtarea: Endpoint de reserva de turno',
            'issue_type' => 'Subtarea',
            'parent_task_id' => $tarea1->id,
            'start_on' => now()->addDays(3),
            'due_on' => now()->addDays(15),
        ]);

        return $number;
    }

    // ── Tareas simples (sin jerarquía) ────────────────────────────────────────

    private function seedSimpleTasks(
        TaskGroup $taskGroup,
        Project $project,
        User $admin,
        $users,
        $labels,
        $priorities,
        int $number
    ): int {
        $count = random_int(3, 7);

        for ($i = 0; $i < $count; $i++) {
            $startDays = random_int(-10, 10);
            $duration = random_int(3, 14);

            $task = $this->createTask($taskGroup, $project, $admin, $users, $priorities, $number++, [
                'name' => fake()->sentence(random_int(4, 8)),
                'start_on' => fake()->boolean(60) ? now()->addDays($startDays) : null,
                'due_on' => fake()->boolean(70) ? now()->addDays($startDays + $duration) : null,
                'completed_at' => fake()->randomElement([now(), now(), null, null, null]),
            ]);

            $this->attachLabels($task, $labels, random_int(0, 2));
        }

        return $number;
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /**
     * Crea una tarea con valores base + los campos que se pasen en $overrides.
     * El assignee se elige al azar entre los usuarios del proyecto.
     */
    private function createTask(
        TaskGroup $taskGroup,
        Project $project,
        User $admin,
        $users,
        $priorities,
        int $number,
        array $overrides
    ): Task {
        $priority = $priorities->isNotEmpty()
            ? fake()->randomElement(array_merge($priorities->pluck('id')->toArray(), [null, null]))
            : null;

        $assignee = fake()->boolean(80)
            ? $users->random()
            : null;

        return $taskGroup->tasks()->create(array_merge([
            'project_id' => $project->id,
            'created_by_user_id' => $admin->id,
            'assigned_to_user_id' => $assignee?->id,
            'assigned_at' => $assignee ? now() : null,
            'number' => $number,
            'issue_type' => 'Tarea',
            'description' => fake()->sentences(3, true),
            'priority_id' => $priority,
            'start_on' => null,
            'due_on' => null,
            'completed_at' => null,
        ], $overrides));
    }

    private function attachLabels(Task $task, $labels, int $max): void
    {
        if ($labels->isEmpty() || $max === 0) {
            return;
        }

        $labels->random(min($max, $labels->count()))
            ->each(fn (Label $label) => $task->labels()->attach($label));
    }
}
