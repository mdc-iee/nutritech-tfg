<div class="modal fade" id="imageModal-{{$recipe->id}}" tabindex="-1" aria-labelledby="imageModalLabel-{{$recipe->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
        <div class="modal-body d-flex justify-content-center align-items-center p-0">
            <img src="{{asset('storage/' . $recipe->recipe_image)}}"
                alt="{{$recipe->name}}"
                class="img-fluid"
                style="max-height: 80vh; width: auto; object-fit: contain; border-radius: 10px;">
        </div>
        <div class="modal-footer border-0 d-flex justify-content-center">
            <button type="button" class="btn btn-success px-4 py-2 d-flex align-items-center gap-2" data-bs-dismiss="modal">
                <i class="fas fa-times"></i> Cerrar
            </button>
            </div>
        </div>
    </div>
</div>