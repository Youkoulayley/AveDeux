<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Genre_show.
 *
 * @property int $genre_id
 * @property int $show_id
 */
class Genre_show extends Model
{
    protected $table = 'genre_show';
    public $timestamps = false;
}
