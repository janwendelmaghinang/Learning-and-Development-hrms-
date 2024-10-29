<style>
    #calendar {
      background-color: white; /* Set calendar background color */
    }
    .location {
      font-size: 10px;
      color: gray;
    }
    .description {
      font-size: 12px;
      color: darkgray;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Events</h1>
    <ol class="breadcrumb">
      <li>
        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
      </li>
      <li class="active">calendar</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="box">   
        <div class="container" id="calendar"></div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).ready(function() {
        // Initialize FullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: <?php echo $events; ?>, // Pass PHP encoded events data
            eventRender: function(event, element) {
                // Customize event rendering
                element.find('.fc-title').append('<br/><span class="location">' + event.location + '</span>');
                element.find('.fc-content').append('<div class="description">' + event.description + '</div>');
                element.css('background-color', event.color); // Set event background color
            }
        });
    });
  </script>

<script type="text/javascript">
  $(document).ready(function () {
    $("#eventNav").addClass("active");
  });
</script>
