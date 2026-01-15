@extends('frontend.layout.master')

@section('content')
    <div class="container my-7 container-fluid category-page">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="category-title">All Business Categories</h2>
            <a href="{{ url()->previous() }}" class="back-link">← Back</a>
        </div>

        <!-- Category Grid -->
        <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-5">
            @foreach ($subCategories as $category)
                <div class="col">
                    <a href="{{ route('search.index', ['businessType' => $category->SubCatID]) }}" class="category-card"
                        target="_blank">
                        {{ $category->SubCategory }}
                    </a>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div id="pagination" class="d-flex justify-content-end">
            {{ $subCategories->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>

    </div>
    <style>
        /* Page background */
        .category-page {
            padding: 40px 0px 60px;
            min-height: 100vh;
        }

        /* Title */
        .category-title {
            font-size: 26px;
            font-weight: 700;
            color: #000;
        }

        /* Back link */
        .back-link {
            font-size: 14px;
            color: #333;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Category card */
        .category-card {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 55px;
            padding: 10px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e4e4e4;
            color: #7f2149;
            font-weight: 500;
            font-size: 14px;
            text-align: center;
            transition: all 0.25s ease;
        }

        /* Hover effect */
        .category-card:hover {
            background: #7f2149;
            color: #fff;
            border-color: #7f2149;
            text-decoration: none;
            transform: translateY(-2px);
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .category-title {
                font-size: 22px;
            }

            .category-card {
                height: auto;
                padding: 12px 8px;
            }
        }
    </style>
@endsection
