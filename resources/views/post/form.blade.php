
       
        @if ($errors->any())
        
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Uw post kan niet worden toegevoegd.
        </div>
      
              
        @endif 
    
    <div class="row">
    <div class="col-12 col-md-10">
        
        <div class="form-group required @error('title') error  @enderror" >
            <label for="title" class="col-form-label control-label">Titel </label>
            @error("title")
                <span class="text-danger">{{$message}}</span>
            @enderror
            <input  name="title" class="form-control @error('title') is-invalid @enderror" type ="text" max="255" value="{{old('title') ?? $post->title}}">
        
        </div>
         
        <div class="form-group required @error('text') error  @enderror">
            <label required for="text" class="col-form-label control-label">Tekst</label>
            @error("text")
                <span class="text-danger">{{$message}}</span>
            @enderror
             <textarea  name="text" class="form-control form-control @error('text') is-invalid @enderror {width: 100%}" type="text" name="text" cols="100" rows="4">{{old('text') ?? $post->text}}</textarea>
           
        </div>
        <div >
            <small class="ml-2 text-">* verplicht</small>
        </div>

