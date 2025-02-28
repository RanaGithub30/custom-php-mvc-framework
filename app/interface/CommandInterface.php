<?php

namespace App\Interface;

interface CommandInterface{
    public function handle($args);
}