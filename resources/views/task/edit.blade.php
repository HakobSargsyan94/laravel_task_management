@php use App\Models\Task; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-5">
            <h3>Task creating</h3>
        </div>
        <form enctype="multipart/form-data" action="<?= route('task.update', $task->id) ?>" method="post">
            @csrf
            @method('patch')
            <input class="mb-1" type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input class="mb-1" type="hidden" name="id" value="{{ $task->id }}">
            <div class="form-group">
                <label for="title">Task title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $task->title }}">
                @if($errors->first('title'))
                    <div class="invalid-feedback" style="display: block">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group mt-4">
                <label for="title">Project</label>
                <select class="form-control" name="project_id" id="project_id">
                    @if($projects)
                        @foreach($projects as $project)
                            <option <?= $task->project_id == $project->id ? "selected" : "" ?>
                                    value="{{ $project->id }}">
                                {{ $project->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @if($errors->first('project_id'))
                    <div class="invalid-feedback" style="display: block">
                        {{ $errors->first('project_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group mt-4">
                <label for="status">Task status</label>
                <select class="form-control" name="status" id="status">

                    <option <?= $task->status == Task::NEW ? "selected" : "" ?>
                            value="{{Task::NEW}}">
                        {{Task::NEW}}
                    </option>
                    <option <?= $task->status == Task::IN_PROGRESS ? "selected" : "" ?>
                            value="{{Task::IN_PROGRESS}}">
                        {{Task::IN_PROGRESS}}
                    </option>
                    <option <?= $task->status == Task::DONE ? "selected" : "" ?>
                            value="{{Task::DONE}}">
                        {{Task::DONE}}
                    </option>
                </select>
                @if($errors->first('status'))
                    <div class="invalid-feedback" style="display: block">
                        {{ $errors->first('status') }}
                    </div>
                @endif
            </div>
            <div class="form-group mt-4">
                <label for="file">Attached files</label>
                <input type="file" class="form-control" name="file" id="file" value="{{ old('file') }}">
                @if($errors->first('file'))
                    <div class="invalid-feedback" style="display: block">
                        {{ $errors->first('file') }}
                    </div>
                @endif
            </div>
            <button class="btn btn-primary mt-4">Save</button>
        </form>
    </div>
@endsection
