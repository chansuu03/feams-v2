<?= $this->extend('Modules\Views\template');?>

<?= $this->section('styles');?>

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/daterangepicker/daterangepicker.css">

<?= $this->endSection();?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Elections</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item active">Elections</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>

<div class="row">
  <div class="col-md-12">
      <?php if(session()->getFlashdata('msg')):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('msg') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif;?>
      <?php if(session()->getFlashdata('failedmsg')):?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-triangle"></i> <?= session()->getFlashdata('failedmsg') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif;?>
  </div>
</div>
<!-- <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-body">
      <div class="row">
        <div class="col">
            <div class="row">
                <h2>6</h2>
            </div>
            <div class="row">
                <h5>No. of Candidates</h5>
            </div>
        </div>
        <div class="col">
            <h1><i class="fas fa-user"></i></h1>
        </div>
      </div>
  </div>
  <div class="card-footer bg-light">Footer</div>
</div> -->


<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
          <span style="margin-top: 3px;">Elections</span>
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalLong">
            Set Elections
          </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Election Name</th>
                <th>Description</th>
                <th>Positions</th>
                <th>Candidates</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($elections as $election):?>
                <tr>
                  <td><?= $election['election_title']?></td>
                  <td><?= $election['description']?></td>
                  <td>0</td>
                  <td>0</td>
                  <td>
                    <?php if($election['status'] == 'a') echo 'active'; else echo 'inactive';?>
                  </td>
                  <td>del</td>
                </tr>
              <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<?= view('Modules\Election\Views\Elections\set');?>

<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<script>  
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $('input[name="dates"]').daterangepicker();
  });
</script>

<?= $this->endSection();?>