@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->messages() as $input => $errors)
                <li>{{ $input.': '.implode(',',$errors) }}</li>
            @endforeach
        </ul>
    </div>
@endif
