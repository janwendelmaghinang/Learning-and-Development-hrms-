

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Indicator</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Indicator</li>
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

        <?php if(in_array('createIndicator', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addIndicatorModal">Add Indicator</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">Manage Indicators</h3> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Department</th>
                <th>Designation</th>
                <th>Target Rating</th>
                <th>Employee Rating</th>
                <th>Status</th>
                <?php if(in_array('updateIndicator', $user_permission) || in_array('deleteIndicator', $user_permission)): ?>
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

<?php if(in_array('createIndicator', $user_permission)): ?>
<!-- create Indicator modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addIndicatorModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Indicator</h4>
      </div>

      <form role="form" action="<?php echo base_url('Indicators/create') ?>" method="post" id="createIndicatorForm">

        <div class="modal-body">

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
             <table class="table table-striped">
                <tr>
                    <th>Key Indicator</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>leadership</td>
                    <td>
                        <select class="form-control" name="" id="">
                            <option value="">poor</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Sales</td>
                    <td>
                        <select class="form-control" name="" id="">
                            <option value="">poor</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Enthusiasm</td>
                    <td>
                        <select class="form-control" name="" id="">
                            <option value="">poor</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Teamwork</td>
                    <td>
                        <select class="form-control" name="" id="">
                            <option value="">poor</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Integrity</td>
                    <td>
                        <select class="form-control" name="" id="">
                            <option value="">poor</option>
                        </select>
                    </td>
                </tr>
                
             </table>
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

<?php if(in_array('updateIndicator', $user_permission)): ?>
<!-- edit Indicator modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editIndicatorModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Indicator</h4>
      </div>

      <form role="form" action="<?php echo base_url('Indicators/update') ?>" method="post" id="updateIndicatorForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_Indicator_name">Indicator Name</label>
            <input type="text" class="form-control" id="edit_Indicator_name" name="edit_Indicator_name" placeholder="Enter Indicator name" autocomplete="off">
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
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteIndicator', $user_permission)): ?>
<!-- remove Indicator modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeIndicatorModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Indicator</h4>
      </div>

      <form role="form" action="<?php echo base_url('Indicators/remove') ?>" method="post" id="removeIndicatorForm">
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

  $("#indicatorNav").addClass('active');
  $("#mainPerformanceNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': '<?php echo base_url('indicators/fetchIndicatorData') ?>',
    'order': []
  });

  // submit the create from 
  $("#createIndicatorForm").unbind('submit').on('submit', function() {
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
          $("#addIndicatorModal").modal('hide');

          // reset the form
          $("#createIndicatorForm")[0].reset();
          $("#createIndicatorForm .form-group").removeClass('has-error').removeClass('has-success');

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

function editIndicator(id)
{ 
  $.ajax({
    url: 'fetchIndicatorDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_Indicator_name").val(response.name);
      $("#edit_active").val(response.active);

      // submit the edit from 
      $("#updateIndicatorForm").unbind('submit').bind('submit', function() {
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
              $("#editIndicatorModal").modal('hide');
              // reset the form 
              $("#updateIndicatorForm .form-group").removeClass('has-error').removeClass('has-success');

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

function removeIndicator(id)
{
  if(id) {
    $("#removeIndicatorForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { Indicator_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeIndicatorModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 

            // hide the modal
            $("#removeIndicatorModal").modal('hide');
          }
        }
      }); 

      return false;
    });
  }
}


function getDesignation(){
    var id = document.querySelector('#department_id').value
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
}


</script>
