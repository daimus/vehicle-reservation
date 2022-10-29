<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\User;
    use Illuminate\Support\Str;

    class UserSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $userInputs = [
                [
                    'email' => 'super@mail.com',
                    'role'  => 'super',
                ],
                [
                    'email' => 'officer_headoffice@mail.com',
                    'role'  => 'officer',
                ],
                [
                    'email' => 'officer_branchoffice@mail.com',
                    'role'  => 'officer',
                ],
                [
                    'email' => 'officer_minesite1@mail.com',
                    'role'  => 'officer',
                ],
                [
                    'email' => 'officer_minesite2@mail.com',
                    'role'  => 'officer',
                ],
                [
                    'email' => 'officer_minesite3@mail.com',
                    'role'  => 'officer',
                ],
                [
                    'email' => 'officer_minesite4@mail.com',
                    'role'  => 'officer',
                ],
                [
                    'email' => 'officer_minesite5@mail.com',
                    'role'  => 'officer',
                ],
                [
                    'email' => 'officer_minesite6@mail.com',
                    'role'  => 'officer',
                ],
                [
                    'email' => 'head_head@mail.com',
                    'role'  => 'head',
                ],
                [
                    'email' => 'head_branch@mail.com',
                    'role'  => 'head',
                ],
                [
                    'email' => 'head_minesite1@mail.com',
                    'role'  => 'head',
                ],
                [
                    'email' => 'head_minesite2@mail.com',
                    'role'  => 'head',
                ],
                [
                    'email' => 'head_minesite3@mail.com',
                    'role'  => 'head',
                ],
                [
                    'email' => 'head_minesite4@mail.com',
                    'role'  => 'head',
                ],
                [
                    'email' => 'head_minesite5@mail.com',
                    'role'  => 'head',
                ],
                [
                    'email' => 'head_minesite6@mail.com',
                    'role'  => 'head',
                ],
                [
                    'email' => 'admin_head@mail.com',
                    'role'  => 'admin',
                ],
                [
                    'email' => 'admin_branch@mail.com',
                    'role'  => 'admin',
                ],
                [
                    'email' => 'admin_minesite1@mail.com',
                    'role'  => 'admin',
                ],
                [
                    'email' => 'admin_minesite2@mail.com',
                    'role'  => 'admin',
                ],
                [
                    'email' => 'admin_minesite3@mail.com',
                    'role'  => 'admin',
                ],
                [
                    'email' => 'admin_minesite4@mail.com',
                    'role'  => 'admin',
                ],
                [
                    'email' => 'admin_minesite5@mail.com',
                    'role'  => 'admin',
                ],
                [
                    'email' => 'admin_minesite6@mail.com',
                    'role'  => 'admin',
                ],
            ];

            foreach ($userInputs as $userInput) {
                User::factory()->create([
                    'name'              => fake()->name(),
                    'email'             => $userInput[ 'email' ],
                    'email_verified_at' => now(),
                    'password'          => 'password',
                    'remember_token'    => Str::random(10),
                    'role'              => $userInput[ 'role' ],
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }
        }
    }
