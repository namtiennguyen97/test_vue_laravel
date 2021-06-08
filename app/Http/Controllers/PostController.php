<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CorsMiddleware;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(CorsMiddleware::class);
    }
    public function store(Request $request)
    {
        $post = new Post([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        $post->save();

        return response()->json('successfully added');
    }

    public function index()
    {
        return new PostCollection(Post::all());
    }

    /**
     * @SWG\Post(
     *     path="/api/post/create",
     *     tags={"Post"},
     *     description="Tạo bài viết",
     *      @SWG\Parameter(in="body", name="body", required=true,
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="title", type="string", required=true),
     *              @SWG\Property(property="body", type="string", required=true),
     *          ),
     *      ),
     *      @SWG\Response(response=200, description="Info",
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="success", type="boolean"),
     *              @SWG\Property(property="statusCode", type="integer", default=200),
     *              @SWG\Property(property="data", type="object",
     *                  @SWG\Property(property="id", type="integer"),
     *                  @SWG\Property(property="name", type="string"),
     *                  @SWG\Property(property="email", type="string"),
     *                  @SWG\Property(property="created_at", type="string"),
     *                  @SWG\Property(property="updated_at", type="string"),
     *              ),
     *          ),
     *      ),
     *     @SWG\Response(response=422, description="Missing Data")
     * )
     */
    public function create(Request $request)
    {
        $userData = $request->only([
            'title',
            'body',
        ]);
        if (empty($userData['title']) || empty($userData['body'])) {
            return new \Exception('Missing data', 404);
        }

        $post = new Post([
            'title' => $userData['title'],
            'body' => $userData['body'],
        ]);
        if(!$post->save()){
            $res = [
                'success' => false,
                'statusCode' => 200,
                'message' => 'Tạo không thành công'
            ];
        }else{
            $res = [
                'success' => true,
                'statusCode' => 200,
                'message' => 'Thành công',
                'data' => $post
            ];
        }
        return response()->json($res);
    }
    /**
     * @SWG\Get(
     *     path="/api/post/detail",
     *     tags={"Post"},
     *     description="Return a user's first and last name",
     *     @SWG\Parameter(name="id", in="query", type="integer", description="Your first name", required=true,),
     *     @SWG\Response(response=200, description="OK"),
     *     @SWG\Response(response=422, description="Missing Data")
     * )
     */
    public function detail(Request $request)
    {
        $post = Post::find($request->get('id'));
        return response()->json($post);
    }

    /**
     * @SWG\Put(
     *     path="/api/post/update",
     *     tags={"Post"},
     *     description="Return a user's first and last name",
     *     @SWG\Parameter(name="id", in="query", type="integer", description="Your first name", required=true,),
     *      @SWG\Parameter(in="body", name="body", required=true,
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="title", type="string", required=true),
     *              @SWG\Property(property="body", type="string", required=true),
     *          ),
     *      ),
     *      @SWG\Response(response=200, description="Info",
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="success", type="boolean"),
     *              @SWG\Property(property="statusCode", type="integer", default=200),
     *          ),
     *      ),
     *     @SWG\Response(response=422, description="Missing Data")
     * )
     */
    public function update(Request $request)
    {
        $post = Post::find($request->get('id'));
        if(!empty($post)){
            $post->update($request->all());
            $res = [
                'success' => true,
                'statusCode' => 200,
                'message' => 'Thành công'
            ];
        }else{
            $res = [
                'success' => false,
                'statusCode' => 200,
                'message' => 'Thiếu tham số'
            ];
        }
        return response()->json($res);
    }

    /**
     * @SWG\Delete(
     *     path="/api/post/delete",
     *     tags={"Post"},
     *     description="Return a user's first and last name",
     *     @SWG\Parameter(name="id", in="query", type="integer", description="Your first name", required=true,),
     *     @SWG\Response(response=200, description="OK"),
     *     @SWG\Response(response=422, description="Missing Data")
     * )
     */
    public function delete(Request $request)
    {
        $post = Post::find($request->get('id'));

        $post->delete();

        $res = [
            'success' => true,
            'statusCode' => 200,
            'message' => 'Thành công'
        ];
        return response()->json($res);
    }
}
