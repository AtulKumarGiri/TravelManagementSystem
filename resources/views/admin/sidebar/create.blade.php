@extends('layouts.admin.admin')

@section('content')
<div class="container">
    <h2>Create Sidebar Item</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('sidebar.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Icon (Font Awesome or Bootstrap icon class)</label>
            <input type="text" name="icon" class="form-control" placeholder="e.g. fa fa-users or bi bi-list">
        </div>

        <div class="mb-3">
            <label>Parent (optional)</label>
            <select name="parent_id" class="form-control">
                <option value="">None (Main Category)</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
