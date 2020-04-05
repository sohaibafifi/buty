<?php

namespace App\Observers;

use App\Models\Formation;
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
                if ($scodoc_semestre->etat == "1")
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
        $scodoc_semestres = collect((new SemestresRepository)->all($formation));
        if ($scodoc_semestres) {
            $ids = $scodoc_semestres->pluck('formsemestre_id');
            $formation->semestres()->whereNotIn('scodocId', $ids)->delete();
            $formation->semestres()->onlyTrashed()->whereIn('scodocId', $ids)->restore();
            foreach ($scodoc_semestres as $scodoc_semestre) {
                $formation->semestres()
                    ->updateOrCreate(
                        ['scodocId' => $scodoc_semestre->formsemestre_id],
                        ['name' => $scodoc_semestre->titremois]
                    );
            }
        }
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
