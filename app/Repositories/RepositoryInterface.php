<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all(?Model $parent);
    public function show($scodocId);
}
