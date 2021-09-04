<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API</title>
    <link rel="stylesheet" href="assets/style.css" type="text/css">
</head>
<body>
<div  class="container">
    <h1>Api</h1>
    <div class="divbody">
        <h3>Registrar Usuario</h3>
        <code>
           METHOD: POST  URL:/usuarios_registrar
           <br>
           { 
                <br>"token" : "912b302f04aec8464474320c5cd06759" -> REQUERIDO
                <br>"email" :"",  -> REQUERIDO
                <br>"password": "" -> REQUERIDO
                <br> "nombre" : "", -> REQUERIDO
                <br> "telefono" : "",
                <br> "RoleId" : "",
                <br>
            }
            <br>
            DEVUELVE:
            {
                <br>"status": "ok",
                <br>"result": {
                    <br>"token",
                    <br>"UsuarioId"
                <br>}
                <br>
            }
        </code>
    </div>  
    <div class="divbody">
        <h3>Login Usuario</h3>
        <code>
           METHOD: POST  URL:/usuarios_login
           <br>
           { 
                <br>"token" : "912b302f04aec8464474320c5cd06759" -> REQUERIDO
                <br>"email" :"",  -> REQUERIDO
                <br>"password": "" -> REQUERIDO
                <br>
            }
            <br>
            DEVUELVE:
            {                <
                <br>"status": "ok",
                <br>"result": {
                    <br>"token",
                    <br>"UsuarioId",
                    <br>"Usuario",
                    <br>"Nombre",
                    <br>"foto_selfie"
                    <br>"RoleId"
                <br>}
                <br>
            }
        </code>
    </div>
    <div class="divbody">
        <h3>Modificar Usuario</h3>
        <code>
           METHOD: POST  URL:/usuarios_modificar
           <br>
           { 
                <br>"token" : "Token del usuario enviado en el login" -> REQUERIDO
                <br>"UsuarioId" :"",  -> REQUERIDO
                <br> "nombre" : "", -> REQUERIDO
                <br> "telefono" : "", -> REQUERIDO
                <br> "RoleId" : ""
                <br>
            }
        </code>
    </div> 
    <div class="divbody">
        <h3>Cambiar clave Usuario</h3>
        <code>
           METHOD: POST  URL:/usuarios_clave
           <br>
           { 
                <br>"token" : "Token del usuario enviado en el login" -> REQUERIDO
                <br>"UsuarioId" :"",  -> REQUERIDO
                <br> "password_anterior" : "", -> REQUERIDO
                <br> "password" : "", -> REQUERIDO
                <br>
            }
        </code>
    </div>  
    <div class="divbody">
        <h3>Listado de Usuarios</h3>
        <code>
           METHOD GET  URL:/usuarios_listar?sort=ASC&search=xx&page=1&id=1
           <br>
           { 
                sort=ASC / DESC - search= busca por usuario y nombre - page=paginado - id= trae el usuario por id

            }
        </code>
    </div>
    <div class="divbody">
        <h3>Borrar Usuario</h3>
        <code>
           METHOD: POST  URL:/usuarios_borrar 
           <br>
           { 
                <br>"token" : "Token del usuario enviado al registrar" -> REQUERIDO
                <br>"UsuarioId" :"",  -> REQUERIDO
                <br>
            }
        </code>
    </div>  
    <div class="divbody">
        <h3>Configuracion Turnos</h3>
        <code>
           METHOD: POST  URL:/configuracion_registrar - Enviar la siguiente informacion como Array
           <br>
           { 
            <br>
            [
                <br>
                {"dia":"1","nombre":"Lunes", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"2","nombre":"Martes", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"3","nombre":"Miercoles", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"4","nombre":"Jueves", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"5","nombre":"Viernes", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"6","nombre":"Sabado", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"}<br>
            ]<br>
            }
        </code>
    </div>
    <div class="divbody">
        <h3>Listar Configuracion Turnos</h3>
        <code>
           METHOD: GET  URL:/configuracion_listar - devuelve la configuracion de turnos como Array
           <br>
           { 
            <br>
            [
                <br>
                {"dia":"1","nombre":"Lunes", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"2","nombre":"Martes", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"3","nombre":"Miercoles", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"4","nombre":"Jueves", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"5","nombre":"Viernes", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"},<br>
                {"dia":"6","nombre":"Sabado", "desde":"10:00", "hasta":"12:00", "desde_1":"","hasta_1":"", "intervalo":"15"}<br>
            ]<br>
            }
        </code>
    </div>
    
</div>
</body>
</html>