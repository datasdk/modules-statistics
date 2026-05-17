<?php

namespace Modules\Statistics\Models;

use Illuminate\Database\Eloquent\Model;
use Turahe\Counters\Facades\Counters;
use Turahe\Counters\Models\Counter as CounterOrgin;
use Spatie\Translatable\HasTranslations;

use Turahe\Counters\Traits\HasCounter;
use Turahe\Counters\Models\Counterable;


class Counter extends CounterOrgin
{
    
    use HasCounter;
    use HasTranslations;

    protected $translatable = ['name'];

    

  /*
    // use HasTranslations;

   // 


    protected $casts = [
        'name' => 'array',
    ];

    protected $sluggable = "name";
    protected $saveSlugsTo = "key";
    */


    public function counter()
    {
        return $this->hasOne(Counterable::class,"counter_id");
    }


    public function counters()
    {
        return $this->hasMany(Counterable::class,"counter_id");
    }


    public function counterable()
    {
        return $this->hasMany(Counterable::class,"counter_id");
    }

}
