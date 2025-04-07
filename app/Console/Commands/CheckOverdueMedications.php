<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Medication;
use App\Notifications\MedicationReminder;
use Illuminate\Support\Facades\Notification;

class CheckOverdueMedications extends Command
{
    protected $signature = 'medications:check-overdue';
    protected $description = 'Check for overdue medications and send reminders to managers';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $overdueMedications = Medication::where('scheduled_time', '<', now())
            ->where('taken', false)
            ->with('resident')
            ->get();

        foreach ($overdueMedications as $medication) {
            $resident = $medication->resident;

            if (!$resident) {
                $this->warn("Medication ID {$medication->id} has no associated resident.");
                continue;
            }

            Notification::route('mail', 'manager@example.com')
                ->notify(new MedicationReminder($resident, $medication));

            $this->info("✅ Reminder sent for overdue medication: {$medication->medication_name} for Resident: {$resident->full_name}");
        }
    }
}
