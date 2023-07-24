@extends('website.layouts.authHeader')
@section('content')
<div class="checkout-section mt-200 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8" style="margin: 0 auto;">
				<div class="checkout-accordion-wrap">
					<div class="accordion" id="accordionExample">
						<div class="card single-accordion">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Login Form
								</button>
								</h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body">
									<div class="billing-address-form">
										<form action="{{ route('userLogin') }}" method="post" enctype="multipart/form-data">
										@csrf						        	
											<p>
												<input name="email" type="email" placeholder="Email">
											</p>
											@if($errors->has('email'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('email')}}</span>
											@endif	
											<p>
												<input name="password" type="password" placeholder="Password">
											</p>
											@if($errors->has('password'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('password')}}</span>
											@endif							        	
											<button type="submit" class="boxed-btn">Login</button><a href="{{url('signupv1')}}" class="text-dark ml-2">Create an new account?</a>
											<a href="{{url('forgot-password')}}" class="text-dark ml-2 float-right"><b>Forgot Password?</b></a>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
jQuery( document ).ready(function() {
    $('form input').focus(function(){
		$(this).siblings(".displayBadges").fadeOut(1500);
    });
});
</script>
<script>
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            Swal.fire({
            icon: 'info',
            title: "Error!",
            text: "{{ session('message') }}",
        });
        break;
        case 'warning':
            Swal.fire({
            icon: 'warning',
            text: "{{ session('message') }}",
        });
        break;
        case 'success':
            Swal.fire({
            icon: 'success',
			title: 'Success',
            text: "{{ session('message') }}",
            showConfirmButton: false,
			timer: 3000
        });
        break;
        case 'error':
            Swal.fire({
            icon: 'error',
			title: 'Error',
            text: "{{ session('message') }}",
            showConfirmButton: false,
			timer: 3000
        });
        break;
    }
@endif
</script>
@endsection