<?= $this->extend('Modules\Views\template');?>

<?= $this->section('content_header');?>

<div class="col-sm-6">
  <h1 class="m-0 text-dark">Roles</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item active">Roles</li>
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
<?php endif;?>

<div class="card">
  <div class="card-header bg-light">
    <div class="d-flex justify-content-between">
        <span style="margin-top: 3px;">Roles</span>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addRoleModal">
            New Role
        </button>
    </div>
  </div>
  <div class="card-body">
    <table id="roles" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Role Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $cnt = 1;?>
            <?php foreach($roles as $role):?>
                <tr>
                    <td><?= $cnt?></td>
                    <td><?= $role['role_name']?></td>
                    <td>
                        <?php
                            if($role['status'] == 'a') {
                                echo 'active';
                            }
                            else {
                                echo 'inactive';
                            }
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm del" value="<?= $role['role_id']?>">Delete</button>
                    </td>
                </tr>
                <?php $cnt++;?>
            <?php endforeach;?>
        </tbody>
    </table>
  </div>
</div>

<?= $this->include('Modules\Users\Views\Roles\addRole') ?>
<?= $this->endSection();?>

<?= $this->section('scripts');?>

<script type="text/javascript">

  $(document).ready(function ()
  {
    $('.del').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();

      Swal.fire({
        icon: 'question',
        title: 'Delete role?',
        text: 'User role will be deleted, are you sure?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        if (result.isConfirmed)
        {
          window.location = 'roles/del/' + id ;
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });
  });
</script>

<script type="text/javascript">
  $(function () {
  $('#roles').DataTable({
    "responsive": true,
    "autoWidth": false,
    });
  });

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<?= $this->endSection();?>
