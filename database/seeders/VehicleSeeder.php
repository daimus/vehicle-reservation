<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Vehicle;

    class VehicleSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $vehicleInputs = [1, 2, 3, 4, 5, 6, 7, 8];
            foreach ($vehicleInputs as $vehicleInput) {
                Vehicle::insert([
                    'brand'        => fake()->randomElement(['Honda', 'Volvo', 'Ford', 'Chevrolet', 'Mitsubishi']),
                    'model'        => fake()->citySuffix(),
                    'vehicle_no'   => fake()->regexify('[A-Z]{2}[0-9]{4}[A-Z]{2}'),
                    'type'         => fake()->randomElement(['SUV', 'MPV', 'DOUBLE_CABIN', 'TRUCK', 'DUMP_TRUCK']),
                    'ownership'    => fake()->randomElement(['OWN', 'RENT']),
                    'pool_id'      => $vehicleInput,
                    'is_available' => true,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
