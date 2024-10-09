<div class="modal-content">

    <div class="modal-header">
        <h1 class="modal-title fs-5" id="delete-confirmation-modal-label-{{ $threat->id }}">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body text-center">
        Are you sure you want to delete this threat?
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ route('threats.destroy', $threat->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>

</div>