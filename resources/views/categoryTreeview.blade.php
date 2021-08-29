@extends('layouts.app')

@section('content')
 <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
-->

    <div class="container">     

        <div class="panel panel-primary">
            <div class="panel-heading">Mechanizm zarządzania strukturą drzewiastą</div>
                <div class="panel-body">

                    <!-- Display -->
                    <div class="row">
                        <div class="col-md-6">
                        
                            <input type="button" class="btn btn-success" value="Rozwiń wszystko" onclick="$('#jstree').jstree('open_all');">
                            <input type="button" class="btn btn-success" value="Zwiń wszystko" onclick="$('#jstree').jstree('close_all');">

                            <h3>Lista kategorii</h3>
                            <div id="jstree">
                                <ul id="tree1">
                                    @foreach($categories as $category)
                                        <li>
                                            {{ $category->title }}
                                            @if(count($category->childs))
                                                @include('manageChild',['childs' => $category->childs])
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>

                    @if (Auth::user())
                        <!-- Add -->
                        <div class="row">
                            <div class="col-md-6">

                                <h3>Dodaj nową kategorię / element</h3>
                                {!! Form::open(['route'=>'add.category']) !!}
                                    @if ($message = Session::get('success_add'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif

                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        {!! Form::label('Nazwa:') !!}
                                        {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Wpisz nazwę']) !!}
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                        {!! Form::label('Przypisz do:') !!}
                                        {!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success">Dodaj</button>
                                    </div>

                                {!! Form::close() !!}

                            </div>
                        </div>




                        <!-- Delete -->
                        <div class="row">
                            <div class="col-md-6">

                                <h3>Usuń kategorię / element</h3>
                                {!! Form::open(['route'=>'delete.category']) !!}
                                    @if ($message = Session::get('success_delete'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif

                                    <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                        {!! Form::label('Kategoria:') !!}
                                        {!! Form::select('id',$allCategories, old('id'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('id') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success">Usuń</button>
                                    </div>

                                {!! Form::close() !!}

                            </div>
                        </div>



                        <!-- Edit -->
                        <div class="row">
                            <div class="col-md-6">

                                <h3>Edytuj kategorię / element</h3>
                                {!! Form::open(['route'=>'edit.category']) !!}
                                    @if ($message = Session::get('success_edit'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif

                                    <div class="form-group {{ $errors->has('id_edit') ? 'has-error' : '' }}">
                                        {!! Form::label('Kategoria:') !!}
                                        {!! Form::select('id_edit',$allCategories, old('id_edit'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('id_edit') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->has('title_edit') ? 'has-error' : '' }}">
                                        {!! Form::label('Nowa nazwa:') !!}
                                        {!! Form::text('title_edit', old('title_edit'), ['class'=>'form-control', 'placeholder'=>'Wpisz nazwę']) !!}
                                        <span class="text-danger">{{ $errors->first('title_edit') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success">Edytuj</button>
                                    </div>

                                {!! Form::close() !!}

                            </div>
                        </div>



                        <!-- Transferring -->
                        <div class="row">
                            <div class="col-md-6">

                                <h3>Przenieś kategorię / element</h3>
                                {!! Form::open(['route'=>'transfer.category']) !!}
                                    @if ($message = Session::get('success_transfer'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif

                                    @if ($message = Session::get('error_transfer'))
                                        <div class="alert alert-danger alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif                                

                                    <div class="form-group {{ $errors->has('id_transfer') ? 'has-error' : '' }}">
                                        {!! Form::label('Kategoria:') !!}
                                        {!! Form::select('id_transfer',$allCategories, old('id_transfer'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('id_transfer') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->has('parent_id_transfer') ? 'has-error' : '' }}">
                                        {!! Form::label('Nowa kategoria:') !!}
                                        {!! Form::select('parent_id_transfer',$allCategories, old('parent_id_transfer'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('parent_id_transfer') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success">Przenieś</button>
                                    </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    @else
                        <p><br/>Zaloguj się, aby uzyskać dostęp do zarządzania drzewem</p>
                    @endif

                </div>

            </div>

        </div>

    </div>


@endsection