<?php

namespace App\Observers;

use App\Models\Semestre;
use App\Repositories\GroupsRepository;

class SemestreObserver
{
    /**
     * Handle the semestre "created" event.
     *
     * @param  \App\Semestre  $semestre
     * @return void
     */
    public function created(Semestre $semestre)
    {
        $scodoc_partitions = (new GroupsRepository)->all($semestre);
        if ($scodoc_partitions) {
            foreach ($scodoc_partitions as $scodoc_partition) {
                if ($scodoc_partition->group) {
                    foreach ($scodoc_partition->group as $scodoc_group) {
                        if ($scodoc_group->group_name) {
                            $semestre->groups()->firstOrCreate([
                                'name' => $scodoc_partition->partition_name . ' ' . $scodoc_group->group_name,
                                'scodocId' => $scodoc_group->group_id
                            ]);
                        }
                    }
                }
            }
        }
    }

    /**
     * Handle the semestre "updated" event.
     *
     * @param  \App\Semestre  $semestre
     * @return void
     */
    public function updated(Semestre $semestre)
    {
        $scodoc_partitions = collect((new \App\Repositories\GroupsRepository)->all($semestre));
        $scodoc_groups = $scodoc_partitions->pluck('group')->flatten();
        if ($scodoc_groups) {
            $ids = $scodoc_groups->pluck('formsemestre_id');
            $semestre->groups()->whereNotIn('scodocId', $ids)->delete();
            $semestre->groups()->onlyTrashed()->whereIn('scodocId', $ids)->restore();
            foreach ($scodoc_groups as $scodoc_group) {
                $semestre->groups()
                    ->updateOrCreate(
                        ['scodocId' => $scodoc_group->group_id],
                        ['name' => $scodoc_group->partition_name . ' ' . $scodoc_group->group_name]
                    );
            }
        }
    }

    /**
     * Handle the semestre "deleted" event.
     *
     * @param  \App\Semestre  $semestre
     * @return void
     */
    public function deleted(Semestre $semestre)
    {
        //
    }

    /**
     * Handle the semestre "restored" event.
     *
     * @param  \App\Semestre  $semestre
     * @return void
     */
    public function restored(Semestre $semestre)
    {
        //
    }

    /**
     * Handle the semestre "force deleted" event.
     *
     * @param  \App\Semestre  $semestre
     * @return void
     */
    public function forceDeleted(Semestre $semestre)
    {
        //
    }
}
