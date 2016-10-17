
@extends('app')

@section('content')

    <div id="page-title">
        <h2>User Support</h2>
        <p>User Support.</p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">

            </h3>

            <table class="table">
                <tr class="font-size-13">
                    <th>S/N</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Last Modified</th>
                    <th colspan="2"></th>
                </tr>
                <tbody class="font-size-12">
                    <?php $i = 1; ?>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ucfirst($user->lastname)}}</td>
                            <td>{{ucfirst($user->firstname)}}</td>
                            <td>{{ucfirst($user->mobile)}}</td>
                            <td>{{ucfirst($user->email)}}</td>
                            <td>{{ucfirst($user->created_at->diffForHumans())}}</td>
                            <td>{{ucfirst($user->updated_at->diffForHumans())}}</td>
                            <td><button class="btn btn-xs btn-primary">View</button></td>
                            <td ng-hide="{{$user->id}}==1"><button class="btn btn-xs btn-danger">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection