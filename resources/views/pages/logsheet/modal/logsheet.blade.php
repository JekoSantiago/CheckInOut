<div class="modal fade" id="modalLogsheet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title" id="myModalLabel">Insert Logsheet</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <input type="hidden" id="LogID">
                <div>
                    <label for="DC">DC/Branch:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
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
                <label for="logdate">Date: </label>
                <input type="date" id="logdate" name="logdate" class="form-control border">
            </div>
            <br>
            <div>
                <label for="logdate">Time: </label>
                <input type="time" id="logtime" name="logtime" class="form-control border">
            </div>
            <br>
            <div>
                <label for="logtype">IN/OUT: </label>
                <select name="logtype" id="logtype" class="form-control nosearch">
                    <option value="1">IN</option>
                    <option value="0">OUT</option>
                </select>
            </div>
            <div>
                <label for="reason">Reason</label>
                <textarea name="reason" id="reason" cols="30" rows="3" class="form-control"></textarea>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
          <button type="button" class="btn btn-primary" id="submit" style="display: none">Submit</button>
          <button type="button" class="btn btn-warning" id="update" style="display: none">Update</button>
          <button type="button" class="btn btn-primary" id="load" style="display: none" disabled>Please Wait...</button>
        </div>
      </div>
    </div>
  </div>
