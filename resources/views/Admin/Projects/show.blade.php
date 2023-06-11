<h1>{{ $project->name }}</h1>
<p>Description: {{ $project->description }}</p>
<p>User ID: {{ $project->user_id }}</p>
<p>Created At: {{ $project->created_at }}</p>
<p>Updated At: {{ $project->updated_at }}</p>
<p>Type: {{$project->type->name}} </p>
<p>Technology: 
    <ul>
        @foreach ($project->technologies as $technology)
            <li>{{ $technology->name }}</li>
        @endforeach
    </ul>
</p>
<a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-warning">EDIT</a>