@extends('river::admin.layouts.master')
@section('content')

<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Account Settings
            </h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="row g-0">
            <div class="col-3 d-none d-md-block border-end">

              <div class="card-body">
                <h4 class="subheader">Business settings</h4>
                
                <div class="list-group list-group-transparent">
                  <a href="" class="list-group-item list-group-item-action d-flex align-items-center active" id="buttonA">My Account</a>
                  <a href="" class="list-group-item list-group-item-action d-flex align-items-center active" id="buttonB">change Password</a>
                </div>  
              </div>

            </div>
            
            <div class="col d-flex flex-column" id="divAccount">
              <div class="card-body">
                <h2 class="mb-4">My Account</h2>
                <h3 class="card-title">Profile Details</h3>
                <form  method="post" action="" >
                @csrf
                    <div class="row align-items-center">
                        <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(/river/assets/000m.jpg)"></span>
                        </div>
                        <div class="col-auto"><a href="#" class="btn">
                            Change avatar
                          </a>
                        </div>
                        <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                            Delete avatar
                          </a>
                      </div>
                    </div>

                    <h3 class="card-title mt-4">Business Profile</h3>
                    <div class="row g-3">
                    <div class="col-md">
                    <div class="form-label">Name</div>
                    <input type="text" class="form-control" name="" value="{{ $data->name }}">
                  </div>
                  
                  <div class="col-md">
                    <div class="form-label">Location</div>
                    <input type="text" class="form-control" name="location" value="">
                  </div>
                </div>

                </form>
                
                
                <h3 class="card-title mt-4">Email</h3>
                <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.</p>
                <div>
                  <div class="row ">
                    <div class="col-auto">
                      <input type="text" name="email" class="form-control" value=" {{ $data->email }}">
                    </div>
                    
                  </div>
                </div>
               
              <div class="card-footer bg-transparent mt-auto">
                <div class="btn-list justify-content-end">
                  <a href="#" class="btn">
                    Cancel
                  </a>
                  <a href="#" class="btn btn-primary">
                    Submit
                  </a>
                </div>
              </div>
            </div>
          </div>



        <div class="col d-none flex-column" id="divPassword" >
            <div class="card-body">
              <h2 class="mb-4">My Account</h2>

                <div>
                  <div class="row">
                    <form>
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="mb-3"><b>Change Password</b></div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Current Password</label>
                                  <input class="form-control" name="c_password" type="password" placeholder="••••••">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>New Password</label>
                                  <input class="form-control" name="password" type="password" placeholder="••••••">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                  <input class="form-control" name="passwor" type="password" placeholder="••••••"></div>
                              </div>
                            </div>
                          </div>

                    </form>
                   
                  </div>
                <div>
                
            </div>
            </div>
            <div class="card-footer bg-transparent mt-auto">
              <div class="btn-list justify-content-end">
                <a href="#" class="btn">
                  Cancel
                </a>
                <a href="#" class="btn btn-primary">
                  Submit
                </a>
              </div>
            </div>
         </div>

          
        </div>
      </div>
    </div>
    <footer class="footer footer-transparent d-print-none">
      <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
          <div class="col-lg-auto ms-lg-auto">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank" class="link-secondary" rel="noopener">Documentation</a></li>
              <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
              <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
              <li class="list-inline-item">
                <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                  <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                  Sponsor
                </a>
              </li>
            </ul>
          </div>
          <div class="col-12 col-lg-auto mt-3 mt-lg-0">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item">
                Copyright &copy; 2023
                <a href="." class="link-secondary">Tabler</a>.
                All rights reserved.
              </li>
              <li class="list-inline-item">
                <a href="./changelog.html" class="link-secondary" rel="noopener">
                  v1.0.0-beta19
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script>
    // Get references to the buttons and divs
    var buttonA = document.getElementById("buttonA");
    var buttonB = document.getElementById("buttonB");
    var div1 = document.getElementById("divAccount");
    var div2 = document.getElementById("divPassword");

    // Attach click event handler for Button A
    buttonA.addEventListener("click", function (event) {
        event.preventDefault()
        div1.classList.remove("d-none")
        div1.classList.add("d-flex")
        div2.classList.remove("d-flex")
        div2.classList.add("d-none")
       
        // div2.classList.add("d-none")
    });

    // Attach click event handler for Button B
    buttonB.addEventListener("click", function (event) {
        event.preventDefault()
        div1.classList.remove("d-flex")
        div1.classList.add("d-none")
        div2.classList.remove("d-none")
        div2.classList.add("d-flex")
    });

    //    myElement.classList.remove("d-flex");
    // myElement.classList.add("d-none");
</script>
@endsection