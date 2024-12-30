<html>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Login')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('CSS/examp.css') }}" rel="stylesheet">
    
    <div class="">
        <div class="mt-5">
            @if ($errors->any())
                <div class="col-12">
                    @foreach ($errors->all() as $error)                                  
                        <div class="alert alert-danger{{$error}}"></div>    
                    @endforeach    
                </div>              
                           
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>    
            @endif

            @if(session()->has('success'))
                <div class="alert alert-danger">{{session('success')}}</div>        
            @endif
        </div>
        <form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email adress</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3 form-label">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div>
               <a> Don't have an account? <a href="{{route("registration")}}">Sign-up</a></a>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
    <footer>
        <p>&copy; 2023 Film ve Kitap Yorumları</p>
    </footer> 
</html>
