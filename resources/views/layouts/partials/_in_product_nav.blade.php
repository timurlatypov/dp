<div class="ml-2">
    @if(str_contains(url()->current(), 'category/for-face'))
    <h4 class="title mt-0 mb-3"><nobr>Для лица</nobr></h4>
    <ul class="list-group py-0">
    @foreach($for_face->subcategories as $subcategory)
        <li class="list-group-item py-0">
            <a class="btn btn-sm text-left {{ request()->is('category/for-face/'.$subcategory->slug) ? 'btn-primary text-light font-weight-bold' : 'btn-white text-dark font-weight-bold' }}" href="{{ route('show.category.subcategory', [$for_face, $subcategory]) }}">{{ $subcategory->name }}</a></li>
    @endforeach
    </ul>
    @endif

    @if(str_contains(url()->current(), 'category/for-body'))
    <h4 class="title mt-0 mb-3"><nobr>Для тела</nobr></h4>
    <ul class="list-group py-0 pb-5">
        @foreach($for_body->subcategories as $subcategory)
            <li class="list-group-item py-0">
                <a class="btn btn-sm text-left {{ request()->is('category/for-body/'.$subcategory->slug) ? 'btn-primary text-light font-weight-bold' : 'btn-white text-dark font-weight-bold' }}" href="{{ route('show.category.subcategory', [$for_body, $subcategory]) }}">{{ $subcategory->name }}</a></li>
        @endforeach
    </ul>
    @endif
</div>