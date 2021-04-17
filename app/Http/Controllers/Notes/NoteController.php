<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Repository\Notes\NoteRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        return response()->json(['note' => $this->noteRepository->createNote(auth()->user())]);
    }

    /**
     * @param Note $note
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Note $note, Request $request): JsonResponse
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
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Note $note, Request $request): JsonResponse
    {
        return response()->json(
            $this->noteRepository->deleteNote(
                $note,
                auth()->user(),
            )
        );
    }

}
