@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h2>オリジナル年表</h2>
            @if (Auth::check())
                <h5 class='mt-3'>ようこそ{!! $user->name !!}さん</h5>
    
            @else
                {!! link_to_route('signup.get', 'アカウント作成', [], ['class' => 'btn btn-primary btn-lg']) !!}
            @endif
        </div>
    </div>
    @if (Auth::check())
        <h4 class='mt-3 mb-3'>年表を作る</h4>
        {!! Form::open(['route' => 'chronologies.store']) !!}
            <div class='form-group'>
                {!! Form::label('title', '年表のタイトルを入力してください') !!}
                {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('作成', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    
        <h4 class='mt-5 text-center border-bottom pb-3'>{!! $user->name !!}さんの年表一覧</h4>
            <div class='row text-center'>
                @foreach($chronologies as $chronology)
                    <div class='col-sm-2 mb-3 ml-2 mr-2 text-center'>{!! link_to_route('chronologies.show', $chronology->title, ['id' => $chronology->id]) !!}</div>
                @endforeach
            </div>
            
        @if (Auth::id() === $user->id)  
            <div class='mt-5 text-center'>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    {!! Form::submit('アカウント削除', ['class' => 'btn btn-danger mb-3']) !!}
                {!! Form::close() !!}
            </div>
        @endif
    @endif

@endsection