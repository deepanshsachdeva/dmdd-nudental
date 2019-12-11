@extends('layouts.app')
@section ('title' , 'Create Treatment')
@section ('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Create Treatment</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('treatments.index') }}" class="btn btn-secondary" role="button">&larr; Back</a>
        </div>
    </div>
    
    <div class="row">

        <div class="col-6">

         <form action="" method="post">
                <div class="form-group col">
                <label>Name</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
                </div>

                 <div class="form-group col">
                <label>Tooth</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
                 </div>

                 <div class="form-group col">
                <label>Surface</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
                </div>

               <div class = "form-group col">
               <label> Comment</label>
               <textarea class =  "form-control" rows="3">
               </textarea>
               </div>
                 
                
                
                <div class="form-group col">
                <button type="submit" class="btn btn-primary">Create</button>
                </div>

                

                

         </form>

        </div>

    </div>
</div>

@endsection

