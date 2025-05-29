<div class="modal fade" id="editModal-{{$recipe->id}}" tabindex="-1" aria-labelledby="editModalLabel-{{$recipe->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{route('recipes-update', $recipe->id)}}" method="POST" enctype="multipart/form-data" class="modal-content rounded-4 shadow">
            @csrf
            @method('PUT')

            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold text-success">Editar receta: {{$recipe->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body py-4 px-5">
                <div class="form-floating mb-4">
                    <input type="text" name="name" id="name-{{ $recipe->id }}" class="form-control" value="{{ $recipe->name }}">
                    <label for="name-{{$recipe->id}}">Nombre</label>
                </div>

                <div class="form-floating mb-4">
                    <textarea name="description" id="description-{{ $recipe->id }}" class="form-control" style="height: 100px;">{{ $recipe->description }}</textarea>
                    <label for="description-{{$recipe->id}}">Descripción</label>
                </div>

                <div class="form-floating mb-4">
                    <textarea name="instructions" id="instructions-{{ $recipe->id }}" class="form-control" style="height: 120px;">{{ $recipe->instructions }}</textarea>
                    <label for="instructions-{{$recipe->id}}">Instrucciones</label>
                </div>

                <div class="mb-3 text-center">
                    <label class="form-label d-block fw-semibold mb-2">Imagen:</label>
                    <label for="image-{{$recipe->id}}" class="btn btn-outline-success w-100">
                        <i class="fa fa-upload me-2"></i> Seleccionar imagen
                    </label>

                    <!-- Input to save an image and see its name -->
                    <input type="file" 
                        name="recipe_image" 
                        id="image-{{$recipe->id}}" 
                        accept="image/*" 
                        style="display: none;" 
                        onchange="updateFileName(this, 'filename-{{$recipe->id}}')">
                    <div class="form-text mt-2" id="filename-{{$recipe->id}}">
                        {{$recipe->recipe_image ? basename($recipe->recipe_image) : 'Ningún archivo seleccionado'}}
                    </div>
                </div>
            </div>

            <div class="modal-footer border-top-0 px-5 pb-4">
                <button type="submit" class="btn btn-success px-4">Guardar</button>
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>
<script>
    function updateFileName(input, labelId) {
        const fileName = input.files[0] ? input.files[0].name : 'Ningún archivo seleccionado';
        document.getElementById(labelId).textContent = fileName;
    }
</script>
