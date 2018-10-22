<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <div id="partial" style="direction: rtl;">
        <div class="container mt-2" >
        <div class="row" style="direction: rtl;">
                <div class="col-12"  style="direction: ltr;">
                    <div class="row align-items-center" style="direction: rtl;">

                      
                        <!-- title -->
                        <div class="col-10" style="text-align: right;">
                            <a href="/">
                                <img class="logo" src="{{ asset('images/profile.png') }}" />
                            </a>
                        </div>
                        <div class="col-2" >
                            <form action="/logout" method="post">
                            {{csrf_field()}}                                            
					    @csrf
                                <button type="submit" class="btn btn-warning btn-sm">התנתק</button>
                            </form>
                        </div>
                    </div>
                    </div>


            <div class="row" style="direction: rtl;">
                <div class="col-12"  style="direction: rtl;">
                    <div class="row align-items-center" style="direction: rtl;">

                       
                        
                       
                        <!-- Form -->
                        <div class="col-12">
                            <form method="get" action="/">
                                <div class="row">
                                <div class="col-2 mt-1">
                                        <select name="kalpi" class="ml-4 form-control" id="exampleFormControlSelect2">
                                            <option value="all" {{($kalpi == 'all') ? 'selected' : '' }}>קלפי</option>
                                            <option value="10" {{($kalpi == '10') ? 'selected' : '' }}>10</option>

                                            <option value="21" {{($kalpi == '21') ? 'selected' : '' }}>21</option>

                                            <option value="22" {{($kalpi == '22') ? 'selected' : '' }}>22</option>

                                            <option value="30" {{($kalpi == '30') ? 'selected' : '' }}>30</option>

                                            <option value="41" {{($kalpi == '41') ? 'selected' : '' }}>41</option>
                                            
                                            <option value="42" {{($kalpi == '42') ? 'selected' : '' }}>42</option>

                                            <option value="50" {{($kalpi == '50') ? 'selected' : '' }}>50</option>

                                            <option value="60" {{($kalpi == '60') ? 'selected' : '' }}>60</option>

                                            <option value="70" {{($kalpi == '70') ? 'selected' : '' }}>70</option>
                                            <option value="80" {{($kalpi == '80') ? 'selected' : '' }}>80</option>

                                        </select>
                                    </div>
                                    <div class="col-2 mt-1">
                                        <select name="search_by" class="ml-4 form-control" id="exampleFormControlSelect2">
                                            <option value="all" {{($search_by == 'all') ? 'selected' : '' }}>חפש לפי</option>

                                            <option value="seq_number" {{($search_by == 'seq_number') ? 'selected' : '' }}>מס סידורי</option>


                                            <option value="id_number" {{($search_by == 'id_number') ? 'selected' : '' }}>ת.ז</option>

                                            <option value="home_number" {{($search_by == 'home_number') ? 'selected' : '' }}>מס בית</option>
                                            
                                            <option value="street" {{($search_by == 'street') ? 'selected' : '' }}>רחוב</option>

                                            <option value="full_name" {{($search_by == 'full_name') ? 'selected' : '' }}>שם מלא</option>

                                            <option value="first_name" {{($search_by == 'first_name') ? 'selected' : '' }}>שם פרטי</option>

                                            <option value="father_name" {{($search_by == 'father_name') ? 'selected' : '' }}>שם האב</option>

                                            <option value="last_name" {{($search_by == 'last_name') ? 'selected' : '' }}>שם משפחה</option>
					    <option value="active_person" {{($search_by == 'active_person') ? 'selected' : ''}}>פעיל בשטח </option>
                                        </select>
                                    </div>
                                  

                                    <div class="col-4 d-flex align-items-center">
                                        <label class="ml-2 mt-3">חיפוש</label>
                                        <input type="text" name="search" class="form-control" value="{{ $search }}" />
                                    </div>

                                    <div class="col-3 mt-1">
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
                            <th style="text-align: center;" scope="col">#</th>
                            <th style="text-align: center;" scope="col">מס' סידורי</th>
                            <th style="text-align: center;" scope="col">קלפי</th>
                            <th style="text-align: center;" scope="col">ת.ז</th>
                            <th style="text-align: center;" scope="col">מס' בית</th>
                            <th style="text-align: center;" scope="col">רחוב</th>
                            <th style="text-align: center;" scope="col">שם פרטי</th>
                            <th style="text-align: center;" scope="col">שם האב</th>
                            <th style="text-align: center;" scope="col">שם משפחה</th>
                            <th style="text-align: center;" scope="col">שייך למשפחה</th>
                            <th style="text-align: center;" scope="col">פעיל מס </th>
                            <th style="text-align: center;" scope="col">מצב</th>
                            <th style="text-align: center;" scope="col">
                            <form method="post" action="/api/export?filter={{$filter}}&search_by={{$search_by}}&search={{$search}}&kalpi={{$kalpi}}">
                                <button taget="_blank" class="btn btn-success"><i class="far fa-file-excel"></i></button>
                            </form>
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elections as $election)
                                <tr class="{{ $election->voting == true ? 'voting' : ''  }} tr-{{$election->id}}">
                                    <th scope="row">{{ $election->id }}</th>
                                    <td style="text-align: center;">{{ $election->seq_number }}</td>
                                    <td style="text-align: center;">{{ $election->kalpi }}</td>
                                    <td style="text-align: center;">{{ $election->id_number }}</td>
                                    <td style="text-align: center;">{{ $election->home_number }}</td>
                                    <td style="text-align: center;">{{ $election->street }}</td>
                                    <td style="text-align: center;">{{ $election->first_name }}</td>
                                    <td style="text-align: center;">{{ $election->father_name }}</td>
                                    <td style="text-align: center;">{{ $election->last_name }}</td>
                                    <td style="text-align: center;">{{  $election->belonges_to }}</td>
				                    <td style="text-align: center;"> {{ $election->active_person}} </td>
				              <td>
                                        @if ($election->voting == true)
                                        <span class="status-{{$election->id}}"><i class="fas fa-check text-success"></i></span>
                                        @else
                                        <span class="status-{{$election->id}}">---</span>
                                        @endif
                                    </td>
                                    
				             <td>
                                      
                        {{csrf_field()}}                                            
					    @csrf
                                            @if ($election->voting == true)
                                            <button data-id="{{$election->id}}" data-voting="true" class="btn btn-danger btn-vote btn-sm">בטל הצבעה</button>
                                            @else
                                            <button  data-id="{{$election->id}}" data-voting="false" class="btn btn-success btn-vote btn-sm">הצביע</button>
                                            @endif
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
                                'kalpi' => $kalpi
                            ])->links() 
                        }}
                    </div>
                </div>
            </div>
	        </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>

        $(document).ready(function(){
            $(".btn-vote").click(function(e){
                e.preventDefault();
                var id = $.parseJSON($(this).attr('data-id'));
                var voting = $.parseJSON($(this).attr('data-voting'));
                console.log(id, voting);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    context: this,
                    url: "/update/" + id,
                    method: 'post', 
                    success: function(result) {
                        if(voting) {
                            $(this).addClass('btn-success')
                            $(this).removeClass('btn-danger')
                            $(this).text('הצביע')
                            $(this).attr("data-voting",false)
                            $('.tr-'+id).removeClass('voting')
                            $('.status-'+id).html('---')
                        } else {
                            $(this).addClass('btn-danger')
                            $(this).removeClass('btn-success')
                            $(this).text('בטל הצבעה')
                            $(this).attr("data-voting",true)
                            $('.tr-'+id).addClass('voting')
                            $('.status-'+id).html('<i class="fas fa-check text-success"></i>')
                        }
                        
                    }
                });

            });
            
        });

	</script>
    </body>

</html>
