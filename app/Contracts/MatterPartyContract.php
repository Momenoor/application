<?php

namespace App\Contracts;

interface MatterPartyContract
{

    public function type();
    public function category();
    public function field();
    public function pivotType();
    public function symbol();
    public function color();

}
