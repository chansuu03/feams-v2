<?php 
    $activeElection = 0;
    foreach($elections as $election) {
        if($election['status'] == 'a') {
            $activeElection = 1;
        }
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Set Elections</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if($activeElection > 0):?>
            <div class="alert alert-danger" role="alert">
               There are currently active election, please deactivate it first.
            </div>
        </div>
        <?php else:?>
                <?= form_open_multipart('election/set');?>
                <div class="form-group">
                    <label for="election_title">Election Title</label>
                    <input type="text" class="form-control" id="election_title" name="election_title" placeholder="Officer Election">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <!-- <div class="form-group">
                    <label for="dates">Start and End Date</label>
                    <input type="text" class="form-control" id="dates" name="dates">
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            <?= form_close();?>
        <?php endif;?>
    </div>
  </div>
</div>