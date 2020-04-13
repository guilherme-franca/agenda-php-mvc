<?php

namespace app\models;

use app\models\Crud as Model;

class Contact extends Model
{
    static protected $table = 'tb_contacts';
    static protected $primaryKey = 'contact_id';
}