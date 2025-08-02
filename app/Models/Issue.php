<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Issue extends Model
{
    // $table->decimal('lat', 10, 7)->nullable();
    // $table->decimal('lng', 10, 7)->nullable();
    function category()
    {
        return $this->belongsTo(IssueCategory::class, "category_id");
    }
    function photos()
    {
        return $this->hasMany(IssuePhoto::class, "issue_id");
    }
    public function scopeWithinDistance(Builder $query, $lat, $lng, $distanceInKm)
    {
        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(lat)) * cos(radians(lng) - radians($lng)) + sin(radians($lat)) * sin(radians(lat))))";

        return $query->select('*')
            ->selectRaw("{$haversine} AS distance")
            ->having("distance", "<=", $distanceInKm)
            ->orderBy("distance");
    }
    function status_updates()
    {
        return $this->hasMany(IssueStatusLog::class, "issue_id");
    }
}
