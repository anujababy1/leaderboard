<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Competitor;

class CompetitorTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getApiToken()
    {
        return env('API_TOKEN');
    }

    public function testCreateCompetitor()
    {
        $data = [
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(10, 120),
            'address' => $this->faker->address,
            'points' => $this->faker->numberBetween(0, 100),
        ];

        $response = $this->post('/api/competitors', $data, [
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);

        $response->assertStatus(201);
    }

    public function testListCompetitors()
    {
        
        $competitors = Competitor::factory(5)->create();

        $response = $this->get('/api/competitors', [
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);

        $response->assertStatus(200); 
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'age', 'address', 'points'],
            ],
        ]);
    }
    public function testSortByNameAscending()
    {
        $competitors = Competitor::factory(5)->create();

        $response = $this->get('/api/competitors?order_by=name-asc', [
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);

        $response->assertStatus(200);

        $data = $response->decodeResponseJson();

        // Ensure the results are sorted by name in ascending order
        $sortedNames = collect($data['data'])->pluck('name')->sort()->values()->toArray();
        $actualNames = collect($data['data'])->pluck('name')->values()->toArray();

        $this->assertEquals($sortedNames, $actualNames);
    }
    public function testSortByNameDescending()
    {
        $competitors = Competitor::factory(5)->create();

        $response = $this->get('/api/competitors?order_by=name-desc', [
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);

        $response->assertStatus(200);

        $data = $response->decodeResponseJson();

        // Ensure the results are sorted by name in desc order
        $sortedNames = collect($data['data'])->pluck('name')->sortDesc()->values()->toArray();
        $actualNames = collect($data['data'])->pluck('name')->values()->toArray();

         $this->assertEquals($sortedNames, $actualNames);
    }

     public function testSortByPointsAscending()
    {
        $competitors = Competitor::factory(5)->create();

        $response = $this->get('/api/competitors?order_by=points-asc', [
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);

        $response->assertStatus(200);

        $data = $response->decodeResponseJson();

        // Ensure the results are sorted by points in ascending order
        $sortedPoints = collect($data['data'])->pluck('points')->sort()->values()->toArray();
        $actualPoints = collect($data['data'])->pluck('points')->values()->toArray();

        $this->assertEquals($sortedPoints, $actualPoints);

        
    }

    public function testSortByPointsDescending()
    {
        $competitors = Competitor::factory(5)->create();

        
        $response = $this->get('/api/competitors?order_by=points-desc', [
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);

        $data = $response->decodeResponseJson();

        // Ensure the results are sorted by points in descending order
        $sortedPoints = collect($data['data'])->pluck('points')->sortDesc()->values()->toArray();
        $actualPoints = collect($data['data'])->pluck('points')->values()->toArray();

        $this->assertEquals($sortedPoints, $actualPoints);

        
    }

    public function testSearchCompetitorsByName()
    {
        Competitor::factory()->create(['name' => 'John Doe']);
        Competitor::factory()->create(['name' => 'Jane Smith']);
        Competitor::factory()->create(['name' => 'Alice Johnson']);

        $response = $this->get('/api/competitors?search_name=Alice', [
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Alice Johnson']);
    }

    public function testShowCompetitor()
    {
        $competitor = Competitor::factory()->create();
       

        $response = $this->get(route('competitors.show', $competitor->id), [
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['id', 'name', 'age', 'address', 'points']);
         
    }

    public function testUpdateCompetitor()
    {
        $competitor = Competitor::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(10, 120),
            'address' => $this->faker->address,
            'points' => $this->faker->numberBetween(0, 100),
        ];

        $response = $this->put(route('competitors.update', $competitor->id), $data,[
            'Authorization' => 'Bearer ' . $this->getApiToken(), 
        ]);
        

        $response->assertStatus(201); 
        $this->assertDatabaseHas('competitors', $data);
       
    }

    public function testDeleteCompetitor()
    {
        $competitor = Competitor::factory()->create();
      

        $response = $this->delete(route('competitors.destroy', $competitor->id), [], [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
        ]);

        $response->assertStatus(204); 
        $this->assertDatabaseMissing('competitors', ['id' => $competitor->id]);
    }

    
}
