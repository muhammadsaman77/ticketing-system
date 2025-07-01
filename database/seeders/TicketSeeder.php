<?php
namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::inRandomOrder()->take(5)->get();
        foreach (range(1, 20) as $i) {
            Ticket::create([
                'user_id'     => $users->random()->id,
                'handler_id'  => null,
                'title'       => fake()->sentence(5),
                'description' => fake()->paragraph(),
                'status'      => 'OPEN',
                'resolved_at' => null,
                'closed_at'   => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
