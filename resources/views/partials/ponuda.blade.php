@if($item->akcija)
    <div class="akcijatag">
        <span><a href="{!! url('ponude/akcija') !!}">Akcija</a></span>
    </div>
@endif
@if($item->popularno)                        
    <div class="popularnotag">
        <span><a href="{!! url('ponude/popular') !!}">Hot</a></span>
    </div>
@endif
@if($item->created_at > Carbon\Carbon::today()->addWeeks(-1))
    <div class="novotag">
        <span><a href="{!! url('ponude/novo') !!}">Novo</a></span>
    </div>
@endif