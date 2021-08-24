@extends('layouts.app')

@section('title', 'Ourlife | Changed our life')
@section('page-heading', 'Profile Statistics')

@section('content')
    <div class="page-content">
        <section class="row">
            {{-- Card total --}}
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Produk</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($productsCount) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-sort-up"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Kategori</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($categoriesCount) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="fas fa-sort-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Sub Kategori</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($subCategoriesCount) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="far fa-image"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Gambar Slider</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($carouselsCount) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tables section --}}
            <div class="card">
                <div class="card-header">
                    <h4>Table Slider</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carousels as $carousel)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td><a href="{{ $carousel->image }}" target="_blank">Lihat gambar</a>
                                            </td>
                                            <td>{{ $carousel->title }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Tables section --}}

            {{-- Tables section --}}
            <div class="card">
                <div class="card-header">
                    <h4>Table Produk</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Sub Categories</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td><a href="{{ $product->image }}" target="_blank">Lihat gambar</a>
                                            </td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>Rp {{ number_format($product->price) }}</td>
                                            <td><span
                                                    class="badge rounded-pill bg-primary text-light font-size-14 px-3 py-2">{{ $product->subCategory->name }}</span>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Tables section --}}

            {{-- Tables section --}}
            <div class="card">
                <div class="card-header">
                    <h4>Kategori</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Tables section --}}

            {{-- Tables section --}}
            <div class="card">
                <div class="card-header">
                    <h4>Sub Kategori</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $subcategory)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td><span
                                                    class="badge rounded-pill bg-primary text-light font-size-14 px-3 py-2">{{ $subcategory->category->name }}</span>
                                            </td>
                                            <td>
                                                {{ $subcategory->name }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Tables section --}}

            {{-- Tables section --}}

            {{-- End Tables section --}}

            {{-- Tables section --}}

            {{-- End Tables section --}}
        </section>
    </div>

@endsection
