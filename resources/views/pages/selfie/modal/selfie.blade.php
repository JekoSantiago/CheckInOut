<div class="modal fade" id="modalSelfie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title" id="myModalLabel">Submit Selfie</h4>
        </div>
        <div class="modal-body">
          <div class="media">
                <div id="pic"></div>
                <div id="time">
                    <h4>@php echo "Time Log: " . date("h:i A") @endphp</h4>
                </div>
          </div>
          <div class="form-group">

                <div>
                    <label for="DC">DC:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                    <select name="DC" id="DC" class="form-control nosearch">
                        <option value="0"></option>
                    </select>
                </div>
            <br>
            <div>
                <label for="store">Store:&nbsp; &nbsp; &nbsp;</label>
                <select name="store" id="store" class="form-control select2">
                    <option value="0"></option>
                </select>
            </div>
            <br>
            <div>
                <label for="logtype">IN/OUT: </label>
                <select name="logtype" id="logtype" class="form-control nosearch">
                    <option value="1">IN</option>
                    <option value="0">OUT</option>
                </select>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
          <button type="button" class="btn btn-primary" id="submit">Submit</button>
          <button type="button" class="btn btn-primary" id="load" style="display: none" disabled>Please Wait...</button>
        </div>
      </div>
    </div>
  </div>
