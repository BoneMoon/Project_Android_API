<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nota extends Model
{
    protected $fillable = ['titulo', 'descricao', 'tipodescricao', 'foto'];
}
