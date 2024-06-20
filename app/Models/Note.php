<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'content',
        'image',
    ];

    public static function getByUUID($uuid): Note
    {
        $data = Note::where('id', $uuid)->first();
        abort_if(empty($data), 404, 'Not found');

        return $data;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
