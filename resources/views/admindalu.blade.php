@extends('adminmain')
@section('content')
     <div>
        <table>
            <thead>
                <th>First name
                    <span>
                    <a href="{{url('admindaludes')}}"><i class="bi bi-arrow-up"></i></a>
                    <a href="{{url('admindalu')}}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Last name
                <span>
                    <a href="{{url('displayallUserlndes')}}"><i class="bi bi-arrow-up"></i></a>
                    <a href="{{url('displayallUserelnasc')}}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
                <th>Email
                <span>
                    <a href="{{url('displayallUseremdes')}}"><i class="bi bi-arrow-up"></i></a>
                    <a href="{{url('displayallUseremasc')}}"><i class="bi bi-arrow-down"></i></a>
                    </span>
                </th>
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