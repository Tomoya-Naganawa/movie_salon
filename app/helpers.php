<?php
if (! function_exists('star_rating')) {
    function star_rating($rating, $star_size) {
        for($i = 1; $i <= $rating; $i++){ 
            echo '<i class="fas fa-star ' .$star_size. '" style="color:#ffcc00;"></i>' ; 
            }
    }
}

function add_favorite_form($review_id)
{
    $form = Form::open(['url' => url('favorites/'), 'method' => 'POST', 'class' => 'mb-0']);
    $form .= Form::token();
    $form .= Form::hidden('review_id', $review_id);
    $form .= '<button type="submit" class="btn btn-link p-0 border-0 text-danger"><i class="far fa-heart fa-fw"></i></button>';
    $form .= Form::close();
 
    return $form;
}

function delete_favorite_form($url)
{
    $form = Form::open(['url' => $url, 'method' => 'DELETE', 'class' => 'mb-0']);
    $form .= Form::token();
    $form .= '<button type="submit" class="btn btn-link p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>';
    $form .= Form::close();
 
    return $form;
}