<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    protected $request;
    protected $repository;

    public function __construct(Request $request, News $news)
    {
        $this->request = $request;
        $this->repository = $news;

        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate();

        return view('admin.pages.news.index', [
            'news' => $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateNewsRequest $request)
    {
        $data = $request->only('title','description');

        if ($request->hasFile('image') && $request->image->isValid()) {
            $imagePath = $request->image->store('news');
            $data['image'] = $imagePath;
        }

        $this->repository->create($data);

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$news = $this->repository->find($id))
        return redirect()->back();

        return view('admin.pages.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateNewsRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateNewsRequest $request, $id)
    {
        if(!$news = $this->repository->find($id))
        return redirect()->back();
        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            if($news->image && Storage::exists($news->image)) {
                Storage::delete($news->image);
            }

            $imagePath = $request->image->store('news');
            $data['image'] = $imagePath;
        }

        $news->update($data);
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($id)){
            $newsModel = app(News::class);
            $news = $newsModel->find($id);
            if(!empty($news)){
                if($news->image && Storage::exists($news->image)) {
                    Storage::delete($news->image);
                }
                $news->delete();
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Produto deletado com sucesso.',
                    'reload'  => true,
                ]);
            }
            else{
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Produto não encontrado.',
                    'reload'  => true,
                ]);
            }
            

        }
        else{
            return response()->json([
                'status'  => 'error',
                'message' => 'ID não está na requisição',
                'reload'  => true,
            ]);

        }
    }

    /**
     * Filtrar
     */

     public function search(Request $request)
     {
        $filters = $request->except('_token');

        $news = $this->repository->search($request->filter);

        return view('admin.pages.news.index', [
            'news' => $news,
            'filters' => $filters,
        ]);
     }
}

