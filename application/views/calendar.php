<head>
  <title>Event Calendar</title>
  <!-- Include FullCalendar CSS -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"
    rel="stylesheet"
  />
  <!-- Include jQuery -->
  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script> -->
  <!-- Include FullCalendar JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  <!-- Calendar Script -->

  <!-- Custom styles -->
  <style>
    #calendar {
      padding: 5rem;
      background-color: white; /* Set calendar background color */
      width: 1220px;
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
  
</head>
<body>
  <h2>Event Calendar</h2>
  <!-- Calendar container -->
  <div class="container" id="calendar"></div>

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
</body>
