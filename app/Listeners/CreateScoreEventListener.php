<?php

namespace App\Listeners;

use App\Events\CreateScoreEvent;
use App\Score;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateScoreEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateScoreEvent  $event
     * @return void
     */
    public function handle(CreateScoreEvent $event)
    {
        $score =new Score();
        $score->scored_marks=$event->request->scored_marks;
        $score->reg_number=$event->request->reg_number;
        $event->scoreType->scores()->save($score);
        return response()->json(['score' => $score]);

    }
}
