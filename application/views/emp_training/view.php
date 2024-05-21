<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <!-- <h3><?php echo $total_employee ?></h3> -->
                <p>View Course</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-bag"></i> -->
              </div>
              <a href="<?php echo base_url('emp_training/course') ?>" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <!-- <h3><?php echo $total_users; ?></h3> -->
                <p>Take Assessment</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-android-people"></i> -->
              </div>
              <a href="<?php echo base_url('emp_training/assessment/').$id ?>" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
    </section>
  </div>

  <script type="text/javascript">

    $("#myAssessmentNav").addClass('active');

    $(document).ready(function() {
      $("#dashboardMainMenu").addClass('active');
    }); 
  </script>





