@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            dietaryrestriction
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($dietaryrestriction, ['route' => ['dietaryrestrictions.update', $dietaryrestriction->id], 'method' => 'patch']) !!}

                        @include('dietaryrestrictions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection