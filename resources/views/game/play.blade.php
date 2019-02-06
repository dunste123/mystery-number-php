@extends('layouts.default')

@section('title', 'Play the game')

@section('content')

    <div class="col-md-auto">
        <div class="card" style="width: 40rem;">
            <div class="card-body">
                <h5 class="card-title">Guess the number</h5>
                <hr/>

                @include('partials.errors')

                @if ($show_num)
                    <p class="card-text">The number: {{ $number }}</p>
                    <hr/>
                @endif

                <p class="card-text">Guesses left: {{ $max_guesses - count($guesses) }}</p>
                <hr />

                <form action="{{ route('game.guess') }}" method="post" autocomplete="off">

                    <div class="row">
                        <div class="col">
                            <label for="guess">Make guess</label>
                            <input class="form-control" type="number" placeholder="{{ $prev_guess }}" id="guess"
                                   name="guess" autofocus>
                        </div>
                    </div>

                    <hr/>

                    <button type="submit" class="btn btn-success w-100">Make guess</button>
                    <a role="button" class="btn btn-danger w-100" href="{{ route('game.reset') }}">Reset game</a>
                    @csrf
                </form>

                @if ($prev_guess)
                    <hr/>
                    <p class="card-text">Previous: {{ $prev_guess }}</p>
                @endif

                <ul class="list-group list-group-flush">
                    @foreach($guesses as $guess)
                        <li class="list-group-item">{{ $guess }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
