<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    public function index()
    {
        return view('comment.index');
    }

    public function comments(CommentRepository $commentRepository)
    {
        $comments = $commentRepository->latest();

        return CommentResource::collection($comments);
    }

    public function store(CreateCommentRequest $request, CommentRepository $commentRepository)
    {
        $comment = $commentRepository->create($request->only(['author', 'body', 'parent_id']));

        return new CommentResource($comment);
    }
}
