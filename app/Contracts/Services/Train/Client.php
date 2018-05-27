<?php

namespace App\Contracts\Services\Train;

interface Client
{
    public function getDepartures($from, $to = null);
}
