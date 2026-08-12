<?php

namespace App\Enums;
enum IncidentStatusEnum: string
{
    case PENDING = 'pending';

    case UNDER_REVIEW = 'under_review';

    case RESOLVED = 'resolved';
}

