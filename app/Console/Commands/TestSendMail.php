<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestSendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Gửi email thử nghiệm
        $toEmail = 'voquochoau@gmail.com'; // Địa chỉ nhận email thử

        // Gửi email raw
        Mail::raw('This is a test email from Laravel', function ($message) use ($toEmail) {
            $message->to($toEmail)
                    ->subject('Test Email');
        });

        $this->info('Test email has been sent!');
    }
}
