@php
use App\Models\CategoryModel as CategoryModel;

$categoryModel = new CategoryModel();
$itemsCategory = $categoryModel->listItems(null, ['task' => 'news-list-items']);

@endphp
<header class="header">
    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image"
                                    style="background-image:url({{ asset('news/images/zendvn-online.png') }});background-size: contain">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <!-- Navigation -->
                        @if (count($itemsCategory) > 0)
                            <nav class="main_nav">
                                <ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">
                                    @foreach ($itemsCategory as $item)
                                        @php
                                            $name = $item['name'];
                                        @endphp
                                        <li><a href="#">{{ $name }}</a></li>
                                    @endforeach
                                </ul>
                            </nav>
                        @endif
                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container">
        <div class="menu_close">
            <div></div>
            <div></div>
        </div>
    </div>
    @if (count($itemsCategory) > 0)
        <nav class="menu_nav">
            <ul class="menu_mm">
                @foreach ($itemsCategory as $item)
                    @php
                        $name = $item['name'];
                    @endphp
                    <li class="menu_mm"><a href="#">{{ $name }}</a></li>
                @endforeach
            </ul>
        </nav>
    @endif
    <div class="menu_subscribe"><a href="#">Subscribe</a></div>
    <div class="menu_extra">
        <div class="menu_social">
            <ul>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>
