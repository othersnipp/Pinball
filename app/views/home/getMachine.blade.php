@extends('layouts.main')

@section('stylesheets')
@parent
<style>
     body
       {
           background-color: #d24726;
       }
       
       div#carousel
       {
          border-radius: 5px; 
          height: 330px; 
          border: solid black 2px; 
          background-color: white; 
       }
       div#carousel img
       {
           height: 300px; 
           margin-top: 15px; 
           width: 100%;
       }
       span#img-Caption
       {
           position: relative; 
           top: 8px;
       }
       div#slideshow_control
       {
           height: 30px;
           margin-top: 10px;
           background-color: white; 
           border-radius: 10px;
       }
       div#slideshow_control div
       {
           width: 160px; margin: 0 auto;
       }
       div#slideshow_control div img
       {
           height: 30px; 
           width: 30px;
       }
       div#score_info
       {
           height: 330px;
           background-color: white;
           border-radius: 5px;
       }
       div#container_info_below
       {
           margin-top: 20px;
           background-color: white; 
           padding: 20px
       }
       div#score_div
       {
        padding: 20px;   
       }
       div#description_div
       {
           margin-bottom: 20px;
       }
</style>

@stop


@section('content')
<div class='row'>
<h1 class='col-md-4 col-md-offset-4'> 
    {{ $machine_name }}
    <br /> Stats & Pictures</h1>
</div>

<div class='row'>
    
    <div class='col-md-5 col-md-offset-1'>
        <div id="carousel" >
            
            @if(count($pics) > 0)
            <img src='{{ asset($pics[0]['image']) }}'  />                
            @endif
            
        </div>
        @if(count($pics) > 0)
        <h1 ><span id='img-Caption' >{{ $pics[0]['title'] }}</h1>
        @else
         <h1 ><span id='img-Caption' >No Pictures</h1>
        @endif
            @if(count($pics) > 0)
                <div id='slideshow_control' >
                  <div >
                   <img  id='prev_img' src='{{ asset("/web/images/boxed_arrow_green_left.png" ) }}' />
                   <img  id='stop_img' src='{{ asset("/web/images/stop_sign.png" ) }}' />
                   <img  id='play_img' src='{{ asset("/web/images/player_play_light.png" ) }}'/>
                   <img  id='next_img' src='{{ asset("/web/images/boxed_arrow_green_right.png" ) }}' />
                  </div>
               </div>
            @endif
    </div>
    
    <div class=' col-md-5' id='score_info' >
        <h1>High Score : {{ $mainstats->max_score }}</h1>
        <h1>Average Score : {{ number_format($mainstats->avg_score, 2,".","") }}</h1>
        <h1>Total Points : {{ $mainstats->total_score }}</h1>
        <h1>Number of Games : {{ $mainstats->num_games }} </h1>
        
    </div>
</div>

<div class='row'>
        
        <div class=' col-md-offset-1 col-md-10' id='container_info_below'>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#score_div" data-toggle="tab">Scores</a></li>
            <li><a href="#description_div" data-toggle="tab">Description</a></li>
        </ul>
            <div class="tab-content">
                
                    <div class="tab-pane active" id="score_div" >
                         
                        <table id='machine_score' class='table table-striped table-bordered table-responsive'  >
                             <thead>
                                 <tr>
                                     <th style='width: 34%;'>User Name</th>
                                     <th style='width: 33%;'>Score</th>
                                     <th style='width: 33%;'>Date</th>   
                                 </tr>
                             </thead>
                             <tbody>
                                   @foreach($score_table as $tr)
                                   <tr>
                                        <td>{{ link_to_route('publicProfile', $tr->username, array($tr->username)) }}</td>
                                        <td>{{ $tr->max_score }}</td>
                                        <td>{{ $tr->datecreated }}</td>
                                   </tr>
                                   @endforeach
                             </tbody>
                         </table>
                        
                    </div>

                    <div class="tab-pane" id="description_div" >
                        <p>  {{ $machine_description }} </p>
                    </div>
                
            </div>

        </div>
    </div>



@stop

@section('js')
@parent

{{ HTML::script("/web/js/jqueryui.js"); }}
{{ HTML::script("/web/js/small_slide.js"); }}
<script>
    
      var jsonimage = {{ json_encode($pics) }};

        
        $('#machine_score').dataTable({
            "sDom": "<'row'<'col-xs-6'T><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
            "sPaginationType": "bootstrap",
                    "oLanguage": {
                            "sLengthMenu": "_MENU_ records per page"
                        },

                });

</script>

@stop
