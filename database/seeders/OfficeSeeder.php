<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Str;
    use App\Models\Office;

    class OfficeSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $officeInputs = [
                [
                    'type'    => 'HEAD',
                    'user_id' => 2,
                ],
                [
                    'type'    => 'BRANCH',
                    'user_id' => 3,
                ],
                [
                    'type'    => 'MINE_SITE',
                    'user_id' => 4,
                ],
                [
                    'type'    => 'MINE_SITE',
                    'user_id' => 5,
                ],
                [
                    'type'    => 'MINE_SITE',
                    'user_id' => 6,
                ],
                [
                    'type'    => 'MINE_SITE',
                    'user_id' => 7,
                ],
                [
                    'type'    => 'MINE_SITE',
                    'user_id' => 8,
                ],
                [
                    'type'    => 'MINE_SITE',
                    'user_id' => 9,
                ],
            ];
            foreach ($officeInputs as $officeInput) {
                Office::insert([
                    'name'       => fake()->city(),
                    'type'       => $officeInput[ 'type' ],
                    'user_id'    => $officeInput[ 'user_id' ],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
