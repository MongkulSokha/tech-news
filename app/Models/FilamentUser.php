<?php

namespace App\Models;

interface FilamentUser
{
    public function canAccessFilament(): bool;
}
