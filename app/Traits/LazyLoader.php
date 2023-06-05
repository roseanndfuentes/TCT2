<?php

namespace App\Traits;

trait LazyLoader
{
      public $loaded = false;

      public function load()
      {
            $this->loaded = true;
      }
}