<?php

namespace App\Http\Controllers\Web\Notes;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class NoteController extends Controller
{

    /**
     * @return Response
     */
    public function index(): Response
    {
        $notes = auth()->user()->notes;

        return Inertia::render(
            'Notes/Notes',
            [
                'notes' => $notes
            ]
        );
    }
}
