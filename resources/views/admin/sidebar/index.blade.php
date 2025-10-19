@extends('layouts.admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between">
        <h2>Sidebar Options</h2>
    
        <a href="{{ route('sidebar.create') }}" class="btn btn-primary mb-3">+ Sidebar Option</a>

    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Level</th>
                <th>Parent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sidebars as $sidebar)
            <tr>
                <td>{{ $sidebar->title }}</td>
                <td>{{ $sidebar->slug }}</td>
                <td>{{ $sidebar->level }}</td>
                <td>{{ $sidebar->parent ? $sidebar->parent->title : '-' }}</td>
                <td>
                    <!-- Edit/Delete links -->
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>

            <!-- Optionally show children here if you want nested view -->
            @if($sidebar->children->count())
                @foreach($sidebar->children as $child)
                    <tr>
                        <td>— {{ $child->title }}</td>
                        <td>{{ $child->slug }}</td>
                        <td>{{ $child->level }}</td>
                        <td>{{ $sidebar->title }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif

            @endforeach
        </tbody>
    </table>
</div>
@endsection
