<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        // $this->not_logged_in();
        // Load necessary models and libraries
        // $this->load->helper('url');
    }

    public function index() {
        // Sample hardcoded events with more details and color coding
        $events = array(
            array(
                'title' => 'Conference',
                'start' => '2024-05-20', // Sample start date
                'end' => '2024-05-22',   // Sample end date
                'location' => 'New York', // Sample location
                'description' => 'Annual conference for the industry',
                'color' => 'blue' // Event color
            ),
            array(
                'title' => 'Workshop',
                'start' => '2024-05-25',
                'end' => '2024-05-25',
                'location' => 'Los Angeles',
                'description' => 'Hands-on workshop on latest technologies',
                'color' => 'green'
            ),
            // Add more sample events as needed
        );

        // Format events array for FullCalendar
        $formatted_events = array();
        foreach ($events as $event) {
            $formatted_events[] = array(
                'title' => $event['title'],
                'start' => $event['start'], // Start date
                'end' => $event['end'],     // End date
                'location' => $event['location'], // Location
                'description' => $event['description'], // Description
                'color' => $event['color'] // Event color
            );
        }

        // Pass formatted event data to the calendar view
        $this->data['events'] = json_encode($formatted_events); // Encode events array to JSON
        // Load the calendar view
        $this->render_template('calendar', $this->data);
    }
}
