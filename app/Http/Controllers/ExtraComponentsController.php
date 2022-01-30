<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class ExtraComponentsController extends Controller
{
    // Extra Component - Avatar
    public function avatar(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Extra Components"], ['name'=>"Avatar"]
      ];
      return view('/pages/ex-component-avatar', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    // Extra Component - Chips
    public function chips(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Extra Components"], ['name'=>"Chips"]
      ];
      $medias = Media::latest()->get();

      foreach ($medias as $id => $media) {
        $media->file;
      }
      return view('pages.ex-component-chips', compact('media'), [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    // Extra Component - Divider
    public function divider(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Extra Components"], ['name'=>"Divider"]
      ];
      return view('/pages/ex-component-divider', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }
}
