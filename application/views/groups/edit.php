

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
        <li><a href="<?php echo base_url('groups/') ?>">Role</a></li>
        <li class="active">Edit</li>
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
              <h3 class="box-title">Edit Role</h3>
            </div>
            <form role="form" action="<?php base_url('groups/update') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Role Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter role name" value="<?php echo $group_data['group_name']; ?>">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <?php $serialize_permission = unserialize($group_data['permission']); ?>
                  
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
                        <td><input type="checkbox" class="minimal" name="permission[]" id="permission" class="minimal" value="createUser" <?php if($serialize_permission) {
                          if(in_array('createUser', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateUser" <?php 
                        if($serialize_permission) {
                          if(in_array('updateUser', $serialize_permission)) { echo "checked"; } 
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewUser" <?php 
                        if($serialize_permission) {
                          if(in_array('viewUser', $serialize_permission)) { echo "checked"; }   
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteUser" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteUser', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Roles</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('createGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('updateGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('viewGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Departments</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createDepartment" <?php if($serialize_permission) {
                          if(in_array('createDepartment', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateDepartment" <?php if($serialize_permission) {
                          if(in_array('updateDepartment', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewDepartment" <?php if($serialize_permission) {
                          if(in_array('viewDepartment', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteDepartment" <?php if($serialize_permission) {
                          if(in_array('deleteDepartment', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Designation</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createDesignation" <?php if($serialize_permission) {
                          if(in_array('createDesignation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateDesignation" <?php if($serialize_permission) {
                          if(in_array('updateDesignation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewDesignation" <?php if($serialize_permission) {
                          if(in_array('viewDesignation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteDesignation" <?php if($serialize_permission) {
                          if(in_array('deleteDesignation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Employee</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createEmployee" <?php if($serialize_permission) {
                          if(in_array('createEmployee', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateEmployee" <?php if($serialize_permission) {
                          if(in_array('updateEmployee', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewEmployee" <?php if($serialize_permission) {
                          if(in_array('viewEmployee', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteEmployee" <?php if($serialize_permission) {
                          if(in_array('deleteEmployee', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Indicator</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createIndicator" <?php if($serialize_permission) {
                          if(in_array('createIndicator', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateIndicator" <?php if($serialize_permission) {
                          if(in_array('updateIndicator', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewIndicator" <?php if($serialize_permission) {
                          if(in_array('viewIndicator', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteIndicator" <?php if($serialize_permission) {
                          if(in_array('deleteIndicator', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Appraisal</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createAppraisal" <?php if($serialize_permission) {
                          if(in_array('createAppraisal', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateAppraisal" <?php if($serialize_permission) {
                          if(in_array('updateAppraisal', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewAppraisal" <?php if($serialize_permission) {
                          if(in_array('viewAppraisal', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteAppraisal" <?php if($serialize_permission) {
                          if(in_array('deleteAppraisal', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Training Types</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createTrainingTypes" <?php if($serialize_permission) {
                          if(in_array('createTrainingTypes', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateTrainingTypes" <?php if($serialize_permission) {
                          if(in_array('updateTrainingTypes', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewTrainingTypes" <?php if($serialize_permission) {
                          if(in_array('viewTrainingTypes', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteTrainingTypes" <?php if($serialize_permission) {
                          if(in_array('deleteTrainingTypes', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td>Course</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCourse" <?php if($serialize_permission) {
                          if(in_array('createCourse', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCourse" <?php if($serialize_permission) {
                          if(in_array('updateCourse', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCourse" <?php if($serialize_permission) {
                          if(in_array('viewCourse', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCourse" <?php if($serialize_permission) {
                          if(in_array('deleteCourse', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td>Material</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createMaterial" <?php if($serialize_permission) {
                          if(in_array('createMaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateMaterial" <?php if($serialize_permission) {
                          if(in_array('updateMaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewMaterial" <?php if($serialize_permission) {
                          if(in_array('viewMaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteMaterial" <?php if($serialize_permission) {
                          if(in_array('deleteMaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td>Assessment</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createAssessment" <?php if($serialize_permission) {
                          if(in_array('createAssessment', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateAssessment" <?php if($serialize_permission) {
                          if(in_array('updateAssessment', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewAssessment" <?php if($serialize_permission) {
                          if(in_array('viewAssessment', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteAssessment" <?php if($serialize_permission) {
                          if(in_array('deleteAssessment', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      
                      <tr>
                        <td>Employee assessment</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewTest" <?php if($serialize_permission) {
                          if(in_array('viewTest', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                      </tr>
                      
                      <tr>
                        <td>Training</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createTraining" <?php if($serialize_permission) {
                          if(in_array('createTraining', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateTraining" <?php if($serialize_permission) {
                          if(in_array('updateTraining', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewTraining" <?php if($serialize_permission) {
                          if(in_array('viewTraining', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteTraining" <?php if($serialize_permission) {
                          if(in_array('deleteTraining', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td>Trainer</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createTrainer" <?php if($serialize_permission) {
                          if(in_array('createTrainer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateTrainer" <?php if($serialize_permission) {
                          if(in_array('updateTrainer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewTrainer" <?php if($serialize_permission) {
                          if(in_array('viewTrainer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteTrainer" <?php if($serialize_permission) {
                          if(in_array('deleteTrainer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Events</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createEvents" <?php if($serialize_permission) {
                          if(in_array('createEvents', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateEvents" <?php if($serialize_permission) {
                          if(in_array('updateEvents', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewEvents" <?php if($serialize_permission) {
                          if(in_array('viewEvents', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteEvents" <?php if($serialize_permission) {
                          if(in_array('deleteEvents', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Reports</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewReports" <?php if($serialize_permission) {
                          if(in_array('viewReports', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCompany" <?php if($serialize_permission) {
                          if(in_array('updateCompany', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProfile" <?php if($serialize_permission) {
                          if(in_array('viewProfile', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSetting" <?php if($serialize_permission) {
                          if(in_array('updateSetting', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
    $("#manageGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>
