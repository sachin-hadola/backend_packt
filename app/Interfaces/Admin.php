<?php

namespace App\Interfaces;

use App\Interfaces\Database\FindByEmail;
use App\Interfaces\Database\FindByEmailWithModel;
use App\Interfaces\Database\Insert;

interface Admin extends FindByEmail, Insert, FindByEmailWithModel
{
}