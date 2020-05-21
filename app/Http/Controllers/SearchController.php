<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Libraries\TmdbService;

class SearchController extends Controller
{

    public function search(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'category' => 'in:"movie","person"',
            'query'     => 'required',
        ]);
        $validator->validate();

        $TmdbService = new TmdbService;
        $search_array = $TmdbService->getSearchArray($request);

        return view('tmdbs.search', [
            'search_array' => $search_array,
            'query' => $request['query'],
            'category' => $request['category'],
            'page' => $request['page'],
            ]);
    }
    
    public function show($tmdb_movie_id)
    {
        $TmdbService = new TmdbService;
        $movie_array = $TmdbService->getMovieArray($tmdb_movie_id);
        $credits_array = $TmdbService->getCreditArray($tmdb_movie_id);

        return view('tmdbs.show', [
            'movie_array' => $movie_array,
            'credits_array' => $credits_array
        ]);
    }
}
