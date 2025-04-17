<?php

namespace App\Console\Commands;

use App\Models\Rental;
use App\Models\Product;
use App\Models\Worker;
use Illuminate\Console\Command;

class UpdateRentalStatus extends Command
{
    // The name and signature of the console command
    protected $signature = 'rental:update-status';

    // The console command description
    protected $description = 'Update product quantity and worker status after rental period ends';

    // Create a new command instance
    public function __construct()
    {
        parent::__construct();
    }

    // Execute the console command
    public function handle()
    {
        // Get all rentals where the end date has passed and the status is still "pending" or "rented"
        $rentals = Rental::where('end_date', '<', now())
                         ->whereIn('status', ['pending', 'rented'])
                         ->get();

        foreach ($rentals as $rental) {
            // Increase the product's available quantity
            $product = Product::find($rental->product_id);
            $product->quantity_available += 1;
            $product->save();

            // Set the worker's status to "available"
            $worker = Worker::find($rental->worker_id);
            $worker->status = 'available';
            $worker->save();

            // Optionally, update rental status to "completed" or "returned"
            $rental->status = 'completed';
            $rental->save();
        }

        $this->info('Rental statuses have been updated.');
    }
}
