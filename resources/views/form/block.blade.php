<div>
    @foreach ($fields as $key => $field)
        {!! $field->context($context['items'][$key])->render() !!}
    @endforeach
</div>
