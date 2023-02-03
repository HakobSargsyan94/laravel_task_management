@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-5">
            <h3>Project name : {{ $project->name }}</h3>
        </div>
        <h1 class="mb-4">Tasks</h1>
        @if($project->tasks)
            <div class="row">
                @foreach($project->tasks as $task)
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h3 class="card-title mb-3">Task title : {{ $task->title }}</h3>
                                <h5 class="card-title mb-3">Project name : {{ $task->project->name }}</h5>
                                <h5 class="card-title mb-3">User name : {{ $task->user->name }}</h5>
                                <hr>
                                <p class="mb-3">Status : {{ $task->status }}</p>
                                <p class="card-title mb-3">Attached files :
                                    @if($task->file)
                                        <a href="/uploads/{{ $task->file }}" download>Attached file</a>
                                    @else
                                        <span>No attached file</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <h4>Have not tasks for this project</h4>
        @endif
    </div>
@endsection
