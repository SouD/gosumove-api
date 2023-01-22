<?php
declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

abstract class AbstractListener implements ShouldQueue
{
    use InteractsWithQueue;
}
