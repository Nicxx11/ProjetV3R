<?php

// app/Console/Commands/DeleteOldRecords.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PasswordResets; // Replace with your actual model

class DeleteOldRecords extends Command
{
    // The name and signature of the console command.
    protected $signature = 'records:delete-old';

    // The console command description.
    protected $description = 'Delete records older than 10 minutes';

    // Execute the console command.
    public function handle()
    {
        // Delete records older than 10 minutes
        PasswordResets::where('created_at', '<', now()->subMinutes(10))->delete();

        $this->info('Old records deleted successfully.');
    }
}

