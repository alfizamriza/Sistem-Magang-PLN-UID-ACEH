<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Participant;

class FillUniqueCodeSeeder extends Seeder
{
    public function run()
    {
        $participants = Participant::whereNull('unique_code')->get();
        foreach ($participants as $participant) {
            $participant->unique_code = Str::uuid();
            $participant->save();
        }
    }
}
