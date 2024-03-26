<h2 class="lineak2 text-sm text-white">jejekwejfiefkjenejbjejeejekwejfiefkjenejbjejejekwejfiefkjenejbjej</h2>
<h2 class="text-xl font-bold text-gray-700 mt22-30">O tambien puedes filtrar vacantes segun tus intereses</h2>

<form
    action={{ route('vacantes.filtrar')}}
    method="POST"
>
    @csrf

    <div class="col-6 mb-3">

        <label
            for="categoria"
            class="block text-gray-700 text-sm mb-2"
        >Categoría:</label>

        
        <select
            id="categoria"
            class="block appearance-none w-full
                    border border-purple-500 text-purple-500 rounded leading-tight
                    focus:outline-none focus:bg-white focus:border-gray-500 p-2 bg-gray-100"
            name="categoria" 
        >
            <option disabled selected>- Selecciona -</option>

            @foreach ($categorias as $categoria)
                <option
                    {{ old('categoria') == $categoria->id ? 'selected' : '' }}
                    value="{{ $categoria->id }}"
                >
                    {{$categoria->nombre}}
                </option>
            @endforeach
        </select>

        @error('categoria')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1.5 rounded relative mt-3 mb-6" role="alert">
                <strong class="font-bold inline-block">Error!</strong>
                <span class="text-sm inline-block">Llena el campo</span>
            </div>
        @enderror
    </div>

    <div class="col-6 mb-3">
        <label
            for="ubicacion"
            class="block text-gray-700 text-sm mb-2"
        >Ubicación:</label>

        <select
            id="ubicacion"
            class="block appearance-none w-full
                    border border-purple-500 text-purple-500 rounded leading-tight
                    focus:outline-none focus:bg-white focus:border-purple-500 p-2 bg-gray-100"
            name="ubicacion"
        >
            <option disabled selected>- Selecciona -</option>

            @foreach ($ubicaciones as $ubicacion)
                <option
                    {{ old('ubicacion') == $ubicacion->id ? 'selected' : '' }}
                    value="{{ $ubicacion->id }}"
                >
                    {{$ubicacion->nombre}}
                </option>
            @endforeach
        </select>

        @error('ubicacion')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1.5 rounded relative mt-2 mb-2" role="alert">
                <strong class="font-bold inline-block">Error!</strong>
                <span class="text-sm inline-block">Llena el campo</span>

            </div>
        @enderror
    </div>


  
    <button type="submit" class="mx-auto btneon2 btneon--22 font-bold mt-1">Filtrar vacante</button>


</form>