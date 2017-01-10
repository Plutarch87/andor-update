<!-- Item modal -->
<div id="item-modal{{ $item->id }}" class="modal fade">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ $item->name }}</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            {!! Html::image('storage/andor/'.$item->img, $item->name) !!}
        </div>
        <div class="footer">
            <p>{{ $item->description }}</p>
        </div>
    </div>  
</div>