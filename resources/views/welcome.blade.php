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
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="row">

                        <!-- title -->
                        <div class="col-4">
                            <h1>Elections</h1> 
                        </div>
                        
                        <!-- Form -->
                        <div class="col-8">
                            <form method="get" action="/">
                                <div class="row">
                                    <div class="col-5 d-flex align-items-center">
                                        <label class="mr-2">Search</label>
                                        <input type="text" name="search" class="form-control" value="{{ $search }}" />
                                    </div>
                                    <div class="col-5">
                                        <select name="filter" class="ml-4 form-control" id="exampleFormControlSelect1">
                                            <option value="all" {{ ($filter == 'all') ? 'selected' : '' }}>All</option>
                                            <option value="voted" {{ ($filter == 'voted') ? 'selected' : '' }}>Voted</option>
                                            <option value="not_voted" {{ ($filter == 'not_voted') ? 'selected' : '' }}>Not voted</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Seq Number</th>
                            <th scope="col">Kalpi</th>
                            <th scope="col">ID</th>
                            <th scope="col">Home Number</th>
                            <th scope="col">Street</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Father Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Voting</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elections as $election)
                                <tr>
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
                                        @if ($election->voting)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <span>---</span>    
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{  $elections->appends([
                                'search' => $search, 'filter' => $filter 
                            ])->links() 
                        }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
