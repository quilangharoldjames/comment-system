<?php

namespace App\Repositories;

use App\Comment;
use App\Exceptions\CommentReplyDepthLimitExceededException;

class CommentRepository
{
    public function latest()
    {
        return Comment::with(array('replies' => function($query) {
            $query->orderBy('created_at', 'DESC');
          }))->whereNull('parent_id')->orderBy('created_at', 'desc')->get();
    }

    public function create($data)
    {
        if (isset($data['parent_id'])) {
            $parentComment = Comment::find($data['parent_id']);

            if ($parentComment->depth == 3) {
                throw new CommentReplyDepthLimitExceededException();
            }
        }

        $newComment = new Comment();
        $newComment->author = $data['author'];
        $newComment->body = $data['body'];
        $newComment->parent_id = isset($data['parent_id']) ? $data['parent_id'] : null;
        $newComment->depth = isset($data['parent_id']) ? $parentComment->depth + 1 : 0;
        $newComment->save();

        return $newComment;
    }
}
