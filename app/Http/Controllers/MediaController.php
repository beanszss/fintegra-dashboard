<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp'
    ]);

    if ($request->has('file')) {
      $uploadPath = public_path('uploads');

      if (!File::isDirectory($uploadPath)) {
        File::makeDirectory($uploadPath, 0755, true, true);
      }

      $file         = $request->file('file');
      $explode      = explode('. ', $file->getClientOriginalName());
      $originalName = $explode[0];
      $extension    = $file->getClientOriginalExtension();
      $rename       = 'file_' . date('YmdHis') . '_' . substr($originalName, 0, 10) . '.' . $extension;
      $mime         = $file->getClientMimeType();
      $fileSize     = $file->getSize();

      if ($file->move($uploadPath, $rename)) {
        $media            = new Media;
        $media->name      = $originalName;
        $media->file      = $rename;
        $media->extension = $extension;
        $media->mime      = $mime;
        $media->size      = $fileSize;
        $media->save();

        return redirect()->back()->with('success', 'File uploaded successfully.');
      }
      return redirect()->back()->with('error', 'File upload failed.');
    }
    return redirect()->back()->with('error', 'Unknown file.');
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $medias = Media::where('id', $id)->first();

      return view('pages.media-view', compact('medias'));
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
    }
}
