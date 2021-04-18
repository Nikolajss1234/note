<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteCommentCreateRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Models\Note;
use App\Repository\Notes\NoteRepository;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class NoteController extends Controller
{

    /**
     * @var NoteRepository
     */
    private $noteRepository;

    /**
     * NoteController constructor.
     * @param NoteRepository $noteRepository
     */
    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $notes = $this->noteRepository->getUserNotes(auth()->user());

        return Inertia::render(
            'Notes/Notes',
            [
                'notes' => $notes
            ]
        );
    }

    /**
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        $note = $this->noteRepository->getUserSingleNote(auth()->user(), $id);

        return Inertia::render(
            'Notes/SingleFullViewNote',
            [
                'note' => $note
            ]
        );
    }

    /**
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        return response()->json(['note' => $this->noteRepository->createNote(auth()->user())]);
    }

    /**
     * @param $noteId
     * @param NoteCommentCreateRequest $request
     * @return JsonResponse
     */
    public function createComment($noteId, NoteCommentCreateRequest $request): JsonResponse
    {
        return response()->json(
            ['comment' => $this->noteRepository->createNoteComment($noteId, auth()->user(), $request->input('text'))]
        );
    }

    /**
     * @param Note $note
     * @param NoteUpdateRequest $request
     * @return JsonResponse
     */
    public function update(Note $note, NoteUpdateRequest $request): JsonResponse
    {
        return response()->json(
            $this->noteRepository->updateNote(
                $note,
                auth()->user(),
                $request->input('text')
            )
        );
    }

    /**
     * @param Note $note
     * @return JsonResponse
     */
    public function delete(Note $note): JsonResponse
    {
        return response()->json(
            $this->noteRepository->deleteNote(
                $note,
                auth()->user(),
            )
        );
    }

}
