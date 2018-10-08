<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <title>Elections</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <style>
            .voting {
                background: yellow;
            }

            .logo {
                width: 150px;
            }
        </style>
    </head>
    <body >
    <div style="direction: rtl;">
        <div class="container mt-5" style="direction: rtl;">
            <div class="row" style="direction: rtl;">
                <div class="col-12"  style="direction: rtl;">
                    <div class="row align-items-center" style="direction: rtl;">

                        <!-- title -->
                        <div class="col-3" style="text-align: right;">
                            <a href="/">
                                <img class="logo" src="{{ asset('images/profile.png') }}" />
                            </a>
                        </div>
                        
                        <!-- Form -->
                        <div class="col-9">
                            <form method="get" action="/">
                                <div class="row">

                                    <div class="col-3 mt-1">
                                        <select name="search_by" class="ml-4 form-control" id="exampleFormControlSelect2">
                                            <option value="all" {{($search_by == 'all') ? 'selected' : '' }}>הכל</option>

                                            <option value="seq_number" {{($search_by == 'seq_number') ? 'selected' : '' }}>מס סידורי</option>

                                            <option value="kalpi" {{($search_by == 'kalpi') ? 'selected' : '' }}>קלפי</option>

                                            <option value="id_number" {{($search_by == 'id_number') ? 'selected' : '' }}>ת.ז</option>

                                            <option value="home_number" {{($search_by == 'home_number') ? 'selected' : '' }}>מס בית</option>
                                            
                                            <option value="street" {{($search_by == 'street') ? 'selected' : '' }}>רחוב</option>

                                            <option value="full_name" {{($search_by == 'full_name') ? 'selected' : '' }}>שם מלא</option>

                                            <option value="first_name" {{($search_by == 'first_name') ? 'selected' : '' }}>שם פרטי</option>

                                            <option value="father_name" {{($search_by == 'father_name') ? 'selected' : '' }}>שם האב</option>

                                            <option value="last_name" {{($search_by == 'last_name') ? 'selected' : '' }}>שם משפחה</option>
                                        </select>
                                    </div>

                                    <div class="col-4 d-flex align-items-center">
                                        <label class="ml-2 mt-3">חיפוש</label>
                                        <input type="text" name="search" class="form-control" value="{{ $search }}" />
                                    </div>

                                    <div class="col-4 mt-1">
                                        <select name="filter" class="ml-4 form-control" id="exampleFormControlSelect1">
                                            <option value="all" {{ ($filter == 'all') ? 'selected' : '' }}>הכל</option>
                                            <option value="voted" {{ ($filter == 'voted') ? 'selected' : '' }}>הצביע</option>
                                            <option value="not_voted" {{ ($filter == 'not_voted') ? 'selected' : '' }}>לא הצביע</option>
                                        </select>
                                    </div>

                                    <div class="col-1">
                                        <button class="btn btn-primary">בצע</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12" style="direction: rtl;">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">מס' סידורי</th>
                            <th scope="col">קלפי</th>
                            <th scope="col">ת.ז</th>
                            <th scope="col">מס' בית</th>
                            <th scope="col">רחוב</th>
                            <th scope="col">שם פרטי</th>
                            <th scope="col">שם האב</th>
                            <th scope="col">שם משפחה</th>
                            <th scope="col">מצב</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elections as $election)
                                <tr class="{{ $election->voting == true ? 'voting' : ''  }}">
                                    <th scope="row">{{ $election->id }}</th>
                                    <td>{{ $election->seq_number }}</td>
                                    <td>{{ $election->kalpi }}</td>
                                    <td>{{ $election->id_number }}</td>
                                    <td>{{ $election->home_number }}</td>
                                    <td>{{ $election->street }}</td>
                                    <td>{{ $election->first_name }}</td>
                                    <td>{{ $election->father_name }}</td>
                                    <td>{{ $election->last_name }}</td>
                                    <td>
                                        @if ($election->voting == true)
                                        <i class="fas fa-check text-success"></i>
                                        @else
                                        <span>---</span> 
                                        @endif
                                    </td>
                                    <td>
                                        <form method="post" action="/update/{{$election->id}}">
                                            @csrf

                                            @if ($election->voting == true)
                                            <button class="btn btn-danger btn-sm">בטל הצבעה</button>
                                            @else
                                            <button class="btn btn-success btn-sm">הצביע</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{  $elections->appends([
                                'search' => $search, 
                                'filter' => $filter,
                                'search_by' => $search_by,
                            ])->links() 
                        }}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
