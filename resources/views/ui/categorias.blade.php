<!-- Links de NAV CON IMAGEN DE FONDO -->
<div class="col-lg-12 col-sm-12">
    @foreach($categorias as $categoria)
    <a href="{{route('categorias.show', ['categoria' => $categoria->id])}}" class="float-left font-bold lg:ml-12 text-gray-800 uppercase p-3 ">{{$categoria->nombre}}</a>
    @endforeach
</div>    