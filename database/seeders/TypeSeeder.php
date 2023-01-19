<?php

namespace Database\Seeders;

use App\Models\Type;

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = ['Front', 'Back', 'Full'];
        foreach ($type as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->save();
        }
    }
}
