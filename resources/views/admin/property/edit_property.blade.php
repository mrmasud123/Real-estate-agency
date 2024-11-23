@extends('admin.admin_dashboard_layout')
@section('metaTags')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="d-inline card-title">Update <h6 class="badge bg-warning"></h6></h6>
                        
                        <form method="post" action="{{ route('property.update', $property->id) }}" action="" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            {{-- Property Category --}}
                            <div class="mb-3">
                                <label for="propertyCategory" class="form-label">Property Category</label>
                                <select name="propertyCategory" id="propertyCategory" class="form-control">
                                    <option value="null" disabled>Choose Property Type</option>
                                    <option value="apartment" {{ $property->property_category == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="land" {{ $property->property_category == 'land' ? 'selected' : '' }}>Land</option>
                                </select>
                                @error('propertyCategory')
                                    <span class="badge bg-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            {{-- Sale Type --}}
                            <div class="mb-3">
                                <label for="propertyType" class="form-label">Property Type</label>
                                <select name="propertyType" id="propertyType" class="form-control">
                                    <option value="null" disabled>Choose Property Type</option>
                                    <option value="sell" {{ $property->sale_type == 'sell' ? 'selected' : '' }}>Sell</option>
                                    <option value="rent" {{ $property->sale_type == 'rent' ? 'selected' : '' }}>Rent</option>
                                </select>
                                @error('propertyType')
                                    <span class="badge bg-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            {{-- Bedrooms --}}
                            <div class="mb-3">
                                <label for="bedRoomNo" class="form-label">Enter Bedroom No</label>
                                <input type="number" class="form-control @error('bedRoomNum') is-invalid @enderror" name="bedRoomNum" id="bedRoomNo" value="{{ old('bedRoomNum', $property->propertyFeature->bed ?? '') }}">
                                @error('bedRoomNum')
                                    <span class="badge bg-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            {{-- Bathrooms --}}
                            <div class="mb-3">
                                <label for="bathRoomNo" class="form-label">Enter Bathroom No</label>
                                <input type="number" class="form-control @error('bathRoomNum') is-invalid @enderror" name="bathRoomNum" id="bathRoomNo" value="{{ old('bathRoomNum', $property->propertyFeature->bath ?? '') }}">
                                @error('bathRoomNum')
                                    <span class="badge bg-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Garage --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Location</label>
                                <input type="text" class="form-control @error('propertyLocation') is-invalid @enderror" name="propertyLocation"id="exampleInputEmail1" value="{{ old('propertyLocation', $property->asset_location ?? '') }}">
                                @error('propertyLocation')
                                <span class="badge bg-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="mb-3">
                                <label for="size" class="form-label">Enter Size (Sq ft)</label>
                                <input type="number" class="form-control @error('size') is-invalid @enderror" name="size"id="size" value="{{ old('size', $property->propertyFeature->area ?? '') }}">
                                @error('size')
                                <span class="badge bg-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="mb-3">
                                <label for="garage" class="form-label">Garage</label>
                                <select name="garage" id="garage" class="form-control">
                                    <option value="null" disabled>Choose Garage Availability</option>
                                    <option value="yes" {{ $property->propertyFeature->garage == 'yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ $property->propertyFeature->garage == 'no' ? 'selected' : '' }}>No</option>
                                </select>
                                @error('garage')
                                    <span class="badge bg-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Property Status</label>
                                <select name="propertyStatus" id="propertyStatus" class="propertyStatus form-control">
                                  <option value="null" disabled>Choose Status</option>
                                  <option value="active" {{ $property->propertyStatus =='active' ? 'selected' : '' }}>Active</option>
                                  <option value="deactive" {{ $property->propertyStatus =='deactive' ? 'selected' : '' }}>Deactive</option>
                                </select>
                                @error('propertyStatus')
                                <span class="badge bg-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            {{-- Price --}}
                            <div class="mb-3">
                                <label for="price" class="form-label">Enter Property Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $property->propertyFeature->property_price ?? '') }}">
                                @error('price')
                                    <span class="badge bg-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="desc" class="form-label">Write a Short Description</label>
                                <textarea name="desc" id="desc" cols="30" rows="3" class="form-control @error('desc') is-invalid @enderror">{{ old('desc', $property->propertyFeature->property_description ?? '') }}</textarea>
                                @error('desc')
                                    <span class="badge bg-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            {{-- Images --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">Add Images</label>
                                <input type="file" name="propertyImages[]" id="image" class="form-control" multiple accept=".png,.jpeg,.jpg">
                            
                                <div id="previewContainer" class="d-flex flex-wrap gap-2 mb-3 mt-2">
                                    @foreach(explode(', ', $property->propertyAssets->images ?? '') as $image)
                                        <div class="position-relative" style="width: 100px;">
                                            <img src="{{ url('uploads/property_images/' . trim($image)) }}" class="img-thumbnail" style="width: 100px;">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 removeImageBtn" 
                                                    data-image="{{ trim($image) }}" 
                                                    style="z-index: 1;">
                                                X
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- Additional Features --}}
                            <div class="mb-3">
                                <label for="features" class="form-label">Additional Features</label><br>
                                <span class="button btn btn-sm btn-warning featureBtn">Add Additional Feature?</span>
                                <div id="appendGroup">
                                    @foreach (explode(',', $property->propertyFeature->additional_features) as $feature)
                                    <div class='mb-3 d-flex align-items-center justify-content-center'><input class='form-control' type='text' name='features[]' value="{{ $feature }}" /><span class='btn btn-sm btn-danger removeBtn'>Remove</span> </div>
                                @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="propertyVideos" class="mb-4">Videos</label><br>
                                <input name="video" class="form-control mb-3" type="file" id="video" accept=".mp4">
                                @if ($property->propertyAssets->videos !==null)
                                <video 
                                    src="{{ asset('uploads/property_videos/'. $property->propertyAssets->videos) }}" 
                                    autoplay 
                                    muted 
                                    controls 
                                    style="width: 600px; height: auto; border-radius: 20px;">
                                </video>
                                @else
                                    <h3>No videos available</h3>
                                @endif
                            
                            </div>

                            <div class="mb-3">
                                <label for="propertyDocuments">Documents</label>
                                <input name="document" class="form-control mb-3 mt-2" type="file" id="document" accept=".pdf">
                                <div class="pdf-container" style="width: 100%; height: 300px;">
                                  @if ($property->propertyAssets->documents !== null)
                                    <iframe src="{{ asset('uploads/property_documents/'.$property->propertyAssets->documents) }}" width="100%" height="100%" frameborder="0"></iframe>                                      
                                  @else
                                    <h3>No documents available</h3>
                                  @endif
                              </div>
                              
                            </div>
                            {{-- Submit --}}
                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                             
                    </div>
                  </div>
              
            </div>
          </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function () {
        $(".featureBtn").on('click', function(e){
        $("#appendGroup").append(`<div class='mb-3 d-flex align-items-center justify-content-center'><input class='form-control' type='text' name='features[]' /><span class='btn btn-sm btn-danger removeBtn'>Remove</span> <div>`);
    }); 
    $("#appendGroup").on('click', '.removeBtn', function () {
        $(this).closest('div').remove();
    }); 
    $('#previewContainer').on('click', '.removeImageBtn', function () {
        const imageName = $(this).data('image'); // Get the image name
        const $imageContainer = $(this).parent(); // Reference to the parent container

        if (confirm('Are you sure you want to remove this image?')) {
            // Send an AJAX request to remove the image
            $.ajax({
                url: `/property/remove-image`, // Backend route to remove image
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    image: imageName,
                    property_id: '{{ $property->id }}' // Pass the property ID
                },
                success: function (response) {
                    alert(response.message);
                    $imageContainer.remove(); // Remove the image from the DOM
                },
                error: function (xhr) {
                    console.error('Error removing image:', xhr.responseText);
                    alert('Failed to remove the image. Please try again.');
                }
            });
        }
    });

    $("#image").change(function (e) {
        // $("#previewContainer").empty();
        var files = e.target.files;
        Array.from(files).forEach((file) => {
            var reader = new FileReader();
            reader.onload = function (event) {
                // Create a new img element
                var img = $("<img>").attr("src", event.target.result).addClass("preview-image admin_image image_object_fit");
                // Append the image to the container
                $("#previewContainer").append(img);
            };
            reader.readAsDataURL(file);
        });
    });
    });

</script>

@endsection