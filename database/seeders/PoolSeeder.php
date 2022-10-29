<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Pool;

    class PoolSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $poolInputs = [
                [
                    'office_id'     => 1,
                    'head_user_id'  => 10,
                    'admin_user_id' => 18,
                ],
                [
                    'office_id'     => 2,
                    'head_user_id'  => 11,
                    'admin_user_id' => 19,
                ],
                [
                    'office_id'     => 3,
                    'head_user_id'  => 12,
                    'admin_user_id' => 20,
                ],
                [
                    'office_id'     => 4,
                    'head_user_id'  => 13,
                    'admin_user_id' => 21,
                ],
                [
                    'office_id'     => 5,
                    'head_user_id'  => 14,
                    'admin_user_id' => 22,
                ],
                [
                    'office_id'     => 6,
                    'head_user_id'  => 15,
                    'admin_user_id' => 23,
                ],
                [
                    'office_id'     => 7,
                    'head_user_id'  => 16,
                    'admin_user_id' => 24,
                ],
                [
                    'office_id'     => 8,
                    'head_user_id'  => 17,
                    'admin_user_id' => 25,
                ],
            ];
            foreach ($poolInputs as $poolInput) {
                Pool::insert([
                    'name'          => fake()->streetName(),
                    'office_id'     => $poolInput[ 'office_id' ],
                    'head_user_id'  => $poolInput[ 'head_user_id' ],
                    'admin_user_id' => $poolInput[ 'admin_user_id' ],
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }
