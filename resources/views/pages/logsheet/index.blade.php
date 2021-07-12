@extends('layouts.main')
@section('content')
    <section class="body-content">
       <div class="row">
            <div class="block-header col-sm-11">
                <h2>Manual Log</h2>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <div class="card">
            <div class="row">
                <div class="col-sm-12">
                    @include('pages.logsheet.forms.filtering-form')
                </div>
             </div>
        </div>
        <div class="row">
            <div class="col-sm-1">
                <button id="addLS" class="form-control btn btn-primary waves-effect btn-block" data-toggle="modal" data-target="#modalLogsheet">Add</button>
            </div>
        </div>
        <div class="row" style="margin-top: 1%">
        </div>
        @include('pages.logsheet.tables.logsheet-table')
        @include('pages.logsheet.modal.logsheet')
        @include('pages.logsheet.modal.photo')

    </section>
    @section('js')
        <script src="{{ URL::asset('custom/js/logsheet.js')}}"></script>
    @endsection
@stop

