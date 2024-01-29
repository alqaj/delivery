<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Delivery;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
class DeliveryController extends Controller
{
    public function index()
    {
        return view("delivery.index");
    }

    public function preparation()
    {
        $destinations = Destination::all();
        return view("delivery.home", compact("destinations"));
    }
    
    public function start(Request $request)
    {
        $destination = Destination::where('uuid',$request->input('uuid'))->first();
        $imageData = $request->input('photo'); // Mendapatkan data URI foto dari formulir
        $imageData = substr($imageData, strpos($imageData, ',') + 1);
        $decodedImage = base64_decode($imageData); // Mendecode data base64 menjadi biner
        $fileName = 'photo_' . time() . '.jpg';
        // Menyimpan file ke dalam folder storage
        file_put_contents(storage_path('app/public/delivery_photos/' . $fileName), $decodedImage);

        $delivery = Delivery::create([
            'uuid' => Uuid::uuid4()->toString(),
            'destinasi' => $destination->name,
            'destinasi_id' => $destination->id,
            'dock' => $destination->dock,
            'cycle' => $request->input('cycle'),
            'logistic' => $destination->logistic,
            'start' => Carbon::now(),
            'photo' => $fileName,
        ]);
        return view("delivery.start", ['destination' => $destination, 'delivery' => $delivery]);
    }

    public function finish(Request $request)
    {
        $delivery = Delivery::where('uuid',$request->input('uuid'))->first();
        $delivery->end = Carbon::now();
        $delivery->save();
        return view("delivery.index");

    }

    public function scan()
    {
        $delivery = Delivery::latest()->first();

        return view('scan.index', compact('delivery'));
    }

    public function pulling()
    {
        $delivery = Delivery::latest()->first();

        return view('scan.pulling', compact('delivery'));
    }


    // public function pulling($uuid)
    // {
    //     $delivery = Delivery::findOrFail($uuid);
    // }

  
}
