<?xml version = "1.0" encoding = "UTF-8"?>
<yml_catalog date="{{ \Illuminate\Support\Carbon::now()->toRfc3339String() }}">
    <shop>
        <name>DoctorProffi.ru</name>
        <company>ИП Данищук Ольга Игоревна</company>
        <url>https://doctorproffi.ru</url>
        <currencies>
            <currency id="RUR" rate="1"/>
        </currencies>
        <categories>
            @foreach($categories as $category)
            <category id="{{ $category->id }}">{{ $category->name }}</category>
            @if (count($category->subcategories))
            @foreach($category->subcategories as $subcategory)
            <category id="{{ $subcategory->id }}" parentId="{{ $category->id }}">{{ $subcategory->name }}</category>
            @endforeach
            @endif
            @endforeach
        </categories>
        <offers>
            @foreach($items as $item)
                <offer id="{{ $item->vendorCode }}" available="true">
                    <url>{{ $item->link }}</url>
                    <price>{{ $item->discountedPrice }}</price>
                    <oldprice>{{ $item->basePrice }}</oldprice>
                    <currencyId>RUB</currencyId>
                    @if(isset($item->categoryId))
                    <categoryId>{{ $item->categoryId }}</categoryId>
                    @endif
                    <picture>{{ $item->picture }}</picture>
                    <delivery>true</delivery>
                    <name>{{ $item->title }}</name>
                    <vendor>{{ $item->vendor }}</vendor>
                    <vendorCode>{{ $item->vendorCode }}</vendorCode>
                    <sales_notes>Оплата: Наличные, пластиковые карты</sales_notes>
                </offer>
            @endforeach
        </offers>
    </shop>
</yml_catalog>
