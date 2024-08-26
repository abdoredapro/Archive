@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.home') }}

@endsection
@section('content')

<div class="movies hz-padding">
    <div class="stack-head">
    <h3 class="title">{{ __('dashboard.roles') }}</h3>

        <a href="{{ route('dashboard.roles.create') }}">
            <button class="addBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="white" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3"></path>
                    </g>
                </svg>
            
                <span>اضافه صلاحيه</span>
            </button>
        </a>
    </div>


    <div class="text-center">
        <div class="row g-4">
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            
            <div class="container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @forelse ($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a  href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                                        <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-danger delete" value="حذف">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="text-center">There's no roles</div>
                            @endforelse
        
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection