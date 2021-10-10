<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterParseFetchHistory extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = ['character_name', 'server_name', 'server_region', 'parse_count', 'avatar_url'];

}
