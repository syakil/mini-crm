<?php

namespace App\Events\Companies;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Companie;

class CompaniesEmail
{
    use Dispatchable, SerializesModels;

    public $companies;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Companie $companies)
    {
        $this->companies = $companies;
    }

   
}
