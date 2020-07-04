@extends('layouts.app')

@section('content')
    
    @if ($chronology->user_id === $user->id)
        <h2 class='mb-3 text-center'>{!! $chronology->title !!}の年表</h2>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>年代</th>
                    <th>出来事</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contents as $content)
                <tr>
                    <td>{{ link_to_route('contents.edit', $content->age, ['id' => $content->id]) }}</td>
                    <td>{{ $content->event }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $contents->links('pagination::bootstrap-4') }}
    @else
        <h2 class='mb-3 text-center'>{!! $chronology->title !!}の年表</h2>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>年代</th>
                    <th>出来事</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contents as $content)
                <tr>
                    <td>{{ $content->age }}</td>
                    <td>{{ $content->event }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $contents->links('pagination::bootstrap-4') }}
    @endif
    
    @if ($chronology->user_id === $user->id)
        {!! Form::open(['route' => 'contents.store']) !!}
            <div class='form-group'>
                {!! Form::label('age', '年代') !!}
                {!! Form::number('age', old('age'), ['class' => 'form-control']) !!}
            </div>
            <div class='form-group'>
                {!! Form::label('event', '出来事') !!}
                {!! Form::text('event', old('event'), ['class' => 'form-control']) !!}
            </div>
            {{ Form::hidden('chronology_id', $chronology->id) }}
            {{ Form::hidden('owner_id', $user->id) }}
            {!! Form::submit('作成', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        
        {!! Form::open(['route' => ['chronologies.destroy', $chronology->id], 'method' => 'delete']) !!}
            {!! Form::submit('この年表を削除する', ['class' => 'btn btn-danger mt-5 mb-3']) !!}
        {!! Form::close() !!}
    @endif
    
@endsection()