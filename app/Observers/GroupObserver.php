<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Group;
use App\Models\Semestre;
use Illuminate\Support\Facades\Hash;
use App\Repositories\GroupsRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\BulletinsRepository;

class GroupObserver
{
    /**
     * Handle the group "created" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function created(Group $group)
    {
        $scodoc_students = (new GroupsRepository)->show($group->scodocId);
        foreach ($scodoc_students as $scodoc_student) {
            $scodoc_student_info = (new StudentsRepository)->getFromScodc($group->semestre->formation->department, $scodoc_student->etudid);
            $user = User::where('email', $scodoc_student_info->email)->first();
            if (!$user) {
                $user = User::create([
                    'username' => $scodoc_student_info->email,
                    'email'    => $scodoc_student_info->email,
                    'password' => Hash::make($scodoc_student_info->code_nip),
                    'firstname' => $scodoc_student_info->prenom,
                    'lastname' => $scodoc_student_info->nom,
                    'role'     => 'student',
                    'scodocId' => $scodoc_student_info->etudid,
                    'scodoc_picture' => $scodoc_student_info->photo_url,
                    'nip'      => $scodoc_student_info->code_nip,
                    'ine'      => $scodoc_student_info->code_ine,
                ]);
            }
            $group->users()->attach($user);
            if ($scodoc_student_info->insemestre) {
                foreach ($scodoc_student_info->insemestre as $insemestre) {
                    $semestre = Semestre::where('scodocId', $insemestre->formsemestre_id)->first();
                    if ($semestre) {
                        $bulletin = (new BulletinsRepository)->show($semestre->formation->department, $semestre->scodocId, $user->scodocId);
                        $semestre->users()->attach($user, ['bulletin' => json_encode($bulletin)]);
                    }
                }
            }
        }
    }

    /**
     * Handle the group "updated" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        //
    }

    /**
     * Handle the group "deleted" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function deleted(Group $group)
    {
        //
    }

    /**
     * Handle the group "restored" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function restored(Group $group)
    {
        //
    }

    /**
     * Handle the group "force deleted" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        //
    }
}
