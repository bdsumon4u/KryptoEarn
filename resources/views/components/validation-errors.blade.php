@if ($errors->any())
    <div {{ $attributes }}>
        <h4 class="text-danger">{{ __('Whoops! Something went wrong.') }}</h4>

        <ul class="mt-3 text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
