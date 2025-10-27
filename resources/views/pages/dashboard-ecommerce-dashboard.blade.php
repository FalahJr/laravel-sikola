@extends('layouts.app')

@section('title', 'Ecommerce Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('main')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Order Statistics -
                                <div class="dropdown d-inline">
                                    <a class="font-weight-600 dropdown-toggle"
                                        data-toggle="dropdown"
                                        href="#"
                                        id="orders-month">{{ __('August') }}</a>
                                    <ul class="dropdown-menu dropdown-menu-sm">
                                        <li class="dropdown-title">{{ __('Select Month') }}</li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('January') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('February') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('March') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('April') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('May') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('June') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('July') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item active">{{ __('August') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('September') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('October') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('November') }}</a></li>
                                        <li><a href="#"
                                                class="dropdown-item">{{ __('December') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ __('24') }}</div>
                                    <div class="card-stats-item-label">{{ __('Pending') }}</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ __('12') }}</div>
                                    <div class="card-stats-item-label">{{ __('Shipping') }}</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ __('23') }}</div>
                                    <div class="card-stats-item-label">{{ __('Completed') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Orders') }}</h4>
                            </div>
                            <div class="card-body">
                                59
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-chart">
                            <canvas id="balance-chart"
                                height="80"></canvas>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Balance') }}</h4>
                            </div>
                            <div class="card-body">
                                $187,13
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-chart">
                            <canvas id="sales-chart"
                                height="80"></canvas>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Sales') }}</h4>
                            </div>
                            <div class="card-body">
                                4,732
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Budget vs Sales') }}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart"
                                height="158"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card gradient-bottom">
                        <div class="card-header">
                            <h4>{{ __('Top 5 Products') }}</h4>
                            <div class="card-header-action dropdown">
                                <a href="#"
                                    data-toggle="dropdown"
                                    class="btn btn-danger dropdown-toggle">{{ __('Month') }}</a>
                                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <li class="dropdown-title">{{ __('Select Period') }}</li>
                                    <li><a href="#"
                                            class="dropdown-item">{{ __('Today') }}</a></li>
                                    <li><a href="#"
                                            class="dropdown-item">{{ __('Week') }}</a></li>
                                    <li><a href="#"
                                            class="dropdown-item active">{{ __('Month') }}</a></li>
                                    <li><a href="#"
                                            class="dropdown-item">{{ __('This Year') }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body"
                            id="top-5-scroll">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <img class="mr-3 rounded"
                                        width="55"
                                        src="{{ asset('img/products/product-3-50.png') }}"
                                        alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">{{ __('86 Sales') }}</div>
                                        </div>
                                        <div class="media-title">{{ __('oPhone S9 Limited') }}</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary"
                                                    data-width="64%"></div>
                                                <div class="budget-price-label">{{ __(',714') }}</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger"
                                                    data-width="43%"></div>
                                                <div class="budget-price-label">{{ __(',700') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded"
                                        width="55"
                                        src="{{ asset('img/products/product-4-50.png') }}"
                                        alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">{{ __('67 Sales') }}</div>
                                        </div>
                                        <div class="media-title">{{ __('iBook Pro 2018') }}</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary"
                                                    data-width="84%"></div>
                                                <div class="budget-price-label">{{ __('7,133') }}</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger"
                                                    data-width="60%"></div>
                                                <div class="budget-price-label">{{ __(',455') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded"
                                        width="55"
                                        src="{{ asset('img/products/product-1-50.png') }}"
                                        alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">{{ __('63 Sales') }}</div>
                                        </div>
                                        <div class="media-title">{{ __('Headphone Blitz') }}</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary"
                                                    data-width="34%"></div>
                                                <div class="budget-price-label">{{ __(',717') }}</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger"
                                                    data-width="28%"></div>
                                                <div class="budget-price-label">{{ __(',835') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded"
                                        width="55"
                                        src="{{ asset('img/products/product-3-50.png') }}"
                                        alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">{{ __('28 Sales') }}</div>
                                        </div>
                                        <div class="media-title">{{ __('oPhone X Lite') }}</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary"
                                                    data-width="45%"></div>
                                                <div class="budget-price-label">{{ __(',972') }}</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger"
                                                    data-width="30%"></div>
                                                <div class="budget-price-label">{{ __(',660') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded"
                                        width="55"
                                        src="{{ asset('img/products/product-5-50.png') }}"
                                        alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">{{ __('19 Sales') }}</div>
                                        </div>
                                        <div class="media-title">{{ __('Old Camera') }}</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary"
                                                    data-width="35%"></div>
                                                <div class="budget-price-label">{{ __(',391') }}</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger"
                                                    data-width="28%"></div>
                                                <div class="budget-price-label">{{ __(',472') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer d-flex justify-content-center pt-3">
                            <div class="budget-price justify-content-center">
                                <div class="budget-price-square bg-primary"
                                    data-width="20"></div>
                                <div class="budget-price-label">{{ __('Selling Price') }}</div>
                            </div>
                            <div class="budget-price justify-content-center">
                                <div class="budget-price-square bg-danger"
                                    data-width="20"></div>
                                <div class="budget-price-label">{{ __('Budget Price') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Best Products') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="owl-carousel owl-theme"
                                id="products-carousel">
                                <div>
                                    <div class="product-item pb-3">
                                        <div class="product-image">
                                            <img alt="image"
                                                src="{{ asset('img/products/product-4-50.png') }}"
                                                class="img-fluid">
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name">{{ __('iBook Pro 2018') }}</div>
                                            <div class="product-review">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="text-muted text-small">{{ __('67 Sales') }}</div>
                                            <div class="product-cta">
                                                <a href="#"
                                                    class="btn btn-primary">{{ __('Detail') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="product-image">
                                            <img alt="image"
                                                src="{{ asset('img/products/product-3-50.png') }}"
                                                class="img-fluid">
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name">{{ __('oPhone S9 Limited') }}</div>
                                            <div class="product-review">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half"></i>
                                            </div>
                                            <div class="text-muted text-small">{{ __('86 Sales') }}</div>
                                            <div class="product-cta">
                                                <a href="#"
                                                    class="btn btn-primary">{{ __('Detail') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="product-image">
                                            <img alt="image"
                                                src="{{ asset('img/products/product-1-50.png') }}"
                                                class="img-fluid">
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name">{{ __('Headphone Blitz') }}</div>
                                            <div class="product-review">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <div class="text-muted text-small">{{ __('63 Sales') }}</div>
                                            <div class="product-cta">
                                                <a href="#"
                                                    class="btn btn-primary">{{ __('Detail') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Top Countries') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-title mb-2">{{ __('July') }}</div>
                                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                        <li class="media">
                                            <span class='flag-icon flag-icon-id'></span>
                                            <div class="media-body ml-3">
                                                <div class="media-title">{{ __('Indonesia') }}</div>
                                                <div class="text-small text-muted">3,282 <i
                                                        class="fas fa-caret-down text-danger"></i></div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <span class='flag-icon flag-icon-my'></span>
                                            <div class="media-body ml-3">
                                                <div class="media-title">{{ __('Malaysia') }}</div>
                                                <div class="text-small text-muted">2,976 <i
                                                        class="fas fa-caret-down text-danger"></i></div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <span class='flag-icon flag-icon-us'></span>

                                            <div class="media-body ml-3">
                                                <div class="media-title">{{ __('United States') }}</div>
                                                <div class="text-small text-muted">1,576 <i
                                                        class="fas fa-caret-up text-success"></i></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 mt-sm-0 mt-4">
                                    <div class="text-title mb-2">{{ __('August') }}</div>
                                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                        <li class="media">
                                            <span class='flag-icon flag-icon-id'></span>
                                            <div class="media-body ml-3">
                                                <div class="media-title">{{ __('Indonesia') }}</div>
                                                <div class="text-small text-muted">3,486 <i
                                                        class="fas fa-caret-up text-success"></i></div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <span class='flag-icon flag-icon-ps'></span>

                                            <div class="media-body ml-3">
                                                <div class="media-title">{{ __('Palestine') }}</div>
                                                <div class="text-small text-muted">3,182 <i
                                                        class="fas fa-caret-up text-success"></i></div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <span class='flag-icon flag-icon-de'></span>

                                            <div class="media-body ml-3">
                                                <div class="media-title">{{ __('Germany') }}</div>
                                                <div class="text-small text-muted">2,317 <i
                                                        class="fas fa-caret-down text-danger"></i></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Invoices') }}</h4>
                            <div class="card-header-action">
                                <a href="#"
                                    class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table-striped table">
                                    <tr>
                                        <th>{{ __('Invoice ID') }}</th>
                                        <th>{{ __('Customer') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Due Date') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    <tr>
                                        <td><a href="#">{{ __('INV-87239') }}</a></td>
                                        <td class="font-weight-600">{{ __('Kusnadi') }}</td>
                                        <td>
                                            <div class="badge badge-warning">{{ __('Unpaid') }}</div>
                                        </td>
                                        <td>{{ __('July 19, 2018') }}</td>
                                        <td>
                                            <a href="#"
                                                class="btn btn-primary">{{ __('Detail') }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">{{ __('INV-48574') }}</a></td>
                                        <td class="font-weight-600">{{ __('Hasan Basri') }}</td>
                                        <td>
                                            <div class="badge badge-success">{{ __('Paid') }}</div>
                                        </td>
                                        <td>{{ __('July 21, 2018') }}</td>
                                        <td>
                                            <a href="#"
                                                class="btn btn-primary">{{ __('Detail') }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">{{ __('INV-76824') }}</a></td>
                                        <td class="font-weight-600">{{ __('Muhamad Nuruzzaki') }}</td>
                                        <td>
                                            <div class="badge badge-warning">{{ __('Unpaid') }}</div>
                                        </td>
                                        <td>{{ __('July 22, 2018') }}</td>
                                        <td>
                                            <a href="#"
                                                class="btn btn-primary">{{ __('Detail') }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">{{ __('INV-84990') }}</a></td>
                                        <td class="font-weight-600">{{ __('Agung Ardiansyah') }}</td>
                                        <td>
                                            <div class="badge badge-warning">{{ __('Unpaid') }}</div>
                                        </td>
                                        <td>{{ __('July 22, 2018') }}</td>
                                        <td>
                                            <a href="#"
                                                class="btn btn-primary">{{ __('Detail') }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">{{ __('INV-87320') }}</a></td>
                                        <td class="font-weight-600">{{ __('Ardian Rahardiansyah') }}</td>
                                        <td>
                                            <div class="badge badge-success">{{ __('Paid') }}</div>
                                        </td>
                                        <td>{{ __('July 28, 2018') }}</td>
                                        <td>
                                            <a href="#"
                                                class="btn btn-primary">{{ __('Detail') }}</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <h4>{{ __('14') }}</h4>
                            <div class="card-description">{{ __('Customers need help') }}</div>
                        </div>
                        <div class="card-body p-0">
                            <div class="tickets-list">
                                <a href="#"
                                    class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>{{ __('My order hasn't arrived yet') }}</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>{{ __('Laila Tazkiah') }}</div>
                                        <div class="bullet"></div>
                                        <div class="text-primary">{{ __('1 min ago') }}</div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>{{ __('Please cancel my order') }}</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>{{ __('Rizal Fakhri') }}</div>
                                        <div class="bullet"></div>
                                        <div>{{ __('2 hours ago') }}</div>
                                    </div>
                                </a>
                                <a href="#"
                                    class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>{{ __('Do you see my mother?') }}</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>{{ __('Syahdan Ubaidillah') }}</div>
                                        <div class="bullet"></div>
                                        <div>{{ __('6 hours ago') }}</div>
                                    </div>
                                </a>
                                <a href="features-tickets.html"
                                    class="ticket-item ticket-more">
                                    View All <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index.js') }}"></script>
@endpush
