<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
            <button type="submit" class="btn btn-primary">実行</button>
        </div>
    </div>
</div>