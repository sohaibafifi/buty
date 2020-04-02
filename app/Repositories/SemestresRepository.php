<?php

namespace App\Repositories;

use App\Models\Semestre;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

/**
 * Formation repository from Scodoc
 */
class SemestresRepository implements RepositoryInterface
{
    use JsonTools;


    public function all(?Model $parent)
    {
        $department = $parent->department;

        return $this->getJson(
            $department->scodoc_url . '/' . $department->scodocId . '/Scolarite/Notes/formsemestre_list?formation_id=' . $parent->scodocId,
            [
                'auth' => [$department->scodoc_user, $department->scodoc_password]
            ]
        );
    }

    public function show($scodocId)
    {
        $semestre = Semestre::where('scodocId', $scodocId)->first();
        $department = $semestre->formation->department;
        return $this->getJson(
            $department->scodoc_url . '/' . $department->scodocId . '/Scolarite/Notes/formsemestre_list?formsemestre_id=' . $scodocId,
            [
                'auth' => [$department->scodoc_user, $department->scodoc_password]
            ]
        );
    }
}
