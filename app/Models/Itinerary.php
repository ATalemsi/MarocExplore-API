<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'category',
        'duration',
        'image',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
    public function storeImage($image)
    {
        // Define the storage path and filename for the image
        $path = $image->store('itinerary_images', 'public');

        // Store the image path in the 'image' attribute of the itinerary
        $this->image = $path;

        // Save the changes to the itinerary
        $this->save();
    }
}
