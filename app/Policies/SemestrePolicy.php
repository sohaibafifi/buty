<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Semestre;
use Illuminate\Auth\Access\HandlesAuthorization;

class SemestrePolicy
{
    use HandlesAuthorization;
    use Traits\ReadOnlyPolicy;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Semestre  $semestre
     * @return mixed
     */
    public function view(?User $user, Semestre $semestre)
    {
        return true;
    }
}
