<div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
    <div class="next-back-page d-flex justify-content-between">
    @if ($previous)
            <a href="{{ route('edit.listing.step1', $previous->ListingID) }}"><button><i class="fa fa-chevron-left"></i>Back</button></a>
        @endif

        @if ($next)
            <a href="{{ route('edit.listing.step1', $next->ListingID) }}"><button>Next <i class="fa fa-chevron-right"></i></button></a>
        @endif
    </div>
</div>