<?php

namespace App\Exceptions;

use Exception;

class CommentReplyDepthLimitExceededException extends Exception
{
    protected $message = "Cannot add more reply to this comment as it exceed to max depth level limit of 3";
}
