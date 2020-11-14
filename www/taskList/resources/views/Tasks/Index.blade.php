@extends('Layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task List for MendVIP </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('task.add') }}" title="Create a task"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p> {{ session()->get('success')}}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->name }}</td>
                <td>
                  <a href="{{ route('task.edit',$task->id) }}" class="btn btn-sm btn-outline-danger py-0">Edit</a>
                  <a href="" onclick="if(confirm('Do you want to delete this task?'))event.preventDefault(); document.getElementById('delete-{{$task->id}}').submit();" class="btn btn-sm btn-outline-danger py-0">Delete</a>
                  <form id="delete-{{$task->id}}" method="post" action="{{route('task.delete',$task->id)}}" style="display: none;">
                  @csrf
                  @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $tasks->links() !!}

@endsection
