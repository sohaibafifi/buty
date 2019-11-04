<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Formation repository from Scodoc
 */
class FormationRepository implements RepositoryInterface
{
    use JsonTools;
    public function all(?Model $parent)
    {
        $scodocId = $parent->scodocId;
        return $this->getJson(
            'https://scoliut.univ-artois.fr/ScoDoc/' . $scodocId. '/Scolarite/Notes/formation_list',
            [
                                'auth' => [$parent->scodoc_user, $parent->scodoc_password]
                            ]
        );
    }

    public function show($scodocId)
    {
        $scodocId = $parent->scodocId;
        return $this->getJson(
            'https://scoliut.univ-artois.fr/ScoDoc/' . $scodocId. '/Scolarite/Notes/formation_list?formation_id='.$scodocId,
            [
                                'auth' => [$parent->scodoc_user, $parent->scodoc_password]
                            ]
        );
    }
}
