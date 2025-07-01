<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HandlerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('handlers')->insert([
            [
                'name'           => 'Ari Saputra',
                'email'          => 'ari.saputra@example.com',
                'phone_number'   => '081234567890',
                'specialization' => 'Network Troubleshooting',
                'role'           => 'HELPDESK',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Dina Kurniawan',
                'email'          => 'dina.kurniawan@example.com',
                'phone_number'   => '081234567891',
                'specialization' => 'Software Deployment',
                'role'           => 'PIC',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Rudi Hartanto',
                'email'          => 'rudi.hartanto@example.com',
                'phone_number'   => '081234567892',
                'specialization' => 'IT Support',
                'role'           => 'HELPDESK',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Nina Febriani',
                'email'          => 'nina.febriani@example.com',
                'phone_number'   => '081234567893',
                'specialization' => 'Hardware Maintenance',
                'role'           => 'PIC',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Fitri Handayani',
                'email'          => 'fitri.handayani@example.com',
                'phone_number'   => '081234567894',
                'specialization' => 'Database Admin',
                'role'           => 'HELPDESK',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Bagus Prasetya',
                'email'          => 'bagus.prasetya@example.com',
                'phone_number'   => '081234567895',
                'specialization' => 'Web Development',
                'role'           => 'PIC',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Yuni Astuti',
                'email'          => 'yuni.astuti@example.com',
                'phone_number'   => '081234567896',
                'specialization' => 'Cyber Security',
                'role'           => 'HELPDESK',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Agus Santoso',
                'email'          => 'agus.santoso@example.com',
                'phone_number'   => '081234567897',
                'specialization' => 'Cloud Services',
                'role'           => 'HELPDESK',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Mega Putri',
                'email'          => 'mega.putri@example.com',
                'phone_number'   => '081234567898',
                'specialization' => 'System Integration',
                'role'           => 'PIC',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Fahmi Ananda',
                'email'          => 'fahmi.ananda@example.com',
                'phone_number'   => '081234567899',
                'specialization' => 'Desktop Support',
                'role'           => 'HELPDESK',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
