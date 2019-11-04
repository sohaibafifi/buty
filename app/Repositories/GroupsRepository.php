<?php
namespace App\Repositories;

use App\Group;
use Illuminate\Database\Eloquent\Model;

/**
 * Formation repository from Scodoc
 */
class GroupsRepository implements RepositoryInterface
{
    use JsonTools;


    public function all(?Model $parent)
    {
        $department = $parent->formation->department;
        return $this->getJson(
            'https://scoliut.univ-artois.fr/ScoDoc/' . $department->scodocId. '/Scolarite/Notes/formsemestre_partition_list?format=json&formsemestre_id='.$parent->scodocId,
            [
                                'auth' => [$department->scodoc_user, $department->scodoc_password]
                            ]
        );
    }

    public function show($scodocId)
    {
        $group = Group::where('scodocId', $scodocId)->first();

        $department = $group->semestre->formation->department;
        return $this->getJson(
            'https://scoliut.univ-artois.fr/ScoDoc/' .  $department->scodocId. '/Scolarite/Notes/groups_view?format=json&with_codes=1&group_ids='.$scodocId,
            [
                                'auth' => [$department->scodoc_user, $department->scodoc_password]
                            ]
        );
    }
}
