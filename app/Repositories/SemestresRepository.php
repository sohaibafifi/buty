<?php
namespace App\Repositories;

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
            'https://scoliut.univ-artois.fr/ScoDoc/' . $department->scodocId. '/Scolarite/Notes/formsemestre_list?formation_id='.$parent->scodocId,
            [
                                'auth' => [$department->scodoc_user, $department->scodoc_password]
                            ]
        );
    }

    public function show($scodocId)
    {
        $department = $parent->department;
        return $this->getJson(
            'https://scoliut.univ-artois.fr/ScoDoc/' . $department->scodocId. '/Scolarite/Notes/formsemestre_list?formsemestre_id='.$scodocId,
            [
                                'auth' => [$department->scodoc_user, $department->scodoc_password]
                            ]
        );
    }
}
