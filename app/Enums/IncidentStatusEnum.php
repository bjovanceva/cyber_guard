<?php

namespace App\Enums;
enum IncidentStatusEnum: string
{
    case REPORTED = 'reported';

    case UNDER_REVIEW = 'under_review';

    case RESOLVED = 'resolved';

    case CLOSED = 'closed';
}

