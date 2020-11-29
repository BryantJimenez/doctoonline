<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use App\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use Illuminate\Support\Str;
use Auth;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $news=News::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.news.index', compact('news', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsStoreRequest $request)
    {
        $count=News::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=News::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {
                $data=array('title' => request('title'), 'slug' => $slug, 'content' => request('content'), 'featured' => request('featured'), 'state' => request('state'));
                break;
            }
        }

        // Mover imagen a carpeta news y extraer nombre
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $data['image']=store_files($file, $slug, '/admins/img/news/');
        }

        if (request('state')==1 && request('featured')==1) {
            $count_last=News::where('featured', "1")->where('state', "1")->count();
            if ($count_last>=3) {
                $last=News::where('featured', "1")->where('state', "1")->orderBy('id', 'ASC')->first();
            }
        }

        $new=News::create($data);

        $categories=request('category_id');
        foreach ($categories as $slugCategory) {
            $category=Category::where('slug', $slugCategory)->firstOrFail();
            CategoryNews::create(['news_id' => $new->id, 'category_id' => $category->id]);
        }

        if ($new) {
            if (request('state')==1 && request('featured')==1 && $count_last>=3) {
                $last->fill(['featured' => "0"])->save();
            }

            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La noticia ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $new=News::where('slug', $slug)->firstOrFail();
        $categories=Category::all();
        return view('admin.news.edit', compact('new', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, $slug)
    {
        $new=News::where('slug', $slug)->firstOrFail();
        $data=array('title' => request('title'), 'content' => request('content'), 'featured' => request('featured'), 'state' => request('state'));

        // Mover imagen a carpeta news y extraer nombre
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $data['image']=store_files($file, $slug, '/admins/img/news/');
        }

        if (request('state')==1 && request('featured')==1) {
            $count_last=News::where('featured', "1")->where('state', "1")->count();
            if ($count_last>=3) {
                $last=News::where('featured', "1")->where('state', "1")->orderBy('id', 'ASC')->first();
            }
        }

        $new->fill($data)->save();

        foreach ($new->categories as $category) {
            $category_news=CategoryNews::where('news_id', $new->id)->where('category_id', $category->id)->firstOrFail();
            $category_news->delete();
        }

        $categories=request('category_id');
        foreach ($categories as $slugCategory) {
            $category=Category::where('slug', $slugCategory)->firstOrFail();
            CategoryNews::create(['news_id' => $new->id, 'category_id' => $category->id]);
        }

        if ($new) {
            if (request('state')==1 && request('featured')==1 && $count_last>=3) {
                $last->fill(['featured' => "0"])->save();
            }

            return redirect()->route('noticias.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La noticia ha sido editada exitosamente.']);
        } else {
            return redirect()->route('noticias.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $new=News::where('slug', $slug)->firstOrFail();
        $new->delete();

        if ($new) {
            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La noticia ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $new=News::where('slug', $slug)->firstOrFail();
        $new->fill(['state' => "2"])->save();

        if ($new->featured==1) {
            $new->fill(['featured' => "0"])->save();
        }

        if ($new) {
            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La noticia ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $new=News::where('slug', $slug)->firstOrFail();

        if ($new->featured==1) {
            $count_last=News::where('featured', "1")->where('state', "1")->count();
            if ($count_last>=1) {
                $last=News::where('featured', "1")->where('state', "1")->orderBy('id', 'ASC')->first();
            }
        }

        $new->fill(['state' => "1"])->save();

        if ($new) {
            if ($new->featured==1 && $count_last>=3) {
                if ($new->slug!=$last->slug) {
                    $last->fill(['featured' => "0"])->save();
                }
            }

            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La noticia ha sido publicada exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
