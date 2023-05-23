<?php
use Tests\TestCase;
use Domain\Models\Candidate;
use Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CandidateTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCandidate()
    {
        $user = User::factory()->create();

        $candidateData = [
            'name' => 'Mi candidato prueba',
            'source' => 'Fotocasapruebasunitarias',
            'owner' => $user->id,
        ];

        $candidate = Candidate::create($candidateData);

        $this->assertInstanceOf(Candidate::class, $candidate);
        $this->assertDatabaseHas('candidates', $candidateData);
    }

}