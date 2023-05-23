<?php

namespace Domain\Resources;

use Domain\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'usename' => $this->email,
            'role' => $this->role,
            'last_login' => $this->last_login,
        ];
    }
}
