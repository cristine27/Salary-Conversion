<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Null_;

class sensorModel extends Model
{
    protected $table = 'sensor';
    protected $primaryKey = 'id';
    protected $allowedFields = ['temperature', 'humidity', 'roomArea', 'id', 'timestamp'];
}
