@extends('website.layouts.authHeader')
@section('content')
<div class="checkout-section mt-200 mb-10">
	<div class="container">
		<div class="row">
			<div class="col-lg-10" style="margin: 0 auto;">
				<div class="checkout-accordion-wrap">
					<div class="accordion" id="accordionExample">
						<div class="card single-accordion">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Registration Form
								</button>
								</h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body">
									<div class="billing-address-form">
										<form action="{{ route('userRegister') }}" method="post" enctype="multipart/form-data">
										@csrf
											<div class="row my-3">
												<div class="col-lg-6 my-2">
													<p>
														<input name="name" type="text" placeholder="Name">
														@if($errors->has('name'))
															<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('name')}}</span>
														@endif
													</p>
												</div>
	                                            <div class="col-lg-6 my-2">
													<p>
														<input name="address" type="text" placeholder="Address">
														@if($errors->has('address'))
															<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('address')}}</span>
														@endif
													</p>
												</div>
												<div class="col-lg-6 my-2">
													<p>
														<input name="email" type="email" placeholder="Email">
														@if($errors->has('email'))
															<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('email')}}</span>
														@endif
													</p>
												</div>
												<div class="col-lg-6 my-2">
													<p>
														<input name="phone" type="text" placeholder="Phone No">
														@if($errors->has('phone'))
															<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('phone')}}</span>
														@endif
													</p>
												</div>
												<div class="col-lg-6 my-2">
													<p>
														<input name="password" type="password" placeholder="Password">
														@if($errors->has('password'))
															<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('password')}}</span>
														@endif
													</p>
												</div>
												<div class="col-lg-6 my-2">
													<p>
														<input name="password_confirmation" type="password" placeholder="Confirm Password">
														@if($errors->has('password_confirmation'))
															<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('password_confirmation')}}</span>
														@endif
													</p>
												</div>
												<!--<div class="col-lg-12 my-3">-->
												<!--	<p>-->
												<!--		<input name="image" type="file">-->
												<!--		@if($errors->has('image'))-->
												<!--			<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('image')}}</span>-->
												<!--		@endif-->
												<!--	</p>-->
												<!--</div>-->
											</div>																			
											<button type="submit" class="boxed-btn">Register</button><a href="{{url('loginv1')}}" class="text-dark ml-2">Already have an account?</a>
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