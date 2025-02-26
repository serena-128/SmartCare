@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            member
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($member, ['route' => ['members.update', $member->id], 'method' => 'patch']) !!}

                        @include('members.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection