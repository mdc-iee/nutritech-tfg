<div class="modal fade" id="deleteModal-{{$recipe->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$recipe->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{route('recipes-destroy', $recipe->id)}}" method="POST" class="modal-content rounded-4 shadow-sm">
            @csrf
            @method('DELETE')
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">Eliminar receta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-3">¿Estás seguro de que deseas eliminar <strong>{{$recipe->name}}</strong>?</p>
                <img src="{{asset('storage/' . $recipe->recipe_image)}}" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
            </div>
            <div class="modal-footer justify-content-center border-top-0">
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>