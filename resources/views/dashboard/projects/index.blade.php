@extends('dashboard.master')


@section('page_title')
    مشاريع / مستفيدون
@endsection
@section('content')

<div class="categories hz-padding">
    <div class="stack-head">
    <h3 class="title">مشاريع / مستفيدون</h3>

        <a href="{{ route('dashboard.projects.create') }}">
            <button class="addBtn custom">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="white" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3"></path>
                    </g>
                </svg> --}}
            
            <span class="text-dark">اضافه مشاريع</span>
            </button>
        </a>
    </div>


    <div class="text-center">
        <div class="row g-4">
            @foreach ($projects as $project)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="form">
                        <a href="{{ route('dashboard.projects.edit', $project->id) }}" class="text-primary">تعديل</a> |
                        <form method="POST" action="{{ route('dashboard.projects.destroy', $project->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input  type="submit" value="حذف" class="text-danger border-0 delete b-none">
                        </form>
                    </div>
                <div class="box {{ $project->background_color }}" 
                    >
                    <div class="stack">
                        <div class="feat">
                            <span><a href="{{ route('dashboard.file.index') }}?project={{$project->id}}" class="text-white">{{ $project->name }}</a></span>
                            <span class="number">{{ $project->files_count }}</span>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="text-center p-4">{{ $projects->links() }}</div>
</div>


@endsection