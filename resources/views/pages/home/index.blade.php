@extends('layouts.main')
@section('content')
    <section class="body-content"> 
       <div class="row">
            <div class="block-header col-sm-11">
                <h2>Monitoring</h2>
            </div> 
            <div class="col-sm-1"> 
            </div>
        </div>
        <div class="card">   
            <div class="row">
                <div class="col-sm-12">
                    @include('pages.home.forms.filtering-form')
                </div>
             </div> 
        </div> 
        @include('pages.home.tables.monitoring-table') 
    </section>  
    @section('js') 
        <script src="{{ URL::asset('custom/js/home.js')}}"></script>
    @endsection 
@stop

