
<!-- Links de NAV CON IMAGEN DE FONDO -->
<div class="col-lg-3 col-sm-7 text-sm">
<a href="{{route('vacantes.index')}}" class="float-left text-sm font-weight-normal text-white uppercase p-3 nav-link {{Request::is('vacantes') ? 'activo activo2' : ''}}"> Ver Vacantes</a>
<a href="{{route('vacantes.create')}}" class="float-left text-sm font-weight-normal text-white uppercase p-3 nav-link {{Request::is('vacantes/create') ? 'activo activo2' : ''}}"> Nueva Vacante</a>



<!--CLASE DE REQUEST . ESTA CLASE ES PARA INDICARLE AL USUARIO EN QUE PAGINA ESTA 
{{Request::is('vacantes/create') ? 'activo' : ''}}   Al final se ponen unas comillas vacias ya que indica que en el caso de que no este en esa pagina no haga nada
             Aqui se pone la        Esta es la clase de css , se puede personalizar como quiera en los estilos  
                Ruta-->

</div>