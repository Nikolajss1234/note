<?php

namespace App\Repository\Notes;

use App\Models\Note;
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
    public function createNote(User $user): Model
    {
        return $user->notes()->create();
    }

    /**
     * @param Note $note
     * @param User $user
     * @param string $text
     * @return bool
     */
    public function updateNote(Note $note, User $user, string $text): bool
    {
        if ($note->user->id != $user->id) {
            return false;
        }

        $note->text = $text;
        $note->save();

        return true;
    }

}