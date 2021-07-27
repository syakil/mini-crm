<?php

namespace App\Mail\Companies;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Companie;

class CompaniesEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $companies;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Companie $companies)
    {
        $this->companies = $companies;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.companies.sends');
    }
}
