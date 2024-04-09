

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Assessments</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Assessments</li>
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

        <?php if(in_array('createAssessment', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Assessment</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">Manage Assessment</h3> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Course</th>
                <th>Passing Grade <span class="text-danger">%</span></th>
                <th>Max Attempt</th>
                <?php if(in_array('updateAssessment', $user_permission) || in_array('deleteAssessment', $user_permission)): ?>
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

<?php if(in_array('createAssessment', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Assessment info</h4>
      </div>

      <form role="form" action="<?php echo base_url('assessments/create') ?>" method="post" id="createForm">

        <div class="modal-body">
         
          <div class="form-group">
            <label for="course_id">Courses</label>
            <select class="form-control" name="course_id" id="course_id">
              <option value="">Select Course</option>
              <?php foreach($courses as $v): ?>
                <option value="<?php echo $v['id'] ?>"> <?php echo $v['name'] ?> </option>
              <?php endforeach ?>
            </select>
          </div>
          
          <div class="grid grid-cols-2 gap-3 border  p-3">
            <div class="w-full">
              <div class="form-group">
                <label for="duration">Duration</label>
                <input type="number" class="form-control" id="duration" name="duration">
              </div>
            </div>
            <div class="w-full">
               <div class="form-group">
                <label for="time_type">Type</label>
                 <select name="" id="" class="form-control">
                 <option value="minute">Minutes</option>
                  <option value="hour">Hours</option>
                 </select>
               </div>
            </div>
          </div>

          <div class="form-group">
            <label for="passing">Passing Grade<span class="text-success">(%)</span></label>
            <input type="number" class="form-control" id="passing" name="passing">
          </div>

          <div class="form-group">
            <label for="attempt">Max Attempt</label>
            <input type="number" class="form-control" id="attempt" name="attempt" >
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

<?php if(in_array('updateAssessment', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Assessment</h4>
      </div>

      <form role="form" action="<?php echo base_url('Assessment/update') ?>" method="post" id="editForm">

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
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Leave the password field empty if you don't want to change.
            </div>
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

<?php if(in_array('deleteAssessment', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Assessment</h4>
      </div>

      <form role="form" action="<?php echo base_url('assessments/remove') ?>" method="post" id="removeForm">
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
  $("#assessmentNav").addClass('active');
  $("#mainCourseNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': '<?php echo base_url('Assessments/fetchAssessmentData') ?>',
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
          } 
          else 
          {
            $("#addModal").modal('hide');

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
    url: 'fetchAssessmentDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      
      $("#edit_firstname").val(response.firstname);
      $("#edit_lastname").val(response.lastname);
      $("#edit_email").val(response.email);
      $("#edit_username").val(response.username);
      $("#edit_department_id").val(response.department_id);
     
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
        data: { assessment_id:id }, 
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
          $('#designation_id').append('<option value="">Select Designation</option>');

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
