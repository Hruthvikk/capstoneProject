@extends('adminmain')
@section('content')
     <div>
        <table>
            <thead>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ($dau as $au )
                <tr>
                    <td>{{$au->userFirstName}}</td>
                    <td>{{$au->userLastName}}</td>
                    <td>{{$au->userEmail}}</td>
                    <td><a href="{{url('deleteuser',$au->id)}}" class="btn btn-danger">D</a></td>
                </tr>       
                @endforeach
                
            </tbody>
        </table>
     </div>
@endsection