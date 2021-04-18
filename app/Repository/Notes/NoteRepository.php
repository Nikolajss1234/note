<?php

namespace App\Repository\Notes;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @param $noteId
     * @return Collection|Model|HasMany|HasMany[]|null
     */
    public function getUserSingleNote(User $user, $noteId)
    {
        return $user->notes()->with('comments')->findOrFail($noteId);
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
     * @param $noteId
     * @param User $user
     * @param string $text
     * @return Model
     */
    public function createNoteComment($noteId, User $user, string $text): Model
    {
        $note = $user->notes()->findOrFail($noteId);

        return $note->comments()->create(['text' => $text]);

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
        return $note->save();
    }

    /**
     * @param Note $note
     * @param User $user
     * @return bool
     */
    public function deleteNote(Note $note, User $user): bool
    {
        if ($note->user->id != $user->id) {
            return false;
        }

        return $note->delete();
    }

}