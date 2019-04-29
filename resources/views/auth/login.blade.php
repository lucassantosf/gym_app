@extends('layout_main.app',["current"=>"login"])

@section('body')

    <div class="row" id="rowLogin">
        <div class="col-md-10">

            <h2>Academia System</h2>  

        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLogin">
              Fazer login
            </button>
        </div>      

        <!-- Modal -->
        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="input-group input-group-sl mb-3">   
                                      
                        <input type="text" class="form-control" placeholder="Email" name="email">
                        <input type="password" class="form-control" placeholder="Password" name="password"><br>
                        <button type="submit" class="btn btn-primary">Logar</button>

                    </div>
                </form>

              </div>


            </div>
          </div>        
        </div>
        <!-- End Modal -->

    </div>

@endsection

@section('jquery')
    <script type="text/javascript">
    </script>
@endsection
