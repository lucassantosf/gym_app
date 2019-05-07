@extends('layouts.login')  
@section('body') 
	<div class="container-fluid">
		<div class="row" style="padding-top: 130px">
			<div class="col-sm-3"></div>
			<div class="col-sm-6"> 
				<div class="card w75" style="background-color: #87CEFA;">
					<div class="card-title" style="text-align: center"> 
						<img src="{{url('svg/aladinLogo.png')}}" width="180" style="margin-top: -80px">
					</div>
				  	<div class="card-body"> 
					    <form method="POST" action="{{route('login')}}">
			                @csrf
			                <div class="form-group input-group-sm mb-3">
			                	<label>Email</label>
    							<input type="text" class="form-control" placeholder="Escreva seu email aqui" name="email" value="{{@old('email')}}">
			                </div>
							<div class="form-group input-group-sm mb-3">
			                	<label>Password</label>
    							<input type="password" class="form-control" placeholder="Escreva sua senha aqui" name="password">
			                </div> 
			                @foreach($errors->all() as $error) 
						        <div class="alert alert-danger mb-3" role="alert">
						            <input type="hidden" name="errors[]">{{$error}}</p>
						        </div>
						    @endforeach
				            <button type="submit" class="btn btn-sm" style="background-color: #1E90FF;">Login</button>  
						</form> 
				  	</div>
				</div>
			</div>
		</div>  
	</div> 
@endsection 