<?php

namespace App\Interfaces;

use App\Interfaces\Database\Delete;
use App\Interfaces\Database\Find;
use App\Interfaces\Database\Get;
use App\Interfaces\Database\Insert;
use App\Interfaces\Database\SearchWithFilter;
use App\Interfaces\Database\Update;

interface Book extends Insert, Update, Delete, Find, SearchWithFilter, Get
{
}