@extends($layoutName, $values)

@section('content')
    @foreach ($blocks as $block)
        {!! Handmail::findBlock($block['name'])->context($block)->render() !!}
    @endforeach
@endsection
