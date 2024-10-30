<nav class="tw-bg-white tw-shadow">
    <!-- Desktop Menu -->
    <div class="tw-hidden lg:tw-block">
        <div class="tw-container tw-mx-auto tw-px-4">
            <div class="tw-flex tw-justify-center tw-items-center tw-h-16">
                <!-- Main Menu -->
                <div class="tw-flex tw-space-x-2">
                    <!-- Regular Menu Item -->
                    <a href="{{ route('care-programs') }}" class="tw-text-red-900 hover:tw-text-red-600 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-whitespace-nowrap">
                        Уходовые программы
                    </a>

                    <!-- Dropdown Menu Items -->
                    <div class="tw-relative tw-group">
                        <button class="tw-text-gray-700 group-hover:tw-text-gray-900 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-inline-flex tw-items-center tw-whitespace-nowrap">
                            <span>Лицо</span>
                        </button>

                        <!-- First Level Dropdown -->
                        <div class="tw-hidden group-hover:tw-block tw-absolute tw-z-50 tw-mt-0 tw-w-48">
                            <div class="tw-pt-2">
                                <div class="tw-bg-white tw-rounded-md tw-shadow-lg tw-ring-1 tw-ring-black tw-ring-opacity-5">
                                    <div class="tw-py-1">
                                        @foreach($for_face->subcategories as $subcategory)
                                            <a href="{{ route('show.category.subcategory', [$for_face, $subcategory]) }}" class="tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100 tw-whitespace-nowrap">
                                                {{ $subcategory->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tw-relative tw-group">
                        <button class="tw-text-gray-700 group-hover:tw-text-gray-900 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-inline-flex tw-items-center tw-whitespace-nowrap">
                            <span>Тело</span>
                        </button>

                        <!-- First Level Dropdown -->
                        <div class="tw-hidden group-hover:tw-block tw-absolute tw-z-50 tw-mt-0 tw-w-48">
                            <div class="tw-pt-2">
                                <div class="tw-bg-white tw-rounded-md tw-shadow-lg tw-ring-1 tw-ring-black tw-ring-opacity-5">
                                    <div class="tw-py-1">
                                        @foreach($for_body->subcategories as $subcategory)
                                            <a href="{{ route('show.category.subcategory', [$for_body, $subcategory]) }}" class="tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100">
                                                {{ $subcategory->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tw-relative tw-group">
                        <button class="tw-text-gray-700 group-hover:tw-text-gray-900 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-inline-flex tw-items-center tw-whitespace-nowrap">
                            <span>Направленный уход</span>
                        </button>

                        <!-- First Level Dropdown -->
                        <div class="tw-hidden group-hover:tw-block tw-absolute tw-z-50 tw-mt-0 tw-w-48">
                            <div class="tw-pt-2">
                                <div class="tw-bg-white tw-rounded-md tw-shadow-lg tw-ring-1 tw-ring-black tw-ring-opacity-5">
                                    <div class="tw-py-1">
                                        @foreach($direct_care->subcategories as $subcategory)
                                            <a href="{{ route('show.category.subcategory', [$direct_care, $subcategory]) }}" class="tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100">
                                                {{ $subcategory->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="/brand/sets" class="tw-text-gray-700 hover:tw-text-gray-900 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-whitespace-nowrap">
                        Наборы
                    </a>

                    <div class="tw-relative tw-group">
                        <button class="tw-text-gray-700 group-hover:tw-text-gray-900 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-inline-flex tw-items-center tw-whitespace-nowrap">
                            <span>Бренды</span>
                        </button>

                        <!-- First Level Dropdown -->
                        <div class="tw-hidden group-hover:tw-block tw-absolute tw-z-50 tw-mt-0 tw-w-48">
                            <div class="tw-pt-2">
                                <div class="tw-bg-white tw-rounded-md tw-shadow-lg tw-ring-1 tw-ring-black tw-ring-opacity-5">
                                    <div class="tw-py-1">
                                        @foreach($brands as $brand)
                                            @if($brand->name === 'DoctorProffi')
                                                <!-- Nested Dropdown -->
                                                <div class="tw-relative tw-group/sub">
                                                    <button class="tw-w-full tw-text-left tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 tw-font-medium hover:tw-bg-gray-100 tw-inline-flex tw-items-center tw-justify-between">
                                                        <span>{{ $brand->name }}</span>
                                                        <svg class="tw-w-4 tw-h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </button>
                                                    <div class="tw-hidden group-hover/sub:tw-block tw-absolute tw-left-full tw-top-0 tw-w-48">
                                                        <div class="">
                                                            <div class="tw-bg-white tw-rounded-md tw-shadow-lg tw-ring-1 tw-ring-black tw-ring-opacity-5">
                                                                <div class="tw-py-1">
                                                                    @foreach($brand->lines as $line)
                                                                        <a href="{{ route('show.brand.line.products', [$brand, $line]) }}" class="tw-font-medium tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100">
                                                                            {{ $line->name }}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <a href="{{ route('show.brand.products', $brand) }}" class="tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100">
                                                    {{ $brand->name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="/delivery" class="tw-text-gray-700 hover:tw-text-gray-900 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-whitespace-nowrap">
                        Доставка и оплата
                    </a>
                    <a href="/bookmarks" class="tw-text-blue-900 hover:tw-text-blue-600 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-whitespace-nowrap">
                        Избранное
                    </a>
                    <a href="/contacts" class="tw-text-gray-700 hover:tw-text-gray-900 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-whitespace-nowrap">
                        Контакты
                    </a>
                    <cart :cart_items="{{ $cart }}" cart_count="{{ $cart->count() }}"></cart>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="lg:tw-hidden">
        @php
            $brandsData = $brands->map(function($brand) {
                return [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'url' => route('show.brand.products', $brand),
                    'lines' => $brand->name === 'DoctorProffi' ? $brand->lines->map(function($line) use ($brand) {
                        return [
                            'id' => $line->id,
                            'name' => $line->name,
                            'url' => route('show.brand.line.products', [$brand, $line])
                        ];
                    }) : []
                ];
            });

            $forFaceData = $for_face->subcategories->map(function($subcategory) use ($for_face) {
                return [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'url' => route('show.category.subcategory', [$for_face, $subcategory])
                ];
            });

            $forBodyData = $for_body->subcategories->map(function($subcategory) use ($for_body) {
                return [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'url' => route('show.category.subcategory', [$for_body, $subcategory])
                ];
            });

            $directCareData = $direct_care->subcategories->map(function($subcategory) use ($direct_care) {
                return [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'url' => route('show.category.subcategory', [$direct_care, $subcategory])
                ];
            });
        @endphp
        <mobile-menu 
            :brands='@json($brandsData)'
            :cart-items="{{ $cart }}"
            :cart-count="{{ $cart->count() }}"
            :is-authenticated="{{ auth()->check() ? 'true' : 'false' }}"
            :for-face='@json($forFaceData)'
            :for-body='@json($forBodyData)'
            :direct-care='@json($directCareData)'
        ></mobile-menu>
    </div>
</nav>
