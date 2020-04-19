@if ($errors->has($name))
    <div class="invalid-feedback">
    @foreach ($errors->get($name) as $message)
        <strong>{{ $message }}</strong>
        @endforeach
    </div>
@endif