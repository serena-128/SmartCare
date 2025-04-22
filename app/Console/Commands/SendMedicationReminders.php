<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Medication;
use App\Models\StaffMember;
use Illuminate\Support\Facades\Mail;
use App\Mail\MedicationReminderMail;

class SendMedicationReminders extends Command
{
    protected $signature = 'medications:send-reminders';
    protected $description = 'Send daily email with overdue medications to staff';

    public function handle()
    {
        $overdue = Medication::with('resident')
            ->where('taken', false)
            ->where('scheduled_time', '<', now())
            ->get();

        if ($overdue->isEmpty()) {
            $this->info('No overdue medications found.');
            return;
        }

        $nurses = StaffMember::where('role', 'Nurse')->get();

        foreach ($nurses as $nurse) {
            Mail::to($nurse->email)->send(new MedicationReminderMail($overdue));
        }

        $this->info('Reminders sent successfully to all nurses.');
    }
}
