<?php

namespace App\Http\Controllers;

use App\Report;
use App\Exam;
use App\ImageReport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $reports=Report::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.reports.index', compact('reports', 'num'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        return view('admin.reports.show', compact('report'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $report=Report::where('slug', $slug)->firstOrFail();
        $report->delete();

        if ($report) {
            return redirect()->route('informes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El informe ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('informes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function file(Request $request) {
        if ($request->hasFile('file')) {
            $file=$request->file('file');
            $name=time().'_'.Str::slug($file->getClientOriginalName(), "-").".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/reports/', $name);
            
            return response()->json([
                'status' => true,
                'name' => $name
            ]);
        }

        return response()->json(['status' => false]);
    }

    public function fileEdit(Request $request, $slug) {
        $exam=Exam::where('slug', request('exam'))->first();
        if (!is_null($exam)) {
            $report=Report::where('slug', $slug)->first();
            if (!is_null($report)) {
                if ($request->hasFile('file')) {
                    $file=$request->file('file');
                    $name=time().'_'.$slug.".".$file->getClientOriginalExtension();
                    $file->move(public_path().'/admins/img/reports/', $name);

                    $imageReport=ImageReport::create(['report_id' => $report->id, 'image' => $name, 'exam_id' => $exam->id]);
                    if ($imageReport) {
                        return response()->json([
                            'status' => true,
                            'name' => $name,
                            'slug' => $slug
                        ]);
                    }
                }
            }
        }

        return response()->json(['status' => false]);
    }

    public function fileDestroy(Request $request) {
        $report=Report::where('slug', request('slug'))->first();
        if (!is_null($report)) {
            $imageReport=ImageReport::where('report_id', $report->id)->where('image', request('url'))->first();
            if (!is_null($imageReport)) {
                $imageReport->delete();

                if ($imageReport) {
                    if (file_exists(public_path().'/admins/img/reports/'.request('url'))) {
                        unlink(public_path().'/admins/img/reports/'.request('url'));
                    }

                    return response()->json(['status' => true]);
                }
            }
        }

        return response()->json(['status' => false]);
    }

    public function pdfRecipe($slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $num=1;
        $pdf=PDF::setOptions(['isPhpEnabled' => true]);
        $pdf=PDF::loadView('admin.pdfs.recipe', compact('report'));

        return $pdf->stream('receta.pdf');
    }

    public function pdfOrder($slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $num=1;
        $pdf=PDF::setOptions(['isPhpEnabled' => true]);
        $pdf=PDF::loadView('admin.pdfs.order', compact('report'));

        return $pdf->stream('orden.pdf');
    }
}
