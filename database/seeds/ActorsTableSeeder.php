<?php

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create([
            'name' => 'Matthew McConaughey',
            'profile_path' => '/wJiGedOCZhwMx9DezY8uwbNxmAY.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Jessica Chastain',
            'profile_path' => '/4Qyty9CLJchru1QdOTEHspL3SEk.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Anne Hathaway',
            'profile_path' => '/tLelKoPNiyJCSEtQTz1FGv4TLGc.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Michael Caine',
            'profile_path' => '/5K0WR3yaodF8Cz4nTo0sNinFDdw.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Keanu Reeves',
            'profile_path' => '/bOlYWhVuOiU6azC4Bw6zlXZ5QTC.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Laurence Fishburne',
            'profile_path' => '/7XP72qzAjbIFikZIpXroLbSS8Cy.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Carrie-Anne Moss',
            'profile_path' => '/xD4jTA3KmVp5Rq3aHcymL9DUGjD.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Hugo Weaving',
            'profile_path' => '/n1hM4zsv9XPkkg08Lwf1lnUJPQS.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Jim Carrey',
            'profile_path' => '/ienbErTKd9RHCV1j7FJLNEWUAzn.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Laura Linney',
            'profile_path' => '/6I31xZxo9Hq6T0OhSwCUjHd8jkB.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Noah Emmerich',
            'profile_path' => '/uhMuM8QhLqWoQVZBgUBM9QSitcK.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Natascha McElhone',
            'profile_path' => '/x5UXw0ospfYryYqJOtqEN74Slho.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Tim Robbins',
            'profile_path' => '/9DujxnBMVkizaeIyM0eXPMfXxR.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Morgan Freeman',
            'profile_path' => '/oIciQWr8VwKoR8TmAw1owaiZFyb.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Bob Gunton',
            'profile_path' => '/ulbVvuBToBN3aCGcV028hwO0MOP.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Actor::create([
            'name' => 'Clancy Brown',
            'profile_path' => '/xjg0ZIxP0tFcEQCTeRgKxNtLdpe.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
