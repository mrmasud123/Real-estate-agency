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
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Admin</h6>
                                     <form method="post" action="{{ route('admin.store') }}" class="forms-sample"enctype="multipart/form-data">
                                       @csrf
                                         <div class="mb-3">
                                             <label for="exampleInputUsername2" class="form-label">Name</label>
                                             <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername2"autocomplete="off" name="name" value="{{ @old('name') }}">
                                             @error('name')
                                                 <span class="badge bg-danger">{{ $message }}</span>
                                             @enderror
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Email address</label>
                                             <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"id="exampleInputEmail1"value="{{ @old('email') }}">
                                             @error('email')
                                             <span class="badge bg-danger">{{ $message }}</span>
                                         @enderror
                                         </div>
                                         <div class="mb-3">
                                             <label for="pass" class="form-label">Password</label>
                                             <input type="password" class="form-control @error('password') is-invalid @enderror" id="pass" autocomplete="off"name="password" value="{{ @old('password') }}">
                                             @error('password')
                                             <span class="badge bg-danger">{{ $message }}</span>
                                         @enderror
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label @error('phone') is-invalid @enderror">Phone</label>
                                             <input type="text" class="form-control" name="phone"id="exampleInputEmail1"value="{{ @old('phone') }}">
                                             @error('phone')
                                             <span class="badge bg-danger">{{ $message }}</span>
                                            @enderror
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Address</label>
                                             <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"id="exampleInputEmail1"value="{{ @old('address') }}">
                                             @error('address')
                                             <span class="badge bg-danger">{{ $message }}</span>
                                         @enderror
                                         </div>
                                         <div class="mb-3">
                                             <label for="status" class="form-label">Account Status</label>
                                             <select name="status" id="status" class="status form-control">
                                               <option value="null" selected disabled>Choose Status</option>
                                               <option value="active">Active</option>
                                               <option value="deactive">Deactive</option>
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
                                           <img id="showImage" class="rounded-circle" src="{{ url('no_image.jpg') }}"alt="profile">
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