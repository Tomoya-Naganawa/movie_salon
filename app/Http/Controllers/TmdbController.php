<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Libraries\Tmdb;

class TmdbController extends Controller
{

    public function search(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'category' => 'in:"movie","person"',
            'query'     => 'required',
        ]);
        $validator->validate();

        $search_array = Tmdb::getSearchArray($request);

        return view('tmdbs.search', [
            'search_array' => $search_array,
            'query' => $request['query'],
            'category' => $request['category'],
            'page' => $request['page'],
            ]);
    }
    
    public function show($tmdb_movie_id)
    {
        $movie_array = Tmdb::getMovieArray($tmdb_movie_id);
        
        $credits_array = Tmdb::getCreditArray($tmdb_movie_id);

        return view('tmdbs.show', [
            'movie_array' => $movie_array,
            'credits_array' => $credits_array
        ]);
    }
}
