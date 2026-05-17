<?php

namespace Modules\Statistics\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticVotes extends Model
{
    protected $table = 'statistic_votes';

    protected $fillable = [
        'statistic_id',
        'user_id',
        'vote',
        'comment',
    ];

    public function statistic()
    {
        return $this->belongsTo(Statistics::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
