<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Error;
use Exception;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PostControllers extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function create()
    {
        request()->validate([
            'title' =>  'required',
            'content' => 'required',
        ]);

        return Post::create([
            'title'  => request('title'),
            'content' => request('content'),
        ]);
    }

    public function update(Post $post)
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $request = $post->update([
            'title' => request('title'),
            'content' => request('content'),
        ]);

        if ($request) {
            return ['success' => $request];
        }
    }

    public function destroy($id)
    {
        try {
            try {
                $request = Post::findOrFail($id);
            } catch (\Throwable $th) {
                return $this->APIResponses(400, 'Not Found');
            }

            $request->delete();
            if ($request) {
                return $this->APIResponses(200, 'success');
            }
        } catch (\Exception $e) {
            return $this->APIResponses(400, 'error');
        }
    }

    public function APIResponses($status, $message)
    {
        return response()->json(['status' => $status, 'message' => $message], $status);
    }
}
