<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function showForm()
    {
        if (session()->get('is_playing')) {
            return redirect(route('game.play'));
        }

        return view('game.main');
    }

    public function startGame(Request $request)
    {
        $validated = $request->validate([
            'max_number' => 'required|numeric|min:10|max:500',
            'max_guesses' => 'required|numeric|min:1|max:100',
            'show_number' => 'string|in:off,on',
        ]);

        $s = session();

        // Set the default variables
        $s->put('number', rand(10, $validated['max_number']));
        $s->put('max_guesses', $validated['max_guesses'] ?? 10);
        $s->put('show_num', $validated['show_number'] ?? false);
        $s->put('guesses', []);
        $s->put('prev_guess', false);
        $s->put('is_playing', true);

        return redirect(route('game.play'));
    }

    public function playGame()
    {
        $s = session();

        if (!$s->get('is_playing')) {
            return redirect(route('game.main'))->with([
                'errors' => [
                    'A game has not been started yet',
                ],
            ]);
        }

        $view = view('game.play', $s->all());

        if ($s->has('errors')) {
            // Get the errors and remove them from the session
            $errors = $s->get('errors');
            $s->remove('errors');

            $view->with([
                'errors' => $errors->all(),
            ]);
        }

        return $view;
    }

    public function guessNumber(Request $request)
    {
        $s = session();

        if (!$s->get('is_playing')) {
            return redirect(route('game.main'))->with([
                'errors' => [
                    'A game has not been started yet',
                ],
            ]);
        }

        $validated = $request->validate([
            'guess' => 'required|numeric|min:1|max:500',
        ]);

        $num = $s->get('number');
        $guess = (int) $validated['guess'];
        $prev = $s->get('prev_guess', 0);
        $percentage = ceil($num / $guess * 100);

        $hotCold = 'Colder';

        if (abs($num - $guess) < abs($num - $prev)) {
            $hotCold = 'Hotter';
        }

        $guessesList = $s->get('guesses', []);

        $guessesList = array_prepend($guessesList,  "Guess: $guess ($percentage%) ($hotCold), previous: $prev");

        $s->put('guesses', $guessesList);
        $s->put('prev_guess', $guess);

        $maxGuess = $s->get('max_guesses');

        if ($guess === $num) {
            $s->put('guessed', true);

            return redirect(route('game.results'));
        } else if (count($guessesList) >= $maxGuess) {
            $s->put('guessed', false);

            return redirect(route('game.results'));
        }

        return redirect(route('game.play'));
    }

    public function results()
    {
        $s = session();

        if (!$s->get('is_playing')) {
            return redirect(route('game.main'))->with([
                'errors' => [
                    'A game has not been started yet',
                ],
            ]);
        }

        // Reset the playing state so that we can start again
        $s->put('is_playing', false);

        $num = $s->get('number');
        $guessesList = $s->get('guesses', []);
        $guessed = $s->get('guessed', false);

        return view('game.results', [
            'num' => $num,
            'guesses' => $guessesList,
            'guessed' => $guessed,
        ]);
    }

    public function reset()
    {
        $s = session();
        $s->put('is_playing', false);

        return redirect(route('game.main'));
    }
}
