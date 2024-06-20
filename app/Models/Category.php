<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public static function getByUUID($uuid): Category
    {
        $data = Category::where('id', $uuid)->first();
        abort_if(empty($data), 404, 'Not found');

        return $data;
    }

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class);
    }
}
