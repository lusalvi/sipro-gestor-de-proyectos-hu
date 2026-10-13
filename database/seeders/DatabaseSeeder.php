<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            LabelSeeder::class,
            TaskPrioritySeeder::class,
        ]);

        if ($this->command->confirm('Seed development data?', false)) {
            $this->call([
                UserSeeder::class,
                AreaSeeder::class,
            ]);

            auth()->setUser(User::role('admin')->first());

            $this->call([
                ProjectSeeder::class,
                TaskGroupSeeder::class,
                TasksSeeder::class,
                PersonalTasksSeeder::class,
            ]);
        } else {
            $this->call([ProductionSeeder::class]);
        }
    }
}
