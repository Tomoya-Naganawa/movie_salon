<?php
$pre_page = $search_array['page'] - 1;
$current_page = $search_array['page'];
$next_page = $search_array['page'] + 1;
$total_pages = $search_array['total_pages'];
?>

<div class="col-md-12 d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination d-flex justify-content-center">
            @if(($pre_page) != 0)
            <li class="page-item">
                <a class="page-link" href="{{ url('search?query='.$query.'&category='.$category.'&page='.$pre_page) }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @endif
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">{{ $current_page }}</a>
            </li>
            @if(($current_page) < $total_pages)
            <li class="page-item">
                <a class="page-link" href="{{ url('search?query='.$query.'&category='.$category.'&page='.$next_page) }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            @endif
        </ul>
    </nav>    
</div>    