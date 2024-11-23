@extends('admin.admin_dashboard_layout')
@section('metaTags')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Showing All Admin</h4>
      </div>
      <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{ route('admin.addproperty') }}" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="home"></i>
            Add Property Listing
          </a>
        <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
          <i class="btn-icon-prepend" data-feather="download-cloud"></i>
          Download Sales Report
        </button>
      </div>
    </div>

     <!-- row -->

    <div class="row">
      <div class="col-lg-12 col-xl-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <h4>Property List</h4>
            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr class="text-center">
                    <th class="pt-0">Property Category</th>
                    <th class="pt-0">Sale Type</th>
                    <th class="pt-0">Asset Location</th>
                    <th class="pt-0">Ad Provider</th>
                    <th class="pt-0">Asset Status</th>
                    <th class="pt-0">Property Price</th>
                    <th class="pt-0">Actions</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($properties as $property)
                    <tr class="text-center">
                      <td>{{ $property->property_category }}</td>
                      <td><code class="badge bg-warning">{{ $property->sale_type }}</code></td>
                      <td>{{ $property->asset_location }}</td>
                      <td>{{ $property->ad_provider_role }}</td>
                      <td>@if($property->asset_status === 'deactive')
                        <span class="badge bg-danger">{{ $property->asset_status }}</span>
                      @else
                        <span class="badge bg-success">{{ $property->asset_status }}</span>
                      @endif</td>
                      <td><code class="badge bg-info">{{ $property->propertyFeature->property_price ?? "TBA" }}</code></td>
                      <td>
                        <a href="javascript:void(0);" 
                          class="viewPropertyBtn" 
                          data-id="{{ $property->id }}" 
                          data-bs-toggle="modal" 
                          data-bs-target="#varyingModal">
                          <i class="me-2 icon-md text-warning" data-feather="eye"></i>
                        </a>
                        <a href=""><i class="me-2 icon-md text-danger" data-feather="trash"></i></a>
                        <a href="{{ route('property.edit', $property->id) }}"><i class="me-2 icon-md text-warning" data-feather="edit"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div>
          </div> 
        </div>
      </div>
    </div>

    <div class="modal fade" id="varyingModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="propertyModalLabel">Property Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <!-- Property General Info -->
                  <div class="mb-3">
                      <label for="propertyCategory">Category</label>
                      <input type="text" class="form-control" id="propertyCategory" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="saleType">Sale Type</label>
                      <input type="text" class="form-control" id="saleType" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="assetLocation">Location</label>
                      <input type="text" class="form-control" id="assetLocation" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="adProviderRole" class="form-label">Ad Provider Role</label>
                    <input type="text" class="form-control" id="adProviderRole" readonly>
                </div>
                <div class="mb-3">
                    <label for="assetStatus" class="form-label">Status</label>
                    <input type="text" class="form-control" id="assetStatus" readonly>
                </div>

                <hr />
                <div class="mb-3">
                    <label for="propertyPrice" class="form-label">Price</label>
                    <input type="text" class="form-control" id="propertyPrice" readonly>
                </div>
                <div class="mb-3">
                    <label for="propertyDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="propertyDescription" rows="3" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label for="propertyArea" class="form-label">Area</label>
                    <input type="text" class="form-control" id="propertyArea" readonly>
                </div>
                <div class="mb-3">
                    <label for="propertyBed" class="form-label">Bedrooms</label>
                    <input type="text" class="form-control" id="propertyBed" readonly>
                </div>
                <div class="mb-3">
                    <label for="propertyBath" class="form-label">Bathrooms</label>
                    <input type="text" class="form-control" id="propertyBath" readonly>
                </div>
                <div class="mb-3">
                    <label for="propertyGarage" class="form-label">Garage</label>
                    <input type="text" class="form-control" id="propertyGarage" readonly>
                </div>
                  <!-- Features -->
                  <div class="mb-3">
                      <h6>Additional Features:</h6>
                      <ul id="additionalFeaturesList"></ul>
                  </div>
  
                  <!-- Property Assets -->
                  <div class="mb-3">
                      <h6>Images:</h6>
                      <div id="propertyImages"></div>
                  </div>
  
                  <div class="mb-3">
                      <label for="propertyVideos" class="mb-4">Videos</label><br>
                      <video id="propertyVideos" autoplay muted controls style="width: 600px;height:auto;border-radius:20px"></video>
                  </div>
                  <div class="mb-3">
                      <label for="propertyDocuments">Documents</label>
                      {{-- <input type="text" class="form-control" id="propertyDocuments" readonly> --}}
                      <div class="pdf-container" style="width: 100%; height: 300px;">
                        <iframe id="propertyDocuments" width="100%" height="100%" frameborder="0"></iframe>
                    </div>
                    
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  
  

