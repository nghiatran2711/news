<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=[];
        

        $articles=Article::with('category')->get();
        $data['articles']=$articles;
        return view('articles.list_article',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=[];
        $categories=Category::pluck('name','id');
        $data['categories']=$categories;
        return view('articles.create_article',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dataInsert=[
            'name'=>$request->name,
            'description'=>$request->description,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
        ];
        // dd($dataInsert);
        DB::beginTransaction();

        try {
            // insert into table Article
            Article::create($dataInsert);
            DB::commit();
            // success
            return redirect()->route('article.index')->with('success', 'Insert article successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
        }
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
        //
        $data=[];
        $categories=Category::pluck('name','id');
        $article=Article::find($id);
        $data['categories']=$categories;
        $data['article']=$article;
        return view('articles.edit_article',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $article=Article::find($id);
        $article->name=$request->name;
        $article->description=$request->description;
        $article->content=$request->content;
        $article->category_id=$request->category_id;

        DB::beginTransaction();
        try{
            $article->save();
            DB::commit();
            // success
            return redirect()->route('article.index')->with('success', 'Update article successful!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $article=Article::findOrFail($id);
            $article->delete();
            return redirect()->route('article.index')->with('success', 'Delete Article successful!');
        }catch(\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }
}
