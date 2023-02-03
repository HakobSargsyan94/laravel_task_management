@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <div>
                <a class="btn btn-success" href="{{ route('task.create') }}" type="button">
                    Create task for project
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <nav class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task title</th>
                        <th scope="col">Project name</th>
                        <th scope="col">User name</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($tasks)
                        @foreach($tasks as $task)
                            <tr>
                                <th scope="row">{{ $task->id }}</th>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->project->name }}</td>
                                <td>{{ $task->user->name }}</td>
                                <td>{{ $task->status }}</td>
                                <td>
                                    <div class="d-flex flex-row mb-3">
                                        @if($task->user_id === auth()->id())
                                            <div>
                                                <a href="{{ route('task.edit', $task->id) }}" type="button" class="btn">
                                                    <i class="fas fa-edit editIcon"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form method="post" action="{{ route('task.destroy', $task->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{$task->id}}" name="id">
                                                    <button type="submit" class="btn">
                                                        <i class="fa fa-trash deleteIcon" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('task.show', $task->id) }}" type="button" class="btn">
                                                <i class="fa-solid fa-eye showIcon"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="{{$tasks->previousPageUrl()}}">Previous</a>
                        </li>
                        @for($i=1;$i<=$tasks->lastPage();$i++)
                            <li class="page-item "><a class="page-link " href="{{$tasks->url($i)}}">{{$i}}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link" href="{{$tasks->nextPageUrl()}}">Next</a></li>
                    </ul>
                </nav>
            </nav>
        </div>
    </div>
@endsection
