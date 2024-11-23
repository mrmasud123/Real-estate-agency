<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\property;
use App\Models\propertyasset;
use App\Models\propertyfeature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PropertyController extends Controller
{
    
    public function loadProperties(){
        $properties=property::with('propertyFeature','propertyAssets')->get();
        $adminData=Auth::user();
        return view('admin.property.properties', compact('adminData','properties'));
    }
    public function addProperty(){
        $adminData=Auth::user();
        return view('admin.property.add_property', compact('adminData'));
    }

    public function storeProperty(Request $request){
        
        $featuresArray = $request->input('features');
        $featuresString = implode(', ', $featuresArray);
        $property=new property();

        $property->property_category=$request->propertyCategory;
        $property->sale_type=$request->propertyType;
        $property->asset_location=$request->propertyLocation;
        $property->ad_provider_role = Auth::user()->role;
        $property->asset_status=$request->propertyStatus;
        // $property->co_ordinates="null";
        $property->save();
        $propertyId=$property->id;
        // echo $propertyId;

        $propertyFeatures= new propertyfeature();
        $propertyFeatures->property_id=$propertyId;
        $propertyFeatures->status=$request->propertyStatus;
        $propertyFeatures->area=$request->size;
        $propertyFeatures->bed=$request->bedRoomNum;
        $propertyFeatures->bath=$request->bathRoomNum;
        $propertyFeatures->garage=$request->garage;
        $propertyFeatures->additional_features=$featuresString;
        $propertyFeatures->property_description=$request->desc;
        $propertyFeatures->property_price=$request->price;
        $propertyFeatures->save();
        
        $propertyAssets=new propertyasset();
        $propertyAssets->property_id=$propertyId;
        $imgNames = [];
        if ($request->hasFile('propertyImages')) {
            $images = $request->file('propertyImages');
            foreach ($images as $key => $image) {
                // Create a unique name for each image
                $fileName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                $imgNames[] = $fileName; // Store the filename in the array
                $image->move(public_path('uploads/property_images/'), $fileName);
            }
        }

        $imgNamesString=implode(', ', $imgNames);
        $propertyAssets->images=$imgNamesString;
        if($request->hasFile('video')){
            $file=$request->file('video');
            $fileName=time().".". $file->getClientOriginalExtension();
            $file->move(public_path('uploads/property_videos/'), $fileName);
            $propertyAssets->videos=$fileName;
        }

        if($request->hasFile('document')){
            $document=$request->file('document');
            $fileName=time().".". $document->getClientOriginalExtension();
            $document->move(public_path('uploads/property_documents/'), $fileName);
            $propertyAssets->documents=$fileName;
        }

        $propertyAssets->save();

        return redirect()->route('properties')->with(['message'=>"Property Added",'alert-type'=>'success']);
    }

    public function property($id){
        $property = Property::with(['propertyFeature', 'propertyAssets'])->find($id);

        if (!$property) {
            return response()->json(['error' => 'Property not found'], 404);
        }

        return response()->json($property);
        }



        public function editProperty($id){
            $adminData=Auth::user();
            $property=Property::with(['propertyFeature', 'propertyAssets'])->find($id);
            return view('admin.property.edit_property', compact('property','adminData'));
        }


        public function removeImage(Request $request){
            $propertyId = $request->input('property_id');
            $imageName = $request->input('image');

            $propertyAssets = PropertyAsset::where('property_id', $propertyId)->first();

            if (!$propertyAssets) {
                return response()->json(['message' => 'Property assets not found.'], 404);
            }

            $images = explode(', ', $propertyAssets->images);
            if (($key = array_search($imageName, $images)) !== false) {
                // Remove the image from the array
                unset($images[$key]);

                // Update the database
                $propertyAssets->images = implode(', ', $images);
                $propertyAssets->save();

                // Remove the image file from storage
                $filePath = public_path('uploads/property_images/' . $imageName);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                return response()->json(['message' => 'Image removed successfully.']);
            }
            return response()->json(['message' => 'Image not found in property assets.'], 404);
        }

        public function updateProperty(Request $request, $id)
{
    $imgNames = [];
    
    // Retrieve the property along with its related features and assets
    $propertyData = Property::with('propertyAssets', 'propertyFeature')->find($id);

    if (!$propertyData) {
        return response()->json(['error' => 'Property not found'], 404);
    }

    // Update property data
    $featuresArray = $request->input('features', []);
    $featuresString = implode(', ', $featuresArray);

    $propertyData->property_category = $request->propertyCategory;
    $propertyData->sale_type = $request->propertyType;
    $propertyData->asset_location = $request->propertyLocation;
    $propertyData->ad_provider_role = Auth::user()->role;
    $propertyData->asset_status = $request->propertyStatus;
    $propertyData->save();

    // Update property features
    $propertyFeature = $propertyData->propertyFeature;
    if ($propertyFeature) {
        $propertyFeature->status = $request->propertyStatus;
        $propertyFeature->area = $request->size;
        $propertyFeature->bed = $request->bedRoomNum;
        $propertyFeature->bath = $request->bathRoomNum;
        $propertyFeature->garage = $request->garage;
        $propertyFeature->additional_features = $featuresString;
        $propertyFeature->property_description = $request->desc;
        $propertyFeature->property_price = $request->price;
        $propertyFeature->save();
    }

    // Handle property images
    if ($request->hasFile('propertyImages')) {
        $images = $request->file('propertyImages');
        foreach ($images as $key => $image) {
            $fileName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
            $imgNames[] = $fileName;
            $image->move(public_path('uploads/property_images/'), $fileName);
        }
        $imgNamesString = implode(',', $imgNames);
        $updatedImgString = $imgNamesString . ", " . ($propertyData->propertyAssets->images ?? '');
    } else {
        $updatedImgString = $propertyData->propertyAssets->images ?? '';
    }

    // Update property assets
    $propertyAsset = $propertyData->propertyAssets;
    if ($propertyAsset) {
        $propertyAsset->images = $updatedImgString;

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $fileName = time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/property_videos/'), $fileName);
            $propertyAsset->videos = $fileName;
        }

        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $fileName = time() . "." . $document->getClientOriginalExtension();
            $document->move(public_path('uploads/property_documents/'), $fileName);
            $propertyAsset->documents = $fileName;
        }

        $propertyAsset->save();
    }

    return response()->json(['success' => 'Property updated successfully']);
}

}
