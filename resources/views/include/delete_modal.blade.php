<div class="modal fade" id="delmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Voulez-vous vraiment supprimer l'element?
                </p>
            </div>
            <div class="modal-footer">
                <form  action="" method="POST" id="deleteForm" >
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>Annuler</button>
                    <button type="submit" class="btn btn-danger btn-sm" style="margin-right: 5px"><span class="fa fa-check" ></span>Confirmer</button>
                </form>

            </div>
        </div>
    </div>
</div>
