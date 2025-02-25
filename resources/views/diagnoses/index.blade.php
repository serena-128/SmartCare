@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Diagnoses</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('diagnoses.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="diagnoses-table"> 
                    <thead>
                        <th>Resident</th> <!-- Changed from ResidentID -->
                        <th>Diagnosis</th>
                        <th>Vital Signs</th>
                        <th>Treatment</th>
                        <th>Test Results</th>
                        <th>Notes</th>
                        <th>Last Updated By</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    @foreach($diagnoses as $diagnosis)
                        <tr>
                            <td>
                                @if($diagnosis->resident)
                                    {{ $diagnosis->resident->firstname }} {{ $diagnosis->resident->lastname }}
                                @else
                                    <span class="text-danger">Unknown</span>
                                @endif
                            </td>
                            <td>{!! $diagnosis->diagnosis !!}</td>
                            <td>{!! $diagnosis->vitalsigns !!}</td>
                            <td>{!! $diagnosis->treatment !!}</td>
                            <td>{!! $diagnosis->testresults !!}</td>
                            <td>{!! $diagnosis->notes !!}</td>
                            <td>{!! $diagnosis->lastupdatedby !!}</td>
                            <td>
                                {!! Form::open(['route' => ['diagnoses.destroy', $diagnosis->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('diagnoses.show', [$diagnosis->id]) !!}" class='btn btn-default btn-xs'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href="{!! route('diagnoses.edit', [$diagnosis->id]) !!}" class='btn btn-default btn-xs'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                        'type' => 'submit', 
                                        'class' => 'btn btn-danger btn-xs', 
                                        'onclick' => "return confirm('Are you sure?')"
                                    ]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
