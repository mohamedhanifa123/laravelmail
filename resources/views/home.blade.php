@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h1> Welcome Admin </h1> </div>
                        
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form action="{{route('image.store')}}" method=post enctype="multipart/form-data">
                @csrf
                    <div class="form-group"> 
                    <label for="Subject">Subject </label>  
                    <textarea type="text" class="form-control @error('text') is-invalid @enderror" name="subject" value="{{ old('text') }}" required autocomplete="text">
                    </textarea>
                    </div>

                     <div class="form-group">
                     <label for="file">Upload-File </label>
                     <input type="file" name="file[]" multiple accept="image/*">
                     @if ($errors->has('file'))
            @foreach ($errors->get('file') as $error)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $error }}</strong>
            </span>
            @endforeach
          @endif
                     </div>

                     <div class="form-group">
                     <button type="submit" class="btn btn-primary">Send Mail</button>
                     </div>      
                    

                  </form>
                        

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
