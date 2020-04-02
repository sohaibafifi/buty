<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

/**
 * Formation repository from Scodoc
 */
class StudentsRepository implements RepositoryInterface
{
    use JsonTools;


    public function all(?Model $parent)
    {
        return (new GroupsRepository())->show($parent->scodocId);
    }

    public function show($scodocId)
    {
    }

    public function getFromScodc(Department $department, $scodocId)
    {
        return $this->getJson(
            $department->scodoc_url . '/' .  $department->scodocId . '/Scolarite/Notes/etud_info?format=json&etudid=' . $scodocId,
            [
                'auth' => [$department->scodoc_user, $department->scodoc_password]
            ]
        );
    }
}
