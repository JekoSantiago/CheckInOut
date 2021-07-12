
            <form id="FilteringForm"  class="keepFormData">
                <input type="hidden" name="_token" id="tokenfield" value="{{csrf_token()}}" />
                <div class="row clearfix">
                <div class="col-sm-2">
                    <label for="dateFrom">Date Start</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" value="{{$paramCheckInOut['dateFrom']}}"  id="dateFrom" name="dateFrom" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="dateTo">Date End</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" value="{{$paramCheckInOut['dateTo']}}" id="dateTo" name="dateTo" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="isApproved">Approval Status</label>
                    <div class="form-group">
                        <div class="form-line">
                            <select id="isApproved" name="isApproved" class="form-control">
                                <option value="0" @if ($paramCheckInOut['status'] == 0) selected = "selected" @endif>Pending for Approval</option>
                                <option value="1" @if ($paramCheckInOut['status'] == 1) selected = "selected" @endif>Done for Approval</option>
                                <option value="2" @if ($paramCheckInOut['status'] == 2) selected = "selected" @endif>Declined</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-sm-1">
                    <label for=""> </label>
                    <div class="form-group  form-float">
                            <button type="reset" id="BtnFilterReset" class="form-control btn btn-warning waves-effect btn-block">Reset</button>
                    </div>
                </div> --}}
                <div class="col-sm-1">
                    <label for=""> </label>
                    <div class="form-group  form-float">
                        <button id="BtnFilterSubmit" class="form-control btn btn-warning waves-effect btn-block">Search</button>
                </div>
            </div>
        </form>
