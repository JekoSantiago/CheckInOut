@extends('layouts.main')
@section('content')
<input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
    <section class="body-content">
       <div class="row">
            <div class="block-header col-sm-11">
                <h2>Selfie</h2>
            </div>
        </div>

        <div class="centered">
            <div id="my_camera"></div>
            <div class="mt-5">
                <button class="buttonsnap" id="snap">&nbsp;<i class="material-icons"> circle </i>&nbsp;</button>
            </div>
            <input type="hidden" name="image" class="image-tag">
        </div>

        <input type="hidden" id="lat" name="lat">
        <input type="hidden" id="long" name="long">


    @include('pages.selfie.modal.selfie')
    </section>
    @section('js')
        <script src="{{ URL::asset('custom/js/selfie.js')}}"></script>
        <script src="{{ URL::asset('template/plugins/webcam/webcam.min.js')}}"></script>
    @endsection
@stop

