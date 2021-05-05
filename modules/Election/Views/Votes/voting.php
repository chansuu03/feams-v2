<?= $this->extend('Modules\Views\template');?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Voting</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item active">Elections</li>
    <li class="breadcrumb-item active">Voting</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php if(!empty(session()->getFlashdata('failMsg'))):?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('failMsg');?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php elseif(!empty(session()->getFlashdata('successMsg'))):?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('successMsg');?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php elseif(isset($voted)):?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    You have voted, please wait for the results
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>  
<?php endif;?>
<!-- if user voted -->
<?php if(isset($voted)):?>
<?php foreach($positions as $position):?>
  <?php foreach($votes as $vote):?>
  <?php if($position['id'] == $vote['position_id']):?>
    <div class="card">
      <div class="card-header">
          <?= $position['description']?>
      </div>
      <div class="card-body">
      <ul class="list-group">
        <li class="list-group-item"><?= $vote['first_name']?> <?= $vote['last_name']?></li>
      </ul>
      </div>
    </div>
  <?php endif;?>
<?php endforeach;?>
<?php endforeach;?>

<?php else:?>
<!-- if user not voted -->
<?= form_open_multipart('election/vote')?>
<input type="hidden" id="election_id" name="election_id" value="<?= $activeElection?>">
<?php foreach($positions as $position):?>
    <div class="card">
        <div class="card-header">
            <?= $position['description']?>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <?php foreach($candidates as $candidate):?>
              <?php if($candidate['position'] == $position['description']):?>
                <li class="list-group-item">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?= $candidate['position_id']?>" id="exampleRadios1" value="<?= $candidate['id']?>" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      <?= $candidate['first_name'] . ' ' .$candidate['last_name']?>
                    </label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?= $candidate['position_id']?>" id="exampleRadios1" value="0" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      Abstain
                    </label>
                  </div>
                </li>
              <?php endif;?>
            <?php endforeach;?>
          </ul>
        </div>
    </div>
<?php endforeach;?>

<input class="btn btn-primary btn-sm" type="submit" value="Submit">
<?= form_close();?>
<?php endif;?>
<?= $this->endSection();?>

<?= $this->section('scripts') ?>


<?= $this->endSection();?>
