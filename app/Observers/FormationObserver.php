<?php

namespace App\Observers;

use App\Formation;
use App\Repositories\SemestresRepository;

class FormationObserver
{
    /**
     * Handle the formation "created" event.
     *
     * @param  \App\Formation  $formation
     * @return void
     */
    public function created(Formation $formation)
    {
        $scodoc_semestres = (new SemestresRepository)->all($formation);
        if ($scodoc_semestres) {
            foreach ($scodoc_semestres as $scodoc_semestre) {
                $formation->semestres()->firstOrCreate([
                    'name' => $scodoc_semestre->titremois,
                    'scodocId' => $scodoc_semestre->formsemestre_id
                ]);
            }
        }
    }

    /**
     * Handle the formation "updated" event.
     *
     * @param  \App\Formation  $formation
     * @return void
     */
    public function updated(Formation $formation)
    {
        //
    }

    /**
     * Handle the formation "deleted" event.
     *
     * @param  \App\Formation  $formation
     * @return void
     */
    public function deleted(Formation $formation)
    {
        //
    }

    /**
     * Handle the formation "restored" event.
     *
     * @param  \App\Formation  $formation
     * @return void
     */
    public function restored(Formation $formation)
    {
        //
    }

    /**
     * Handle the formation "force deleted" event.
     *
     * @param  \App\Formation  $formation
     * @return void
     */
    public function forceDeleted(Formation $formation)
    {
        //
    }
}
