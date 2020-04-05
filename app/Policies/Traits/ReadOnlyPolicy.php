<?php

namespace App\Policies\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait ReadOnlyPolicy
{

    public function create(?User $user)
    {
        return false;
    }

    public function update(?User $user, Model $model)
    {
        return false;
    }

    public function delete(?User $user, Model $model)
    {
        return false;
    }


    public function restore(?User $user, Model $model)
    {
        return false;
    }

    public function forceDelete(?User $user, Model $model)
    {
        return false;
    }
}
