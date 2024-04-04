<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use \PDF;

class SendRideHistory extends Mailable
{
    use Queueable, SerializesModels;

    public $userBookings;

    public function __construct($userBookings)
    {
        $this->userBookings = $userBookings;
    }

    public function build()
    {
        $pdf = PDF::loadView('ride-history-pdf', ['userBookings' => $this->userBookings]);

        return $this->subject('Your Ride History')
                    ->view('ride-history-pdf')
                    ->attachData($pdf->output(), 'ride-history.pdf');
    }
}
