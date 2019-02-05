@extends('layouts.default')

@section('title', 'The results')

@section('content')

    <div class="col-md-auto">
        <div class="card" style="width: 40rem;">
            <div class="card-body">
                <h5 class="card-title">Your results</h5>
                <hr/>

                @if ($guessed)
                    <div class="alert alert-success" role="alert">
                        You guessed the number
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        You did not guess the number
                    </div>
                @endif

                <hr/>
                <h6 class="card-text">The number was: {{ $num }}</h6>
                <hr/>
                <a href="{{ route('game.main') }}" role="button" class="btn btn-primary w-100">Play again</a>
                <hr/>
                <h6 class="card-text">Your guesses: (total {{ count($guesses) }})</h6>
                <ul class="list-group list-group-flush">
                    @foreach($guesses as $guess)
                        <li class="list-group-item">{{ $guess }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
