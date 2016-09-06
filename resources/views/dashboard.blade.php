
@extends('app')

@section('content')

    <div id="page-title">
        <h2>Dashboard</h2>
        <p>Update profile information.</p>
    </div>

    <div class="panel">
            <div class="panel-body">

                <div class="col-sm-10 col-sm-offset-1">
                    <h2 class="invoice-client mrg10T">Personal Information</h2>
                    <ul class="reset-ul">
                        <li><b>Email:</b> {{Auth::user()->email}}</li>
                        <li><b>First Name:</b> {{Auth::user()->firstname}}</li>
                        <li><b>Last Name:</b> {{Auth::user()->lastname}}</li>
                        <li><b>Mobile:</b> {{Auth::user()->mobile ? Auth::user()->mobile : 'xxxxxxxxxxx'}}</li>
                        <li><b>Address:</b> {{Auth::user()->address ? Auth::user()->address : 'xxxxxxxxxxx'}}</li>
                    </ul>
                </div>
            </div>
    </div>

@endsection