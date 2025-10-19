@extends('layouts.admin.admin')

@section('content')
<div class="container-fluid">
    <h2>Create CMS Page</h2>

    <form action="{{ route('cms.store') }}" method="POST">
        @csrf
    <div class="row">
        {{-- Title --}}
        <div class="col-md-6 mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        {{-- Slug --}}
        <div class="col-md-6 mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" required value="{{ old('slug') }}">
        </div>

        {{-- Content --}}
        <div class="mb-3">
            <label>Content</label>
            <textarea id="summernote" name="content" class="form-control" rows="10">{{ old('content') }}</textarea>
        </div>

        {{-- Meta Title --}}
        <div class="col-md-6 mb-3">
            <label>Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
        </div>
        
        {{-- Meta Keywords --}}
        <div class="col-md-6 mb-3">
            <label>Meta Keywords</label>
            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}">
        </div>

        {{-- Meta Description --}}
        <div class="mb-3">
            <label>Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
        </div>

        {{-- Status --}}
        <div class="form-check mb-3">
            <input type="checkbox" name="status" class="form-check-input" id="status" checked>
            <label for="status" class="form-check-label">Active</label>
        </div>
    </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('cms.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
