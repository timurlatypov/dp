<span>{{ $item->user->name }} {{ substr($item->user->surname, 0, 2) }}.</span>
&nbsp;|&nbsp;
@foreach(range(1,5) as $i)
    <span class="fa-stack" style="width:1em; color: #e68900;">
        <i class="far fa-star fa-stack-1x"></i>

        @if($item->stars > 0)
            @if($item->stars > 0.5)
                <i class="fas fa-star fa-stack-1x"></i>
            @else
                <i class="fas fa-star-half fa-stack-1x"></i>
            @endif
        @endif
        @php $item->stars--; @endphp
    </span>
@endforeach
<br>
<div class="mb-2 text-sm-left" style="color: grey;">{{ $item->published_at->isoFormat('Do MMMM Y') }}</div>
<blockquote class="blockquote">
    <p class="mb-0" style="font-size: 0.75em;">{{ $item->review }}</p>
</blockquote>
