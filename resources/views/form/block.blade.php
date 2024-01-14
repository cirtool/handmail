<div>
    {{ dd($context) }}
    @foreach ($fields as $key => $field)
        {!! $field->context($context['items'][$key])->renderForm() !!}
    @endforeach
</div>
