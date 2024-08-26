@extends('dashboard.master')


@section('page_title')
{{ __('dashboard.home') }}

@endsection
@section('content')

<div class="movies hz-padding">
    <div class="stack-head">
    <h3 class="title">المستخدمين</h3>

        <a href="{{ route('dashboard.users.create') }}">
            <button class="addBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="white" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3"></path>
                    </g>
                </svg>
            
            <span>اضافه مستخدم</span>
            </button>
        </a>
    </div>


    <div class="text-center">
        <div class="row g-4">
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            <div class="table-responsive">
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
            <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                    @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge text-bg-info text-white">
                                    {{ $user->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-sm btn-primary">تعديل</a>

                                <form  action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" class="d-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="delete btn btn-sm btn-danger" value="حذف">
                                </form>
                                
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                
                </tbody>
            </table>
            </div>

              {{ $users->links() }}

        </div>
    </div>
</div>


@endsection

@section('script')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>





<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });





    </script>
    
@endsection