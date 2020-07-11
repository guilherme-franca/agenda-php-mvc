<?php

namespace app\models;

use app\models\Database as Model;

class Event extends Model
{
    protected $table = 'tb_events';
    protected $primaryKey = 'event_id';
}