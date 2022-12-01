@extends('adminmain')
@section('content')
    <h4>
        <div class="form-group row">
            <form method="POST" action="{{ route('searchdate-user') }}">
                @csrf
                <label for="fromDate">Users added from :</label>
                <div class="col-sm-3"><input type="date" class="form-control input-sm" name="fromDate" required></div>
                <label for="toDate">Users added to :</label>
                <div class="col-sm-3"><input type="date" class="form-control input-sm" name="toDate" required></div>
                <br>
                <div class="col-sm-3"><input type="submit" class="btn btn-primary" value="Search"></div>
            </form>
        </div>

    </h4>
    <div>
        <table>
            <thead>
                <th>First name
                    <span>
                        <a href="{{ url('admindaludes') }}"><i class="bi bi-arrow-up"></i></a>
                        <a href="{{ url('admindalu') }}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Last name
                    <span>
                        <a href="{{ url('displayallUserlndes') }}"><i class="bi bi-arrow-up"></i></a>
                        <a href="{{ url('displayallUserelnasc') }}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Email
                    <span>
                        <a href="{{ url('displayallUseremdes') }}"><i class="bi bi-arrow-up"></i></a>
                        <a href="{{ url('displayallUseremasc') }}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ($displayau as $au)
                    <tr>
                        <td>{{ $au->userFirstName }}</td>
                        <td>{{ $au->userLastName }}</td>
                        <td>{{ $au->userEmail }}</td>
                        <td><a href="{{ url('deleteuser', $au->id) }}" class="signinupbtndel"><i class="bi-trash"></i></a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="pagi" style="margin-left:645px">
            {{ $displayau->links() }}
        </div>
    </div>
@endsection
