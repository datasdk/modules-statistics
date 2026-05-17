<?php

namespace Modules\Statistics\Models;

use Turahe\Counters\Traits\HasCounter;
use Turahe\Counters\Models\Counter;
use App\Models\User as OrigUser;


class User extends OrigUser
{
    use HasCounter;


}