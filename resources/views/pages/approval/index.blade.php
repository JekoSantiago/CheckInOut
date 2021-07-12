@extends('layouts.main')
@section('content')
    <section class="body-content">
       <div class="row">
            <div class="block-header col-sm-11">
                <h2>Approval</h2>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <div class="card">
            <div class="row">
                <div class="col-sm-12">
                    @include('pages.approval.forms.filtering-form')
                </div>
             </div>
        </div>
        <div class="row" style="margin-top: 1%">
        </div>
        @include('pages.approval.tables.approval-table')
        @include('pages.approval.modal.approval')

    </section>
    @section('js')
        <script src="{{ URL::asset('custom/js/approver.js')}}"></script>
    @endsection
@stop

