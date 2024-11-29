<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6">Crear Nueva Publicación</h2>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('publicacion.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">
                            Descripción del Trabajo
                        </label>
                        <textarea 
                            id="descripcion" 
                            name="descripcion" 
                            rows="4" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Describe los detalles del trabajo, requisitos, responsabilidades..."
                            required
                        >{{ old('descripcion') }}</textarea>
                    </div>

                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700">
                            Estado del Empleo
                        </label>
                        <select 
                            id="estado" 
                            name="estado" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option value="">Selecciona un estado</option>
                            <option value="Tiempo Completo" {{ old('estado') == 'Tiempo Completo' ? 'selected' : '' }}>Disponible</option>
                            <option value="Medio Tiempo" {{ old('estado') == 'Medio Tiempo' ? 'selected' : '' }}>Ocupado</option>
                        </select>
                    </div>

                    <div>
                        <label for="direccion" class="block text-sm font-medium text-gray-700">
                            Dirección
                        </label>
                        <input 
                            type="text" 
                            id="direccion" 
                            name="direccion" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Ingresa la dirección del trabajo"
                            value="{{ old('direccion') }}"
                            required
                        >
                    </div>

                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="bg-[#031926] text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
                        >
                            Crear Publicación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>