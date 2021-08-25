<!DOCTYPE html>

<html>

<head>

    <title>Laravel Category Treeview Example - NiceSnippets.com</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
</head>

<body>

    <div class="container">     

        <div class="panel panel-primary">

            <div class="panel-heading">Manage Category TreeView</div>

                <div class="panel-body">

                    <div class="row">

                        <div class="col-md-6">

                            <h3>Category List</h3>
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



                    <div class="row">
                        <div class="col-md-6">

                            <h3>Add New Category</h3>

                            {!! Form::open(['route'=>'add.category']) !!}


                                @if ($message = Session::get('success_add'))

                                    <div class="alert alert-success alert-block">

                                        <button type="button" class="close" data-dismiss="alert">×</button>

                                        <strong>{{ $message }}</strong>

                                    </div>

                                @endif

                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                                    {!! Form::label('Title:') !!}

                                    {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}

                                    <span class="text-danger">{{ $errors->first('title') }}</span>

                                </div>

                                <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">

                                    {!! Form::label('Category:') !!}

                                    {!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}

                                    <span class="text-danger">{{ $errors->first('parent_id') }}</span>

                                </div>

                                <div class="form-group">

                                    <button class="btn btn-success">Add New</button>

                                </div>

                            {!! Form::close() !!}

                        </div>
                    </div>





                    <div class="row">
                        <div class="col-md-6">

                            <h3>Delete Category</h3>

                            {!! Form::open(['route'=>'delete.category']) !!}


                                @if ($message = Session::get('success_delete'))

                                    <div class="alert alert-success alert-block">

                                        <button type="button" class="close" data-dismiss="alert">×</button>

                                        <strong>{{ $message }}</strong>

                                    </div>

                                @endif



                                <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">

                                    {!! Form::label('Category:') !!}

                                    {!! Form::select('id',$allCategories, old('id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}

                                    <span class="text-danger">{{ $errors->first('id') }}</span>

                                </div>

                                <div class="form-group">

                                    <button class="btn btn-success">Delete</button>

                                </div>

                            {!! Form::close() !!}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- 4 include the jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <!-- 5 include the minified jstree source -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
    $(function () {
        // 6 create an instance when the DOM is ready
        $('#jstree').jstree();
        // 7 bind to events triggered on the tree
        $('#jstree').on("changed.jstree", function (e, data) {
        console.log(data.selected);
        });
        // 8 interact with the tree - either way is OK
        $('button').on('click', function () {
        $('#jstree').jstree(true).select_node('child_node_1');
        $('#jstree').jstree('select_node', 'child_node_1');
        $.jstree.reference('#jstree').select_node('child_node_1');
        });
    });
    </script>
</body>

</html>