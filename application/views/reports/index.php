<style>
  tr:hover{
    background: blue;
    opacity: .8;
    color: white;
  }
  a{
    text-decoration: none;
  }
</style>  

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reports and Analytics
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reports</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">Manage Departments</h3> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table ">
              
              <tr>
                <td><a target="_blank" href="<?php echo base_url('reports/onlinecourse') ?>">ALL Online Assessment Courses</a></td>
              </tr>
              <tr>
                <td><a target="_blank" href="<?php echo base_url('reports/onlineassessment') ?>">Online Assessment Analytics</a></td>
              </tr>
              <tr>
                <td><a target="_blank" href="<?php echo base_url('reports/onlinetraining') ?>">Online Training Analytics </a></td>
              </tr>
              <tr>
                <td><a target="_blank" href="<?php echo base_url('reports/onlinematerial') ?>">Online Assessment Course Material Analytics</a></td>
              </tr>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">

    $(document).ready(function() {
      $("#reportNav").addClass('active');
    }); 
    
  </script>
