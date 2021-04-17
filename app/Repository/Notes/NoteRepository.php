<?php

namespace App\Repository\Notes;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class NoteRepository
{

    /**
     * @param User $user
     * @return mixed
     */
    public function getUserNotes(User $user)
    {
        return $user->notes;
    }

    /**
     * @param User $user
     * @return Model
     */
    public function createNote(User $user)
    {
        return $user->notes()->create();
    }

}