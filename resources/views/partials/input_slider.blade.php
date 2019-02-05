<?php $random_id = 'slider_' . \Ramsey\Uuid\Uuid::uuid4()->toString(); ?>
<div class="row">
    <div class="col">
        <label for="{{ $random_id }}">{{ $title }}</label>
        <input class="form-control" type="text" placeholder="{{ $value ?? '50' }}" id="{{ $random_id }}" readonly>
    </div>

    <div class="col">
        <label for="{{ $name }}">&nbsp;</label>
        <input type="range"
               class="form-control"
               max="{{ $max ?? '500' }}"
               min="{{ $min ?? '10' }}"
               value="{{ $value ?? '50' }}"
               name="{{ $name }}"
               id="{{ $name }}"
               data-display="#{{ $random_id }}"
               oninput="updateDisplay(this)">
    </div>
</div>
