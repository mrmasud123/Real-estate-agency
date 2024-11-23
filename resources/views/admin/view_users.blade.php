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

        <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
          <i class="btn-icon-prepend" data-feather="download-cloud"></i>
          Download Admin List
        </button>
      </div>
    </div>

     <!-- row -->

    <div class="row">
      <div class="col-lg-12 col-xl-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th class="pt-0">Admin Id</th>
                    <th class="pt-0">Admin Name</th>
                    <th class="pt-0">Admin E-mail</th>
                    <th class="pt-0">Image</th>
                    <th class="pt-0">Role</th>
                    <th class="pt-0">Status</th>
                    <th class="pt-0">Address</th>
                    <th class="pt-0">Phone</th>
                    <th class="pt-0">Bio Data</th>
                    <th class="pt-0">Actions</th>
                
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allUsers as $singleUser)
                  <tr>
                    <td>{{ $singleUser->id }}</td>
                    <td>{{ $singleUser->name }}</td>
                    <td>{{ $singleUser->email }}</td>
                    <td>
                        <div style="width:30px; height:30px;">
                            <img style="width: 100%;height:100%; object-fit:cover" class="rounded-circle" src="{{ (!empty($singleUser->photo)) ? url('uploads/admin_images/'. $singleUser->photo) : url('no_image.jpg') }}" alt="">
                        </div>
                    </td>
                    <td><span class="badge bg-success">{{ strtoupper($singleUser->role) }}</span></td>
                    <td>
                      @if($singleUser->status === 'deactive')
                        <span class="badge bg-danger">{{ $singleUser->status }}</span>
                      @else
                        <span class="badge bg-success">{{ $singleUser->status }}</span>
                      @endif
                    </td>
                    <td>
                        @if (empty($singleUser->address))
                            <span class="badge bg-danger">TBA</span>
                        @else
                            {{ $singleUser->address }}
                        @endif
                    </td>
                    <td>
                      @if (empty($singleUser->phone))
                        <span class="badge bg-danger">TBA</span>
                      @else
                        {{ $singleUser->phone }}
                      @endif</td>
                    <td>
                        @if (empty($singleUser->cv))
                            <span class="badge bg-danger">TBA</span>
                        @else
                            {{ $singleUser->cv }}
                        @endif
                    </td>
                    <td>
                      <a href="javascript:void(0);" 
                        class="showAdminBtn" 
                        data-id="{{ $singleUser->id }}" 
                        data-bs-toggle="modal" 
                        data-bs-target="#varyingModal">
                        <i class="me-2 icon-md text-warning" data-feather="eye"></i>
                      </a>
                      <a href=""><i class="me-2 icon-md text-danger" data-feather="trash"></i></a>
                      <a href="{{ route('admin.update', $singleUser->id) }}"><i class="me-2 icon-md text-warning" data-feather="edit"></i></a>
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
    
    <div class="modal fade" id="varyingModal" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="varyingModalLabel">User Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="editAdminForm">
            <div class="modal-body">
              <div class="mb-3">
                <label for="adminName" class="form-label">Name</label>
                <input type="text" class="form-control" id="adminName" name="name" placeholder="Admin Name">
              </div>
              <div class="mb-3">
                <label for="adminEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="adminEmail" name="email" placeholder="Admin Email">
              </div>
              <div class="mb-3">
                <label for="adminAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="adminAddress" name="addresss" placeholder="Admin Address">
              </div>
              <div class="mb-3">
                <label for="adminPhone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="adminPhone" name="phone" placeholder="Admin Phone">
              </div>
              <div class="mb-3">
                <label for="adminRole" class="form-label">Role</label>
                <input type="text" class="form-control" id="adminRole" name="role" placeholder="Admin Role">
              </div>
              <div class="mb-3" id="adminImage">
                <img id="showImage" class="rounded-circle" src="" alt="profile">
            </div>
              <input type="hidden" id="adminId" name="id"> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    

@endsection

@section('scripts')
<script>
  $(document).ready(function(){
    $('.showAdminBtn').on('click',function(e){
      // $('#adminName').val("Masud Rana");
      $adminId=$(this).attr('data-id');
      $.ajax({
            url: `/admin/${$adminId}`, 
            type: 'GET',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#adminId').val(data.id);
                $('#adminName').val(data.name);
                $('#adminEmail').val(data.email);
                $('#adminRole').val(data.role);
                $('#adminStatus').val(data.status);
                $('#adminAddress').val(data.address ? data.address : 'TBA');
                $('#adminPhone').val(data.phone ? data.phone : 'TBA');
                if(data.photo === null){
                  $("#showImage").attr('src', `{{ url('no_image.jpg') }}`);
                }else{
                  $("#showImage").attr('src', `{{ url('uploads/admin_images/${data.photo}') }}`);
                }
                console.log(data);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching user data:', error);
                alert('Unable to load admin details. Please try again.');
            }
        });
    });
  });
</script>
@endsection