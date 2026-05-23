<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendAdminReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-admin-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email reminders to admin for tomorrow\'s confirmed appointments.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();
        $appointments = Appointment::where('date', $tomorrow)
            ->where('status', 'Confirmed')
            ->orderBy('time', 'asc')
            ->get();

        if ($appointments->isEmpty()) {
            $this->info('No confirmed appointments for tomorrow.');
            return;
        }

        $adminEmail = 'admin@russcuevas.com';
        
        $data = [
            'title' => 'Daily Schedule Reminder',
            'name' => 'Administrator',
            'intro' => 'This is an automated reminder for your confirmed appointments tomorrow, <strong>' . Carbon::tomorrow()->format('F d, Y') . '</strong>.',
            'details' => [],
            'outro' => 'Please log in to the admin dashboard for more details.'
        ];

        foreach ($appointments as $index => $app) {
            $data['details']['Schedule ' . ($index + 1)] = Carbon::parse($app->time)->format('g:i A') . ' - ' . $app->name;
        }

        Mail::send('emails.notification', $data, function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                    ->subject('Tomorrow\'s Appointment Schedule - Russ Cuevas Atelier');
        });

        $this->info('Daily reminder email sent to admin.');
    }
}
