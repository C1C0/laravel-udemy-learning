@if(!isset($show) || $show)
    <span style="font-size: .3em" class="badge badge-{{$type ?? 'success'}}">
        {{$slot}}
    </span>
@endif
