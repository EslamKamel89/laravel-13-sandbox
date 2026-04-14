<?php

namespace App\Enums;

enum PostStatus: string {
    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';
}
