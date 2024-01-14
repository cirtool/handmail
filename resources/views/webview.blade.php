@extends($model->structure['layout']['name'], $model->structure['layout'])

@section('content')
    @foreach ($model->structure['blocks'] as $block)
    {!! Handmail::findBlock($block['name'])->context($block)->render() !!}
    @endforeach
@endsection
