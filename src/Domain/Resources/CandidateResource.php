<?php

namespace Domain\Resources;

use Domain\Models\Candidate;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @mixin Candidate
 */
class CandidateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'source' => $this->source,
            'owner' => $this->owner,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ];
    }
}
