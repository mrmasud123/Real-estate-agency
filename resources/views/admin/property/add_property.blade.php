@extends('admin.admin_dashboard_layout')
<style>
    div#adminImage,.admin_image {
      width: 140px;
      height: 150px;
  }
  
  div#adminImage img,.admin_image img {
      width: 100%;
      height: 100%;
      object-fit: cover
  }
  .image_object_fit{
    object-fit: cover;
  }
  </style>
@section('content')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property</h6>
                                     <form method="post" action="{{ route('property.store') }}" class="forms-sample"enctype="multipart/form-data">
                                       @csrf
                                       <div class="mb-3">
                                        <label for="propertyCategory" class="form-label">Property Type</label>
                                        <select name="propertyCategory" id="propertyCategory" class="form-control">
                                            <option value="null" selected disabled>Choose Property Type</option>
                                            <option value="apartment">Apartment</option>
                                            <option value="land">Land</option>
                                           </select>
                                        @error('propertyCategory')
                                            <span class="badge bg-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                       <div class="mb-3">
                                        <label for="propertyType" class="form-label">Property Type</label>
                                        <select name="propertyType" id="propertyType" class="form-control">
                                           <option value="null" selected disabled>Choose Property Type</option>
                                       <option value="sell">Sell</option>
                                       <option value="rent">Rent</option>
                                           </select>
                                        @error('propertyType')
                                            <span class="badge bg-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- <div class="mb-3 appendGroup"></div> --}}
                                    <div class="mb-3">
                                        <label for="bedRoomNo" class="form-label">Enter Bed Room No</label>
                                        <input type="number" class="form-control @error('bedRoomNum') is-invalid @enderror" name="bedRoomNum"id="bedRoomNo"value="{{ @old('bedRoomNum') }}">
                                        @error('bedRoomNum')
                                        <span class="badge bg-danger">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="bathRoomNo" class="form-label">Enter Bath Room No</label>
                                        <input type="number" class="form-control @error('bathRoomNum') is-invalid @enderror" name="bathRoomNum"id="bathRoomNo"value="{{ @old('bathRoomNum') }}">
                                        @error('bathRoomNum')
                                        <span class="badge bg-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="size" class="form-label">Enter Size (Sq ft)</label>
                                        <input type="number" class="form-control @error('size') is-invalid @enderror" name="size"id="size"value="{{ @old('size') }}">
                                        @error('size')
                                        <span class="badge bg-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Garage</label>
                                        <select name="garage" id="garage" class="garage form-control">
                                          <option value="null" selected disabled>Choose Garage Availiability</option>
                                          <option value="yes">yes</option>
                                          <option value="no">No</option>
                                        </select>
                                        @error('garage')
                                        <span class="badge bg-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Enter Property Price</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"id="price"value="{{ @old('price') }}">
                                        @error('price')
                                        <span class="badge bg-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="size" class="form-label">Write a Short Description the property</label>
                                        <textarea name="desc" id="desc" cols="30" rows="3" class='form-control @error('desc') is-invalid @enderror'></textarea>
                                        @error('desc')
                                            <span class="badge bg-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{--  --}}
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Location</label>
                                             <input type="text" class="form-control @error('propertyLocation') is-invalid @enderror" name="propertyLocation"id="exampleInputEmail1"value="{{ @old('propertyLocation') }}">
                                             @error('propertyLocation')
                                             <span class="badge bg-danger">{{ $message }}</span>
                                         @enderror
                                         </div>
                                         <div class="mb-3">
                                            <label for="status" class="form-label">Property Status</label>
                                            <select name="propertyStatus" id="propertyStatus" class="propertyStatus form-control">
                                              <option value="null" selected disabled>Choose Status</option>
                                              <option value="active">Active</option>
                                              <option value="deactive">Deactive</option>
                                            </select>
                                            @error('propertyStatus')
                                            <span class="badge bg-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                        {{--  --}}
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Add Images</label>
                                            <input type="file" name="propertyImages[]" id="image" class="form-control" multiple accept=".png,.jpeg,.jpg">
                                        </div>

                                        <div id="previewContainer" class="d-flex flex-wrap gap-2 mb-3 mt-2"></div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Necessary Video</label>
                                            <input name="video" class="form-control" type="file" id="video" accept=".mp4">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Necessary Document</label>
                                            <input name="document" class="form-control" type="file" id="document" accept=".pdf">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <span class="button btn btn-sm btn-warning featureBtn">Add Additional Feature?</span>
                                            <div class="mt-3 mb-3 appendGroup"></div>
                                        </div>
                                        
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
  $(document).ready(function(){
    $cnt=0;
    $(".featureBtn").on('click', function(e){
        $cnt++;
        $(".appendGroup").append(`<div class='mb-3 d-flex align-items-center justify-content-center'><input class='form-control' type='text' name='features[]' /><span class='btn btn-sm btn-danger removeBtn'>Remove</span> <div>`);
    }); 
    $(".appendGroup").on('click', '.removeBtn', function () {
        $cnt--;
        $(this).closest('div').remove();
    });   
    
    
    $("#image").change(function (e) {
        $("#previewContainer").empty();
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