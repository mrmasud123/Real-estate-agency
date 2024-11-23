@extends('admin.admin_dashboard_layout')

@section('content')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="d-inline card-title">Update <h6 class="badge bg-warning">{{ $data->name }}</h6></h6>
                                     <form method="post" action="{{ route('admin.update.store', $data->id) }}" class="forms-sample"enctype="multipart/form-data">
                                       @csrf
                                         <div class="mb-3">
                                             <label for="exampleInputUsername2" class="form-label">Name</label>
                                             <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername2"autocomplete="off" name="name" value="{{ $data->name }}">
                                             @error('name')
                                                 <span class="badge bg-danger">{{ $message }}</span>
                                             @enderror
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Email address</label>
                                             <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"id="exampleInputEmail1"value="{{ $data->email }}">
                                             @error('email')
                                             <span class="badge bg-danger">{{ $message }}</span>
                                         @enderror
                                         </div>
                                         
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label @error('phone') is-invalid @enderror">Phone</label>
                                             <input type="text" class="form-control" name="phone"id="exampleInputEmail1"value="{{ $data->phone }}">
                                             @error('phone')
                                             <span class="badge bg-danger">{{ $message }}</span>
                                            @enderror
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Address</label>
                                             <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"id="exampleInputEmail1"value="{{ $data->address }}">
                                             @error('address')
                                             <span class="badge bg-danger">{{ $message }}</span>
                                         @enderror
                                         </div>
                                         <div class="mb-3">
                                            <label for="status" class="form-label">Account Status</label>
                                            <select name="status" id="status" class="status form-control">
                                                <option value="" selected disabled>Choose Status</option>
                                                <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <span class="badge bg-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Upload Image</label>
                                             <input name="photo" class="form-control" type="file" id="image" accept=".png,jpeg,.jpg">
                                         </div>
                                         <div class="mb-3" id="adminImage">
                                            <img id="showImage" class="rounded-circle" src="{{ (!empty($data->photo)) ? url('uploads/admin_images/'. $data->photo) : url('no_image.jpg') }}" alt="profile">
                                       </div>
                                       <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Upload CV</label>
                                        <input name="cv" class="form-control" type="file" id="cv" accept=".pdf">
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