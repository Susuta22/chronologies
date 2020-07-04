@extends('layouts.app')
@section('content')
    {!! Form::open(['route' => ['contents.update', 'id' => $content->id], 'method' => 'put']) !!}
        <div class='form-group'>
            {!! Form::label('age', '年代') !!}
            {!! Form::number('age', $content->age, ['class' => 'form-control']) !!}
        </div>
        <div class='form-group'>
            {!! Form::label('event', '出来事') !!}
            {!! Form::text('event', $content->event, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('更新', ['class' => 'btn btn-primary mb-3']) !!}
    {!! Form::close() !!}
    {!! Form::open(['route' => ['contents.destroy', 'id' => $content->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
        
@endsection()