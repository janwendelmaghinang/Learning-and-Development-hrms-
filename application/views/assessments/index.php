

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
                <th>Passing Grade <span class="text-danger"></span></th>
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
                <label for="duration">Assessment Duration</label>
                <input type="number" class="form-control" id="duration" name="duration">
              </div>
            </div>
            <div class="w-full">
               <div class="form-group">
                <label for="duration_type">Type</label>
                 <select name="duration_type" id="" class="form-control">
                 <option value="minutes">minutes</option>
                  <option value="hours">hours</option>
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

      <form role="form" action="<?php echo base_url('assessments/update') ?>" method="post" id="editForm">

        <div class="modal-body">
         
          <div class="form-group">
            <label for="course_name">Courses</label>
            <input class="form-control" disabled type="text" name="course_name" id="course_name">
          </div>
          
          <div class="grid grid-cols-2 gap-3 border  p-3">
            <div class="w-full">
              <div class="form-group">
                <label for="edit_duration">Assessment Duration</label>
                <input type="number" class="form-control" id="edit_duration" name="edit_duration">
              </div>
            </div>
            <div class="w-full">
               <div class="form-group">
                <label for="edit_duration_type">Type</label>
                 <select name="edit_duration_type" id="edit_duration_type" class="form-control">
                 <option value="minutes">minutes</option>
                  <option value="hours">hours</option>
                 </select>
               </div>
            </div>
          </div>

          <div class="form-group">
            <label for="edit_passing">Passing Grade<span class="text-success">(%)</span></label>
            <input type="number" class="form-control" id="edit_passing" name="edit_passing">
          </div>

          <div class="form-group">
            <label for="edit_attempt">Max Attempt</label>
            <input type="number" class="form-control" id="edit_attempt" name="edit_attempt" >
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
    url: '<?php echo base_url('assessments/fetchAssessmentDataById/')?>'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      
      $("#course_name").val(response.course.name);
      $("#edit_duration").val(response.data.assessment_duration);
      $("#edit_duration_type").val(response.data.duration_type);
      $("#edit_passing").val(response.data.passing_grade);
      $("#edit_attempt").val(response.data.max_attempt);
     
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

</script>
