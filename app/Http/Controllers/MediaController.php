<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Media;


class MediaController extends Controller
{
    //index

    public function index($id = null)
    {
        $media = ($id) ? Media::findOrFail($id) : Media::orderBy('id', 'DESC')->get();
        return response()->json($media);
    }

    // Page View
    public function pageview(Request $request)
    {
        $count = $request->query('count');
        $order_type = $request->query('order_type'); // ASC or DESC
        $media = Media::orderBy('id', $order_type)->paginate($count);
        return response()->json($media);
    }

    // show

    public function show($id)
    {
        $media = Media::findOrFail($id);
        return response()->json($media);
    }

    public function showMediaUploadForm()
    {
        $media = Media::all(); // Retrieve all media to display

        return view('mediaUpload', compact('media'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string',
            'file_name' => 'nullable|string',
            'tags' => 'nullable|array'
        ]);
        $media = Media::findOrFail($id);
        $media->update($validatedData);
        return response()->json($media, 200);
    }

    // delete

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $status = $media->delete();
        return response()->json(['message' => 'Media deleted successfully', 'status' => $status]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,gif,svg,mp4,mkv,pdf,doc,docx,xls,xlsx,ppt,ppa,pptx,mpeg,mov,m4u|max:204800',
            'tags' => 'nullable|array'
        ]);


        $file = $request->file('file');

        $media = CustomHelper::upload_media_file($file);

        return response()->json(['message' => 'Media uploaded successfully', 'media' => $media]);
    }
}
