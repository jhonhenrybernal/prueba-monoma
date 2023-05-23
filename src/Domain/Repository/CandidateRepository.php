<?php

namespace Domain\Repository;

use Domain\Models\Candidate;
use Illuminate\Support\Facades\Cache;

class CandidateRepository
{

    public function getAll()
    {
        return Cache::store('redis_cache')->remember('candidates', 60, function () {
            return Candidate::all();
        });
    }

    public function create(array $data)
    {
        $candidate = new Candidate($data);
        return $candidate->save();
    }

    public function show(int $id)
    {
        return Cache::store('redis_cache')->remember('candidates:'.$id, 60, function () use ($id) {
            return Candidate::findOrFail($id);
        });
     
    }
}
