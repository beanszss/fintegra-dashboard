<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // Bootstrap Table
    public function table(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Table"]
      ];
      return view('/pages/table', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    // Datatable
    public function datatable(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Datatable"]
      ];

      $medias = Media::latest()->get();
      // dd($medias);
      return view('pages.table-datatable', compact('medias'),[
          'breadcrumbs' => $breadcrumbs,
      ]);
    }

    // ag-Grid Table
    public function ag_grid(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"agGrid Table"]
      ];
      return view('/pages/table-ag-grid', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }
}
