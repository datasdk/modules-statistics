<?php

namespace Modules\Statistics\Models;


// use Turahe\Counters\Models\Counter;
use Modules\Statistics\Models\Counter;
use ActionModel;
use Spatie\Tags\HasTags;
use Modules\Media\Traits\InteractsWithMedia;
use Modules\Media\Contracts\HasMedia;
use Illuminate\Support\Facades\Cache;

class Statistics extends ActionModel implements HasMedia
{
   
    use HasTags;
    use InteractsWithMedia;

    protected $translatable = ["title", "description","slug"];

    protected $sluggable = "title";

    protected $appends = [ "vote_count"];

    public $fillable = [
        "slug",
        "title",
        "description",
        "sorting"
    ];

    public function getVoteCountAttribute()
    {
        $cacheKey = 'statistics_vote_count_' . $this->id;

        return Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return $this->votes()->count();
        });
    }

    public function votes()
    {
        return $this->hasMany(StatisticVotes::class, 'statistic_id');
    }
}
