

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Courses</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Courses</li>
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

        <?php if(in_array('createCourse', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Courses</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">Manage Course</h3> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Duration</th>
                <!-- <th>Validity</th>
                <th>Start Date</th>
                <th>End Date</th> -->
                <!-- <th>Expired</th> -->
                <?php if(in_array('updateCourse', $user_permission) || in_array('deleteCourse', $user_permission)): ?>
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

<?php if(in_array('createCourse', $user_permission)): ?>
<!-- create courses modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Courses</h4>
      </div>

      <form role="form" action="<?php echo base_url('courses/create') ?>" method="post" id="createForm">

        <div class="modal-body">
         
          <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Enter course Name" autocomplete="off">
          </div>
          
          <div class="grid grid-cols-2 gap-2">
            <div class="form-group">
              <label for="duration">Duration</label>
              <input type="number" class="form-control" id="duration" name="duration"  autocomplete="off">
            </div>
            <div class="form-group">
              <label for="duration_type">Type</label>
              <select name="duration_type" id="duration_type" class="form-control">
                <option value="minutes">minutes</option>
                <option value="hours">hours</option>
              </select>
              </div>
          </div>
       
          <div class="form-group">
            <label for="department_id">Department</label>
            <select class="form-control" name="department_id" id="department_id" onChange="getDesignation()">
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

<?php if(in_array('updateCourse', $user_permission)): ?>
<!-- edit courses modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Course</h4>
      </div>

      <form role="form" action="<?php echo base_url('courses/update') ?>" method="post" id="editForm">

        <div class="modal-body">
         
        <div class="form-group">
            <label for="edit_course_name">Course Name</label>
            <input type="text" class="form-control" id="edit_course_name" name="edit_course_name" placeholder="Enter Course" autocomplete="off">
          </div>
          
          <div class="grid grid-cols-2 gap-2">
            <div class="form-group">
              <label for="edit_duration">Duration</label>
              <input type="number" class="form-control" id="edit_duration" name="edit_duration" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="edit_duration_type">Type</label>
              <select name="edit_duration_type" id="edit_duration_type" class="form-control">
                <option value="minutes">minutes</option>
                <option value="hours">hours</option>
              </select>
              </div>
          </div>
       
          <!-- <div class="form-group">
            <label for="edit_department_id">Department</label>
            <select class="form-control" name="edit_department_id" id="edit_department_id"onChange="getDesignation()">
              <option value="">Select Department</option>
              <?php foreach ($departments as $v): ?>
                <option value="<?php echo $v['id'] ?>"> <?php echo $v['name'] ?> </option>
              <?php endforeach ?>
            </select>
          </div> -->

          <!-- <div class="form-group">
            <label for="edit_designation_id">Designation</label>
            <select class="form-control" name="edit_designation_id" id="edit_designation_id">
            </select>
          </div> -->

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

<?php if(in_array('deleteCourse', $user_permission)): ?>
<!-- remove courses modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Course</h4>
      </div>

      <form role="form" action="<?php echo base_url('courses/remove') ?>" method="post" id="removeForm">
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
  $("#courseNav").addClass('active');
  $("#mainCourseNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': '<?php echo base_url('courses/fetchCourseData') ?>',
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
    url: '<?php echo base_url('courses/fetchCourseDataById/')?>'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      
      $("#edit_course_name").val(response.name);
      $("#edit_duration").val(response.duration);
      $("#edit_duration_type").val(response.duration_type);
      // $("#edit_department_id").val(response.department_id);
      // $("#edit_designation_id").val(response.designation_id);
     
      // call the function
      // getDesignation();

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
        data: { course_id:id }, 
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
// var edit_id = document.querySelector('#edit_department_id').value

console.log(id)

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
