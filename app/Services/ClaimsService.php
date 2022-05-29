<?php

namespace App\Services;

use App\Models\Matter;

class ClaimsService
{
    private $matter;
    public function __construct(Matter $matter)
    {
        $this->matter = $matter;
        $this->officeShare();
    }

    public function netClaim()
    {
    }

    public function officeShare()
    {
        return $this->matter->claims->where('type', 'office_share');
        if ($this->matter->isPrivate()) {

        }
    }
}
