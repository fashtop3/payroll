@extends('app')

@section('content')

    <div id="page-title">
        <h2>Tax Report</h2>
        <p>Staffs.</p>
    </div>

    <div class="panel">
        <div class="panel-body">

            <div class="mar20B">

                <div class="clearfix"></div>
            </div>

            <h3 class="title-hero"></h3>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    <strong>Error!</strong> {!! Session::get('error') !!}
                </div>
            @endif

            <table class="table">
                <tr class="font-size-13">
                    <th>S/N</th>
                    <th>DEPARTMENT</th>
                    <th>STAFF(s)</th>
                    <th>CREATED AT</th>
                    <th colspan="2"></th>
                </tr>
                <tbody class="font-size-12">

                </tbody>
            </table>

        </div>
    </div>

@endsection