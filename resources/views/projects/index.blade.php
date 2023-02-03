@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <div>
                <a class="btn btn-success" href="{{ route('project.create') }}" type="button">
                    Create project
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Project name</th>
                        <th scope="col">User name</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($projects)
                        @foreach($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->id }}</th>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->user->name }}</td>
                                <td>
                                    <div class="d-flex flex-row mb-3">
                                        @if($project->user_id === auth()->id())
                                            <div>
                                                <a href="{{ route('project.edit', $project->id) }}" type="button"
                                                   class="btn">
                                                    <i class="fas fa-edit editIcon"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form method="post"
                                                      action="{{ route('project.destroy', $project->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn">
                                                        <i class="fa fa-trash deleteIcon" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('project.show', $project->id) }}" type="button"
                                               class="btn">
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
                        <li class="page-item"><a class="page-link" href="{{$projects->previousPageUrl()}}">Previous</a>
                        </li>
                        @for($i=1;$i<=$projects->lastPage();$i++)
                            <li class="page-item "><a class="page-link " href="{{$projects->url($i)}}">{{$i}}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link" href="{{$projects->nextPageUrl()}}">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
