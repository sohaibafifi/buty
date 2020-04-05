<?php

namespace App\Observers;

use App\Models\Department;
use App\Repositories\FormationRepository;

class DepartmentObserver
{
    /**
     * Handle the department "created" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function created(Department $department)
    {
        $scodoc_formations = (new FormationRepository())->all($department);
        if ($scodoc_formations) {
            foreach ($scodoc_formations as $scodoc_formation) {
                $department->formations()->firstOrCreate([
                    'name' => ($scodoc_formation->titre),
                    'scodocId' => $scodoc_formation->formation_id
                ]);
            }
        }
    }

    /**
     * Handle the department "updated" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function updated(Department $department)
    {
        $scodoc_formations = collect((new FormationRepository())->all($department));
        if ($scodoc_formations) {
            $ids = $scodoc_formations->pluck('formation_id');
            $department->formations()->whereNotIn('scodocId', $ids)->delete();
            $department->formations()->onlyTrashed()->whereIn('scodocId', $ids)->restore();
            foreach ($scodoc_formations as $scodoc_formation) {
                $department->formations()
                    ->updateOrCreate(
                        ['scodocId' => $scodoc_formation->formation_id],
                        ['name' => ($scodoc_formation->titre)]
                    );
            }
        }
    }

    /**
     * Handle the department "deleted" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function deleted(Department $department)
    {
        //
    }

    /**
     * Handle the department "restored" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function restored(Department $department)
    {
        //
    }

    /**
     * Handle the department "force deleted" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function forceDeleted(Department $department)
    {
        //
    }
}
