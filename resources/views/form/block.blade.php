<div>
    @foreach ($fields as $field)
        <div wire:key="">
            {!! $field->render() !!}
        </div>
    @endforeach
</div>
