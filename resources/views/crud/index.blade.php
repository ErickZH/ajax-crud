<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CRUD AJAX</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="containers">
            <h2>CRUD AJAX EN LARAVEL 5.4</h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addModal">Agregar</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Email</th>
                        <th>Accciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $x)
                        <tr>
                            <td>{{ $x->nombre }}</td>
                            <td>{{ $x->edad }}</td>
                            <td>{{ $x->email }}</td>
                            <td>
                                <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{ $x->id}}')">Ver</button>

                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{ $x->id }}')">Editar</button>

                                <button class="btn btn-danger" onclick="fun_delete('{{ $x->id }}')">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('crud/view')}}">
            <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('crud/delete')}}">

            <!-- Modal para agregar persona -->
            <div class="modal fade" id="addModal" role="dialog">
                <div class="modal-dialog">
                    <!-- contenido del modal-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Agregar persona</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('crud')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="edad">Edad:</label>
                                        <input type="text" class="form-control" id="edad" name="edad">
                                    </div>

                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="">
                                </div>
                                <button type="submit" class="btn btn-default">Enviar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para ver una persona -->
            <div class="modal fade" id="viewModal" role="dialog">
                <div class="modal-dialog">
                    <!-- contenido del modal-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Ver</h4>
                        </div>

                        <div class="modal-body">
                            <p><b>Nombre:</b><span id="view_nombre" class="text-success"></span></p>
                            <p><b>Edad:</b><span id="view_edad" class="text-success"></span></p>
                            <p><b>Email:</b><span id="view_email" class="text-success"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para editar a una persona -->
            <div class="modal fade" id="editModal" role="dialog">
                <div class="modal-dialog">
                    <!-- contenido del modal-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Editar</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('crud/update')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="edit_nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="edit_nombre" name="edit_nombre">
                                </div>
                                <div class="form-group">
                                    <label for="edit_edad">Edad:</label>
                                    <input type="text" class="form-control" id="edit_ead" name="edit_edad">
                                </div>
                            </div>

                            <label for="edit_email">Email:</label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function fun_view(id)
                {
                    var view_url = $("#hidden_view").val();
                    // Petición ajax
                    $.ajax({
                        url: view_url,
                        type: "GET",
                        data: {"id":id},
                        success: function(result)
                        {
                            $("#edit_id").val(result.id);
                            $("#edit_nombre").val(result.nombre);
                            $("#edit_edad").val(result.edad);
                            $("#edit_email").val(result.eamil);
                        }
                    });
                }

                function fun_edit(id)
                {
                    var view_url = $("#hidden_view").val();

                    $.ajax({
                        url: view_url,
                        type: "GET",
                        data: {"id":id},
                        success: function(result)
                        {
                            $("#edit_id").val(result.id);
                            $("#edit_nombre").val(result.nombre);
                            $("#edit_edad").val(result.edad);
                            $("#edit_email").val(result.email);
                        }
                    });
                }

                function fun_delete(id)
                {
                    var conf = confirm("Seguro de eliminar está persona?");
                    if (conf)
                    {
                        var delete_url = $("#hidden_delete").val();

                        $.ajax({
                            url: delete_url,
                            type: "POST",
                            data: {"id":id, _token: "{{ csrf_token() }}"},
                            success: function(response)
                            {
                                alert(response);
                                location.reload();
                            }
                        });
                    }
                    else
                    {
                        return false;
                    }
                }
            </script>
        </div>
    </body>
</html>
