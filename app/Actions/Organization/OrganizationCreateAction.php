<?php

declare(strict_types=1);

namespace App\Actions\Organization;

use App\Actions\AbstractAction as Action;
use App\Data\Organization\OrganizationData;
use App\Models\Organization\Organization;
use Spatie\QueueableAction\QueueableAction;

class OrganizationCreateAction extends Action
{
    use QueueableAction;

    public function execute(OrganizationData $data): Organization
    {
        return Organization::create([
            'name' => $data->name,
        ]);
    }
}
