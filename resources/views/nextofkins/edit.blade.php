@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            nextofkin
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($nextofkin, ['route' => ['nextofkins.update', $nextofkin->id], 'method' => 'patch']) !!}

                        @include('nextofkins.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection