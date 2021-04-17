<?php

namespace App\Http\Controllers\Web\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
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


    /**
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        dd('aaaaaaaaa');



    }

}
