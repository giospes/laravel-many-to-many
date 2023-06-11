@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>User ID\Name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                        <tr>
                                <td>
                                    <a href="{{ route('admin.projects.show', $project->slug) }}">
                                        {{ $project->id }}
                                    </a>
                                </td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->user_id}}\{{ $project->user->name }} </td>
                                <td>{{ $project->created_at }}</td>
                                <td>{{ $project->updated_at }}</td>
                               

                        </tr>
                
                @endforeach
            </tbody>
        </table>
        <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Create a New Project</a>
        {{$projects->links('vendor.pagination.bootstrap-5')}} 
    </div>
@endsection