@endsection

@section('scripts')
<script>
 $(document).ready(function () {
    // Add click event listener for all buttons with the class 'viewPropertyBtn'
    $('.viewPropertyBtn').on('click', function (e) {
        e.preventDefault(); // Prevent default action

        const propertyId = $(this).data('id'); // Fetch the property ID from the data attribute

        $.ajax({
            url: `/property/${propertyId}`, // Backend route for fetching property details
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
            },
            success: function (data) {
                // Populate modal fields with the fetched data
                $('#propertyId').val(data.id || 'N/A');
                $('#propertyCategory').val(data.property_category || 'N/A');
                $('#saleType').val(data.sale_type || 'N/A');
                $('#assetLocation').val(data.asset_location || 'N/A');
                $('#adProviderRole').val(data.ad_provider_role || 'N/A');
                $('#assetStatus').val(data.asset_status || 'N/A');

                // Handle property feature data
                if (data.property_feature) {
                    $('#propertyPrice').val(data.property_feature.property_price || 'N/A');
                    $('#propertyDescription').val(data.property_feature.property_description || 'N/A');
                    $('#propertyArea').val(data.property_feature.area || 'N/A');
                    $('#propertyBed').val(data.property_feature.bed || 'N/A');
                    $('#propertyBath').val(data.property_feature.bath || 'N/A');
                    $('#propertyGarage').val(data.property_feature.garage || 'N/A');

                    // Handle additional features
                    const features = data.property_feature.additional_features
                        ? data.property_feature.additional_features.split(',').map(f => `<li>${f.trim()}</li>`).join('')
                        : '<li>No additional features available</li>';
                    $('#additionalFeaturesList').html(features);
                } else {
                    $('#propertyPrice').val('N/A');
                    $('#propertyDescription').val('N/A');
                    $('#propertyArea').val('N/A');
                    $('#propertyBed').val('N/A');
                    $('#propertyBath').val('N/A');
                    $('#propertyGarage').val('N/A');
                    
                }

                if (data.property_assets) {
                    const images = data.property_assets.images
                        ? data.property_assets.images.split(',').map(img => `<img src="/uploads/property_images/${img.trim()}" class="img-thumbnail me-2" style="width: 400px;height:180px;object-fit:cover" />`).join('')
                        : 'No images available';
                    $('#propertyImages').html(images);

                    // $('#propertyVideos').val(data.property_assets.videos || 'No videos available');
                    if(data.property_assets.videos !== null){
                      $("#propertyVideos").attr('src', `{{ url('uploads/property_videos/${data.property_assets.videos}') }}`);
                    }
                    if(data.property_assets.documents !== null){
                      $("#propertyDocuments").attr('src', `{{ url('uploads/property_documents/${data.property_assets.documents}') }}`);
                    }
                    $('#propertyDocuments').val(data.property_assets.documents || 'No documents available');
                } else {
                    $('#propertyImages').html('No images available');
                    $('#propertyVideos').val('No videos available');
                    $('#propertyDocuments').val('No documents available');
                }

                console.log(data); 
            },
            error: function (xhr, status, error) {
                console.error('Error fetching property data:', error);
                alert('Unable to load property details. Please try again later.');
            }
        });
    });
});

</script>
@endsection

