

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Role</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">role</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
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

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Role</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Role Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter role name">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Role</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Departments</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDepartment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDepartment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDepartment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDepartment" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Designation</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDesignation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDesignation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDesignation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDesignation" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Employee</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createEmployee" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateEmployee" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewEmployee" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteEmployee" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Indicator</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createIndicator" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateIndicator" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewIndicator" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteIndicator" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Appraisal</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAppraisal" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAppraisal" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAppraisal" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAppraisal" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Training Types</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createTrainingTypes" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateTrainingTypes" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewTrainingTypes" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteTrainingTypes" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Course</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCourse" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCourse" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCourse" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCourse" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Material</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createMaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateMaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewMaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteMaterial" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Assessment</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAssessment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAssessment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAssessment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAssessment" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Training</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createTraining" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateTraining" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewTraining" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteTraining" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Trainer</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createTrainer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateTrainer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewTrainer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteTrainer" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Events</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createEvents" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateEvents" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewEvents" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteEvents" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Reports</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReports" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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

<script type="text/javascript">
  $(document).ready(function() {
    $("#mainGroupNav").addClass('active');
    $("#addGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>

