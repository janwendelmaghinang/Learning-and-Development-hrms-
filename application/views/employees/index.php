

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Employee</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Employee</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if(in_array('createEmployee', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Employee</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">Manage Employee</h3> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Date of joining</th>
                <?php if(in_array('updateEmployee', $user_permission) || in_array('deleteEmployee', $user_permission)): ?>
                  <th>Action</th>
                <?php endif; ?>
              </tr>
              </thead>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('createEmployee', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Employee</h4>
      </div>

      <form role="form" action="<?php echo base_url('Employee/create') ?>" method="post" id="createForm">

        <div class="modal-body">
         
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" autocomplete="off">
          </div>
          
          <div class="form-group">
            <label for="role">Role</label>
            <input disabled type="text" class="form-control" value="<?php echo $role['group_name']?>" autocomplete="off">
            <input hidden type="text" id="role" name="role" value="<?php echo $role['id']?>" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" autocomplete="off">
          </div>
        
          <div class="form-group">
            <label for="department_id">Department</label>
            <select class="form-control" name="department_id" id="department_id"onChange="getDesignation()">
              <option value="">Select Department</option>
              <?php foreach ($departments as $v): ?>
                <option value="<?php echo $v['id'] ?>"> <?php echo $v['name'] ?> </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="designation_id">Designation</label>
            <select class="form-control" name="designation_id" id="designation_id">
            </select>
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateEmployee', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Employee</h4>
      </div>

      <form role="form" action="<?php echo base_url('Employee/update') ?>" method="post" id="editForm">

        <div class="modal-body">
         
          <div class="form-group">
            <label for="edit_firstname">First Name</label>
            <input type="text" class="form-control" id="edit_firstname" name="edit_firstname" placeholder="Enter First Name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="edit_lastname">Last Name</label>
            <input type="text" class="form-control" id="edit_lastname" name="edit_lastname" placeholder="Enter Last Name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="edit_username">Username</label>
            <input type="text" class="form-control" id="edit_username" name="edit_username" placeholder="Enter username" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="edit_email">Email</label>
            <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="Enter Email" autocomplete="off">
          </div>
          
          <div class="form-group">
            <label for="edit_password">Password</label>
            <input type="password" class="form-control" id="edit_password" name="edit_password" placeholder="Enter Password" autocomplete="off">
          </div>
        
          <div class="form-group">
            <label for="edit_department_id">Department</label>
            <select class="form-control" name="edit_department_id" id="edit_department_id"onChange="getDesignation()">
              <option value="">Select Department</option>
              <?php foreach ($departments as $v): ?>
                <option value="<?php echo $v['id'] ?>"> <?php echo $v['name'] ?> </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="edit_designation_id">Designation</label>
            <select class="form-control" name="edit_designation_id" id="edit_designation_id">
            </select>
          </div>

          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteEmployee', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Employee</h4>
      </div>

      <form role="form" action="<?php echo base_url('Employee/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">
var manageTable;

$(document).ready(function() {
  $("#employeeNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': '<?php echo base_url('employee/fetchEmployeeData') ?>',
    'order': []
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });

});

// edit function
function edit(id)
{ 
  $.ajax({
    url: 'fetchEmployeeDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      
      $("#edit_firstname").val(response[0].firstname);
      $("#edit_lastname").val(response[0].lastname);
      $("#edit_email").val(response[0].email);
      $("#edit_username").val(response[0].username);
      $("#edit_department_id").val(response[0].department_id);
     
      // call the function
      getDesignation();

      // submit the edit from 
      $("#editForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  });
}

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { Employee_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#deleteModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 

            // hide the modal
            $("#deleteModal").modal('hide');
          }
        }
      }); 

      return false;
    });
  }
}

function getDesignation(){
var id = document.querySelector('#department_id').value
var edit_id = document.querySelector('#edit_department_id').value
if(id){
  $.ajax({
      url: '<?php echo base_url('Designations/fetchDesignationByDeptId/')?>'+id,
      type: 'get',
      dataType: 'json',
      success:function(response){
          $('#designation_id').html('');
          for(var i = 0; i < response.length; i++){
            $('#designation_id').append(
              '<option value="'+response[i].id+'">'+ response[i].name +'</option>'
            )
          }
      }
    });
}else{
  // clear the designation form
  $('#designation_id').html('');
}
if(edit_id){
  $.ajax({
      url: '<?php echo base_url('Designations/fetchDesignationByDeptId/')?>'+edit_id,
      type: 'get',
      dataType: 'json',
      success:function(response){
          $('#edit_designation_id').html('');
          for(var i = 0; i < response.length; i++){
            $('#edit_designation_id').append(
              '<option value="'+response[i].id+'">'+ response[i].name +'</option>'
            )
          }
      }
    });
}else{
  // clear the designation form
  $('#edit_designation_id').html('');
}
}
</script>
