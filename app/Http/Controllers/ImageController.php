<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
public function upload(Request $request)
{
$request->validate([
'photo' => 'required|image|max:2048', // max 2MB
]);

$image = (new ImageManager())
->read($request->file('photo')->getRealPath())
->resize(300, 300);

$filename = time() . '.jpg';
$path = public_path('uploads/' . $filename);
$image->save($path);

return response()->json(['message' => 'Image uploaded successfully!', 'path' => '/uploads/' . $filename]);
}
}
