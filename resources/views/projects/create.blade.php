@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-5">
            <h3>Project creating</h3>
        </div>
        <form action="<?= route('project.store') ?>" method="post">
            @csrf
            <input class="mb-1" type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div class="form-group">
                <label for="name">Project name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                @if($errors->first('name'))
                    <div class="invalid-feedback" style="display: block">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <button class="btn btn-primary mt-4">Save</button>
        </form>
    </div>
@endsection
