<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends Model
{
    protected $fillable = ['title', 'body'];
}
