@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('Login')</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">@lang('Ajouter une image')</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control " required name="image" value="{{ old('image') }}" required autofocus>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('categorie') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Ajoutez une catégorie</label>

                            <div class="col-md-6">
                                    <select class="form-control" name="category_id" id="category" required>
                                           @foreach ($categories as $category)

                                    <option value="{{$category->id}}" >{{$category->name}}</option>

                                          @endforeach
                                    </select>
                                

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group{{ $errors->has('categorie') ? ' has-error' : '' }}">
                        
                        <label for="category" class="col-md-4 control-label">Ajoutez une Description (optionelle) </label>
                        <div class="col-md-6">
                                <input id="description" type="text" class="form-control " name="description" value="{{ old('description') }}" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                        

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('enregistrer')
                                </button>

        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
