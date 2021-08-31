
            <form id="FilteringForm" method="get" action="{{ URL::to('/home')}}" class="keepFormData">
                <input type="hidden" name="_token" id="tokenfield" value="{{csrf_token()}}" />
                <input type="hidden" name="posID" id ="posID" value="{{ MyHelper::decrypt(Session::get('PositionLevel_ID')) }}"
                <div class="row clearfix">
                <div class="col-sm-2">
                    <label for="dateFrom">Date Start</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" value="{{$paramCheckInOut['dateFrom']}}"  id="dateFrom" name="dateFrom" class="form-control df" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="dateTo">Date End</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" value="{{$paramCheckInOut['dateTo']}}" id="dateTo" name="dateTo" class="form-control df" />
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-3">
                    <label for="locationID">Location</label>
                    <div class="form-group">
                        <div class="form-line">
                            <select id="locationID" name="locationID" class="form-control">
                                <option value=""></option>
                                @foreach($locations as $location)
                                    <option value="{{$location->Location_ID}}" {{ $paramCheckInOut['locationID'] == $location->Location_ID ? ' selected ':''}}>{{$location->BranchName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> --}}
                <div class="col-sm-3">
                    <label for="employeeID">Employee</label>
                    <div class="form-group">
                        <div class="form-line">
                            <select id="employeeID" name="employeeID" class="form-control">
                                @if(MyHelper::decrypt(Session::get('PositionLevel_ID')) < 5)
                                <option value ="0">ALL</option>
                                @else
                                <option value="{{ $user }}">{{ $userName }}</option>
                                @endif
                                @foreach($employees as $employee)
                                    <option value="{{$employee->Employee_ID}}" {{ $paramCheckInOut['employeeID'] == $employee->Employee_ID ? ' selected ':''}}>{{$employee->FullName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1">
                    <label for=""> </label>
                    <div class="form-group  form-float">
                            <button type="reset" id="BtnFilterReset" class="form-control btn btn-warning waves-effect btn-block">Reset</button>
                    </div>
                </div>
                <div class="col-sm-1">
                    <label for=""> </label>
                    <div class="form-group  form-float">
                        <button type="submit" id="BtnFilterSubmit" class="form-control btn btn-warning waves-effect btn-block">Search</button>
                </div>
            </div>
        </form>
