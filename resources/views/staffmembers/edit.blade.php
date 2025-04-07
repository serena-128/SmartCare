@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            StaffMember
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($staffMember, ['route' => ['staffMembers.update', $staffMember->id], 'method' => 'patch']) !!}

                        @include('staffMembers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection