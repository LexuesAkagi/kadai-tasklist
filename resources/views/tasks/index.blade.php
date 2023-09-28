@extends('layouts.app')
@section('content')
        <div class="prose ml-4">
            <h2>タスク 一覧</h2>
        </div>
        
        @if ($tasks->isNotEmpty())
            <table class="table table-zebra w-full my-4">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>タスク</th>
                        <th>進み具合</th>
                        <th>ユーザーID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                        <td>{{ $task->content }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->user_id }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>タスクがありません</h3>
        @endif
        
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">新規タスクの追加</a>
@endsection