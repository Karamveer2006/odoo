<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Issue extends Model
{
    // $table->decimal('latitude', 10, 7)->nullable();
    // $table->decimal('longitude', 10, 7)->nullable();
    function category()
    {
        return $this->belongsTo(IssueCategory::class);
    }
    public function scopeWithinDistance(Builder $query, $lat, $lng, $distanceInKm)
    {
        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lng)) + sin(radians($lat)) * sin(radians(latitude))))";

        return $query->select('*')
            ->selectRaw("{$haversine} AS distance")
            ->having("distance", "<=", $distanceInKm)
            ->orderBy("distance");
    }
    
}
