@extends('layouts.default')

@section('title', 'Set your settings')

@section('content')

    <div class="card" style="width: 40rem;">
        <div class="card-body">
            <h5 class="card-title">Set your generation settings</h5>
            <hr/>

            @include('partials.errors')

            <form action="{{ route('game.create') }}" method="post">

                @include('partials.input_slider', [
                'name' => 'max_guesses',
                'title' => 'Max guesses',
                'min' => '1',
                'max' => '100',
                'value' => '10'])

                @include('partials.input_slider', [
                'name' => 'max_number',
                'title' => 'Max Number'])

                <hr />
                <p class="card-text">Cheats:</p>

                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="show_number" name="show_number">
                            <label class="form-check-label" for="show_number">Show number</label>
                        </div>
                    </div>
                </div>

                <hr/>

                <button type="submit" class="btn btn-success w-100">Start game</button>

                @method('PUT')
                @csrf

            </form>


        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function updateDisplay(el) {
            _(el.dataset.display).value = el.value;
        }
    </script>
@endsection
