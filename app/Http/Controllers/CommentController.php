<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as REQ;

class CommentController extends Controller
{
    public function getAllComments()
    {
        $users = User::all();

        $comments = Comment::all();

        if (REQ::is('api/*'))
            return response()->json([
                'comments' => $comments
            ], 200);
        return view('comments')->with(['comments' => $comments, 'users' => $users]);
    }

    public function getSingleComment($commentId)
    {
        $comment = Comment::find($commentId);
        if (!$commentId) {
            return response()->json([
                'error' => 'Comment not found'
            ], 404);
        }
        return response()->json([
            'comment' => $comment
        ], 200);
    }

    public function postComment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'body' => 'required',
            'postponement_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $comment = new Comment();

        $comment->body = $request->input('body');
        $comment->user_id = $request->input('user_id');
        $comment->postponement_id = $request->input('postponement_id');

        $comment->save();
        return response()->json([
            'comment' => $comment
        ], 200);
    }

    public function putComment(Request $request, $commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment) {
            return response()->json([
                'error' => 'Comment not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'commentable_type' => 'required',
            'commentable_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $comment->update([
            'body' => $request->input('body'),
            'commentable_type' => $request->input('commentable_type'),
            'commentable_id' => $request->input('commentable_id'),
        ]);
        $comment->save();
        return response()->json([
            'comment' => $comment
        ], 200);
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment) {
            return response()->json([
                'error' => 'Comment does not exist'
            ], 404);
        }

        $comment->delete();
        if(REQ::is('api/*'))
        return response()->json([
            'message' => 'Comment deleted successfully'
        ], 200);
        return back()->with('message','Comment deleted successfully');
    }
}
