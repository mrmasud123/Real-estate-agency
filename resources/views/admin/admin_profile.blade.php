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
</style>

@section('content')
<div class="page-content">
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
             
              <div>
                <div class="admin_image mb-4">
                  <img class="wd-100 rounded-circle" src="{{ (!empty($adminData->photo)) ? url('uploads/admin_images/'. $adminData->photo) : url('no_image.jpg') }}" alt="profile">
                </div>
                <span class="h4 text-capitalize">{{ $adminData->name }}</span>
              </div>
             
            </div>
            
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Name: </label>
              <p class="text-muted">{{ $adminData->name }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email :</label>
              <p class="text-muted">{{ $adminData->email }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone: </label>
              <p class="text-muted">{{ $adminData->phone }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
              <p class="text-muted"> {{ $adminData->address }}</p>
            </div>
            <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
  
                                  <h6 class="card-title">Update Admin Profile</h6>
  
                                  <form method="post" action="{{ route('admin.profile.update') }}" class="forms-sample" enctype="multipart/form-data">
                                    @csrf
                                      <div class="mb-3">
                                          <label for="exampleInputUsername2" class="form-label">Name</label>
                                          <input type="text" class="form-control" id="exampleInputUsername2" autocomplete="off" name="name" value="{{ $adminData->name }}">
                                      </div>
                                      <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Email address</label>
                                          <input type="email" class="form-control" name="email" id="exampleInputEmail1"value="{{ $adminData->email }}">
                                      </div>
                                      <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Phone</label>
                                          <input type="text" class="form-control" name="phone" id="exampleInputEmail1"value="{{ $adminData->phone }}">
                                      </div>
                                      <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Address</label>
                                          <input type="text" class="form-control" name="address" id="exampleInputEmail1"value="{{ $adminData->address }}">
                                      </div>
                                      <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Photo</label>
                                          <input name="photo" class="form-control" type="file" id="image" accept=".png,.jpeg,.jpg">
                                      </div>
                                      <div class="mb-3" id="adminImage">
                                          <img id="showImage" class="rounded-circle" src="{{ (!empty($adminData->photo)) ? url('uploads/admin_images/'. $adminData->photo) : url('no_image.jpg') }}" alt="profile">
                                      </div>
                                      
                                      <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                  </form>
  
                </div>
              </div>
          
        </div>
      </div>
      <!-- middle wrapper end -->

    </div>

        </div>
@endsection