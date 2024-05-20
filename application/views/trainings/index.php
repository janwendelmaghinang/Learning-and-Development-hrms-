

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Training</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Training</li>
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

        <?php if(in_array('createTraining', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Training</button>
          <br /> <br />
        <?php endif; ?>

        <select class="form-control input-sm"id="managesFilter" style="width: 200px;">
          <option value="">All</option>
          <option value="pending">Pending</option>
          <option value="started">Started</option>
          <option value="completed">Completed</option>
          <option value="terminated">Terminated</option>
        </select>

        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">Manage Training</h3> -->
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Employee</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Date Created</th>
                <th>Course</th>
                <th>Grade</th>
                <th>Status</th>
                <?php if(in_array('updateTraining', $user_permission) || in_array('deleteTraining', $user_permission)): ?>
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

<?php if(in_array('createTraining', $user_permission)): ?>
<!-- create training modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Training</h4>
      </div>

      <form role="form" action="<?php echo base_url('trainings/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="department_id">Department</label>
            <select class="form-control" name="department_id" id="department_id"onChange="getDesignation()">
              <option value="">Select Department</option>
              <?php  foreach ($departments as $v): ?>
                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="designation_id">Designation</label>
            <select class="form-control" name="designation_id" id="designation_id" onChange="getEmployee()">
            </select>
          </div>
         
          <div class="form-group">
            <label for="employee_id">Employee</label>
            <select class="form-control" name="employee_id" id="employee_id">
            </select>
          </div>

          <div class="form-group">
            <label for="course_id">Course</label>
            <select class="form-control" name="course_id" id="course_id">
              <option value="">Select Course</option>
              <?php  foreach ($courses as $v): ?>
                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" type="text" name="desc" id="desc" cols="30" rows="10"></textarea>
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

<?php if(in_array('updateTraining', $user_permission)): ?>
<!-- edit training modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Training</h4>
      </div>

      <form role="form" action="<?php echo base_url('trainings/update') ?>" method="post" id="editForm">

        <div class="modal-body">

          <!-- <div class="form-group">
            <label for="edit_department_id">Department</label>
            <select class="form-control" name="edit_department_id" id="edit_department_id"onChange="getDesignation()">
              <option value="">Select Department</option>
              <?php  foreach ($departments as $v): ?>
                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="edit_designation_id">Designation</label>
            <select class="form-control" name="edit_designation_id" id="edit_designation_id" onChange="getEmployee()">
            </select>
          </div> -->
         
          <div class="form-group">
            <label for="edit_type_id">Training Type</label>
            <select class="form-control" name="edit_type_id" id="edit_type_id">
              <option value="">Select Training Type</option>
              <?php  foreach ($types as $v): ?>
                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
    
        <div class="form-group">
            <label for="edit_start_date">Start Date</label>
            <input class="form-control" type="date" name="edit_start_date" id="edit_start_date">
          </div>
          
          <div class="form-group">
            <label for="edit_end_date">End Date</label>
            <input class="form-control" type="date" name="edit_end_date" id="edit_end_date">
          </div>

          <div class="form-group">
            <label for="edit_desc">Description</label>
            <textarea class="form-control" type="text" name="edit_desc" id="edit_desc" cols="30" rows="10"></textarea>
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

<?php if(in_array('deleteTraining', $user_permission)): ?>
<!-- remove training modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Training</h4>
      </div>

      <form role="form" action="<?php echo base_url('trainings/remove') ?>" method="post" id="removeForm">
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
  $("#trainingNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': '<?php echo base_url('trainings/fetchTrainingData') ?>',
    'order': []
  });
  
  $("#manageTable_filter.dataTables_filter").append('<label>Filter :</label>',$("#managesFilter")); //add filter using append
  
  var statusIndex = 0;
$("#manageTable th").each(function (i) {
  if ($($(this)).html() == "Status") {
    statusIndex = i; return false;
  }
});

//Use the built in datatables API to filter the existing rows by the Category column
$.fn.dataTable.ext.search.push(
  function (settings, data, dataIndex) {
    var selectedItem = $('#managesFilter').val()
    var category = data[statusIndex];
    if (selectedItem === "" || category.includes(selectedItem)) {
      return true;
    }
    return false;
  }
);

//Set the change event for the Category Filter dropdown to redraw the datatable each time
//a user selects a new filter.
$("#managesFilter").change(function (e) {
  manageTable.draw();
});
manageTable.draw();


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
    url: 'fetchTrainingDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      // $("#edit_department_id").val(response.department.id);
      $("#edit_type_id").val(response.type_id);
      $("#edit_start_date").val(response.startdate);
      $("#edit_end_date").val(response.enddate);
      $("#edit_desc").val(response.description);
       
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
              $("#editForm .form-group").removeClass('has-error').removeClass('has-success');

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
        data: { training_id:id }, 
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
          getEmployee(); // call the employee function   
      }
    });
}else{
  // clear the designation form
  $('#designation_id').html('');
}
// if(edit_id){
//   $.ajax({
//       url: '<?php echo base_url('Designations/fetchDesignationByDeptId/')?>'+edit_id,
//       type: 'get',
//       dataType: 'json',
//       success:function(response){
//           $('#edit_designation_id').html('');
//           for(var i = 0; i < response.length; i++){
//             $('#edit_designation_id').append(
//               '<option value="'+response[i].id+'">'+ response[i].name +'</option>'
//             )
//           }
//       }
//     });
// }else{
//   // clear the designation form
//   $('#edit_designation_id').html('');
// }

}

function getEmployee(){
var department_id = document.querySelector('#department_id').value
var designation_id = document.querySelector('#designation_id').value
if(department_id && designation_id){
  $.ajax({
      url: '<?php echo base_url('Employee/fetchEmployeeByDeptId_DesigId')?>',
      type: 'post',
      data: { dept_id:department_id, desig_id: designation_id }, 
      dataType: 'json',
      success:function(response){
        if(response.success == true){

            for(var i = 0; i < response.results.length; i++){
              $('#employee_id').append(
                '<option value="'+ response.results[i].id +'">'+ response.results[i].firstname +' '+response.results[i].lastname +'</option>'
              )
            }
        }else{
            $('#employee_id').html('');
        }
      }
    });
}else{
  // clear the designation form
  $('#employee_id').html('');
}
}
</script>
