<?php

namespace Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;


class Candidate extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = ['name', 'source', 'owner','created_at','create_by'];


    public function getCachedData($key)
    {
        return Redis::get($key);
    }

    public function cacheData($key, $value, $minutes)
    {
        Redis::put($key, $value, $minutes);
    }
}
