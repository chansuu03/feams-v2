<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action='<?= base_url();?>/election/positions/edit' method="post" enctype="multipart/form-data" name="edit-position">
          <input type="hidden" id="election_id" name="election_id" value="<?= $activeElection?>">
          <input type="hidden" id="posID" name="posID" value="">
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="editDesc" placeholder="Description" name="description" value="">
          </div>
          <!-- <div class="form-group">
            <label for="max_vote">Max votes</label>
            <input type="number" class="form-control" id="max_vote" name="max_vote">
          </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <?= form_close();?>
    </div>
  </div>
</div>