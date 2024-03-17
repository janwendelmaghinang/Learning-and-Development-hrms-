<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        
      <?php if($user_permission): ?>
        <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Role</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Add Role</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Manage Role</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li class="treeview" id="mainUserNav">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createUser', $user_permission)): ?>
                  <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                <?php endif; ?>

                <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                  <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


          <?php if(in_array('createDepartment', $user_permission) || in_array('updateDepartment', $user_permission) || in_array('viewDepartment', $user_permission) || in_array('deleteDepartment', $user_permission)): ?>
            <li id="departmentNav">
              <a href="<?php echo base_url('departments/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Department</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createDesignation', $user_permission) || in_array('updateDesignation', $user_permission) || in_array('viewDesignation', $user_permission) || in_array('deleteDesignation', $user_permission)): ?>
            <li id="designationNav">
              <a href="<?php echo base_url('designations/') ?>">
                <i class="fa fa-building"></i> <span>Designation</span>
              </a>
            </li>
          <?php endif; ?>
        
          <?php if(in_array('createEmployee', $user_permission) || in_array('updateEmployee', $user_permission) || in_array('viewEmployee', $user_permission) || in_array('deleteEmployee', $user_permission)): ?>
            <li id="employeeNav">
              <a href="<?php echo base_url('employee/') ?>">
                <i class="fa fa-user"></i> <span>Employee</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createIndicator', $user_permission) || in_array('updateIndicator', $user_permission) || in_array('viewIndicator', $user_permission) || in_array('deleteIndicator', $user_permission)): ?>
  
            <li class="treeview" id="mainUserNav">
              <a href="#">
                <i class="fa fa-flag"></i>
                <span>Performance</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

              <?php if(in_array('viewIndicator', $user_permission)): ?>
                <li id="createUserNav"><a href="<?php echo base_url('indicators') ?>"><i class="fa fa-circle-o"></i> Indicator</a></li>
              <?php endif; ?>

              <?php if(in_array('createAppraisal', $user_permission)): ?>
                <li id="manageUserNav"><a href="<?php echo base_url('appraisals') ?>"><i class="fa fa-circle-o"></i> Appraisal</a></li>
              <?php endif; ?>

              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createTrainingTypes', $user_permission) || in_array('updateTrainingTypes', $user_permission) || in_array('viewTrainingTypes', $user_permission) || in_array('deleteTrainingTypes', $user_permission)): ?>
            <li id="trainingTypesNav">
              <a href="<?php echo base_url('training_types/') ?>">
                <i class="fa fa-files-o"></i> <span>Training types</span>
              </a>
            </li>
          <?php endif; ?>
   
          <?php if(in_array('createTrainer', $user_permission) || in_array('updateTrainer', $user_permission) || in_array('viewTrainer', $user_permission) || in_array('deleteTrainer', $user_permission)): ?>
            <li id="trainerNav">
              <a href="<?php echo base_url('trainer/') ?>">
                <i class="fa fa-user"></i> <span>Trainer</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createTraining', $user_permission) || in_array('updateTraining', $user_permission) || in_array('viewTraining', $user_permission) || in_array('deleteTraining', $user_permission)): ?>
            <li id="trainingNav">
              <a href="<?php echo base_url('trainings/') ?>">
                <i class="fa fa-files-o"></i> <span>Training</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createEvents', $user_permission) || in_array('updateEvents', $user_permission) || in_array('viewEvents', $user_permission) || in_array('deleteEvents', $user_permission)): ?>
            <li id="eventsNav">
              <a href="<?php echo base_url('events/') ?>">
                <i class="fa fa-calendar"></i> <span>Events</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createDesignation', $user_permission) || in_array('updateDesignation', $user_permission) || in_array('viewDesignation', $user_permission) || in_array('deleteDesignation', $user_permission)): ?>
            <li id="designationNav">
              <a href="<?php echo base_url('designations/') ?>">
                <i class="fa fa-folder"></i> <span>Module</span>
              </a>
            </li>
          <?php endif; ?>

              <!-- <?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
                <li id="storeNav">
                  <a href="<?php echo base_url('stores/') ?>">
                    <i class="fa fa-files-o"></i> <span>Stores</span>
                  </a>
                </li>
              <?php endif; ?> -->

              <!-- <?php if(in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
              <li id="attributeNav">
                <a href="<?php echo base_url('attributes/') ?>">
                  <i class="fa fa-files-o"></i> <span>Attributes</span>
                </a>
              </li>
              <?php endif; ?> -->

            <!-- 
              <?php if(in_array('viewReports', $user_permission)): ?>
                <li id="reportNav">
                  <a href="<?php echo base_url('reports/') ?>">
                    <i class="glyphicon glyphicon-stats"></i> <span>Reports</span>
                  </a>
                </li>
              <?php endif; ?> -->

            <!-- 
              <?php if(in_array('updateCompany', $user_permission)): ?>
                <li id="companyNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-files-o"></i> <span>Company</span></a></li>
              <?php endif; ?> -->

            
            <!-- <li class="header">Settings</li> -->

            <!-- <?php if(in_array('viewProfile', $user_permission)): ?>
              <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Profile</span></a></li>
            <?php endif; ?>
            <?php if(in_array('updateSetting', $user_permission)): ?>
              <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
            <?php endif; ?> -->

        <?php endif; ?>
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>