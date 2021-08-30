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

                                    <div class="form-group {{ $errors->has('nazwa') ? 'has-error' : '' }}">
                                        {!! Form::label('Nazwa:') !!}
                                        {!! Form::text('nazwa', old('nazwa'), ['class'=>'form-control', 'placeholder'=>'Wpisz nazwę']) !!}
                                        <span class="text-danger">{{ $errors->first('nazwa') }}</span>
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

                        <!-- Sort -->
                        <!--
                        <div class="row">
                            <div class="col-md-6">

                                <h3>Sortuj kategorię / element</h3>
                                {!! Form::open(['route'=>'sort.category']) !!}

                                    @if ($message = Session::get('success_sort'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <button class="btn btn-success">Sortuj</button>
                                    </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                        -->


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

                                    <div class="form-group {{ $errors->has('kategoria') ? 'has-error' : '' }}">
                                        {!! Form::label('Kategoria:') !!}
                                        {!! Form::select('kategoria',$allCategories, old('kategoria'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('kategoria') }}</span>
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

                                    <div class="form-group {{ $errors->has('kategoria_do_edycji') ? 'has-error' : '' }}">
                                        {!! Form::label('Kategoria do edycji:') !!}
                                        {!! Form::select('kategoria_do_edycji',$allCategories, old('kategoria_do_edycji'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('kategoria_do_edycji') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->has('nowa_nazwa') ? 'has-error' : '' }}">
                                        {!! Form::label('Nowa nazwa:') !!}
                                        {!! Form::text('nowa_nazwa', old('nowa_nazwa'), ['class'=>'form-control', 'placeholder'=>'Wpisz nazwę']) !!}
                                        <span class="text-danger">{{ $errors->first('nowa_nazwa') }}</span>
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

                                    <div class="form-group {{ $errors->has('kategoria_do_przeniesienia') ? 'has-error' : '' }}">
                                        {!! Form::label('Kategoria do przeniesienia:') !!}
                                        {!! Form::select('kategoria_do_przeniesienia',$allCategories, old('kategoria_do_przeniesienia'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('kategoria_do_przeniesienia') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->has('nowa_kategoria') ? 'has-error' : '' }}">
                                        {!! Form::label('Nowa kategoria:') !!}
                                        {!! Form::select('nowa_kategoria',$allCategories, old('nowa_kategoria'), ['class'=>'form-control', 'placeholder'=>'Wybierz kategorię']) !!}
                                        <span class="text-danger">{{ $errors->first('nowa_kategoria') }}</span>
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