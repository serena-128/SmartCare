<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;

class AddEvent extends Command
{
    protected $signature = 'event:add {title} {event_date} {event_time} {location} {description}';
    protected $description = 'Add a new event to the calendar';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $title = $this->argument('title');
        $event_date = $this->argument('event_date');
        $event_time = $this->argument('event_time');
        $location = $this->argument('location');
        $description = $this->argument('description');

        Event::create([
            'title' => $title,
            'event_date' => $event_date,
            'event_time' => $event_time,
            'location' => $location,
            'description' => $description,
        ]);

        $this->info('Event added successfully!');
    }
}
