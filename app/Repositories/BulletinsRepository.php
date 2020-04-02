<?php

namespace App\Repositories;

use App\Models\Department;

/**
 * Bulletins Repository from Scodoc
 */
class BulletinsRepository
{
    use JsonTools;
    public function show(Department $department, $semestreId, $scodocId)
    {
        return $this->getJson(
            $department->scodoc_url . '/' . $department->scodocId . '/Scolarite/Notes/formsemestre_bulletinetud?format=json&formsemestre_id=' . $semestreId
                . '&etudid=' . $scodocId,
            [
                'auth' => [$department->scodoc_user, $department->scodoc_password]
            ]
        );
    }
}
