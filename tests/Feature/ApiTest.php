<?php

namespace Tests\Feature;
use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\CategorySeeder;
use Database\Seeders\SportSeeder;
use Database\Seeders\EquipmentSeeder;
use Database\Seeders\EquipmentSportSeeder;use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            CategorySeeder::class,
            SportSeeder::class,
            EquipmentSeeder::class,
            EquipmentSportSeeder::class,
        ]);
    }
    public function test_get_equipments(): void
    {
        $equipment = Equipment::first();

        $row=[];
        $maxId= DB::table('equipment')->max('id');

        for($i=1; $i<= 25; $i++){
            $row[]=[
                'id' => $maxId + $i,
                'name' => 'Equipment Test ' . $i,
                'description' => 'Description test',
                'daily_price' => 20,
                'category_id' => $equipment->category_id,
            ];
        }
        DB::table('equipment')->insert($row);
        $response = $this->getJson('/api/equipments');

        $response->assertStatus(200)
            ->assertJsonCount(20, 'data')
            ->assertJsonPath('meta.per_page', 20);
    
    }


}
