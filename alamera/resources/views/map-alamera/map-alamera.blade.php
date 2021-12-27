<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ URL::asset('https://use.fontawesome.com/releases/v5.7.2/css/all.css') }}" rel='stylesheet'>
    <link href="{{ URL::asset('https://fonts.googleapis.com/css?family=Candal|Lora') }}" rel='stylesheet'>
    <link href="{{ URL::asset('map/css/style.css') }}" rel='stylesheet'>
    <script type="text/javascript" src="{{ URL::asset('map/js/jqury.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/chroma-js/1.1.1/chroma.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('map/js/raphael.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('map/js/jquery.mapael.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('map/js/jquery.knob.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('map/js/world_countries.js') }}"></script>
    <style>
        .mapael .zoomButton{
            display:block !important;
        }
        .card-body{
            display: none;
        }
        .card{
            display: none !important;
        }
    </style>
    <title>MAP-ALAMERA</title>
</head>
<body>
    <div style="margin-top: 5%" class="container">


        <div class="mapcontainer">
        <div class="map">


        </div>
        </div>
    
    
    
    </div>
    
    @extends('depots.layout')
    <button style="display: none" id="addcru"></button>
    <button style="display: none" id="addlaboratory"></button>


{{-- get depots --}}
<script>


         setTimeout(function() {
                // Get the data
                $.getJSON("{{ route('depot') }}", function(data) {
                    // Success
                    // This variable will hold all the plots of our map
                    var plots = {};
                    var plotsColors = chroma.scale("Blues");
                    // Parse each elements
                    $.each(data, function(id, elem) {
                        // Check if we have the GPS position of the element
                        if (elem.product_qty) {
                            // Will hold the plot information
                            var plot = {};
                            // Assign position
                            plot.x = elem.product_qty;
                            plot.y = elem.product_desc;
                            // Assign some information inside the tooltip
                            plot.tooltip = {

                            };
                            // Assign the background color randomize from a scale
                            plot.attrs = {
                                fill: "red"
                            };
                            // Set plot element to array
                            plots[id] = plot;
                        } 
                    });
                    // Create map
                   
                        $(".mapcontainer").mapael({
                            map: {
                                name: "world_countries",
                                zoom: {
                                    enabled: true
                                
                                  ,step: 0.25,
                                   maxLevel: 20,
                                },
                                
                                defaultPlot: {
                                                        text: {
                                                            attrs: {
                                                                fill: "#b4b4b4",
                                                                "font-weight": "normal"
                                                            },
                                                            attrsHover: {
                                                                fill: "#fff",
                                                                "font-weight": "bold"
                                                            }
                                                        }
                                                    },
                                defaultArea: {
                                    attrs: {
                                        fill: "#EEE",
                                        stroke: "#232323",
                                        "stroke-width": 0.3
                                    },
                                    attrsHover: {
                                        animDuration: 0
                                    },
                                    text: {
                                        attrs: {
                                            cursor: "pointer",
                                            "font-size": 10,
                                            fill: "#000"
                                        },
                                        attrsHover: {
                                            animDuration: 0
                                        }
                                    },
                               
                                }
                            
                            },
                       
                            plots: plots
                           });
                       
                                        })
                                    
                                    }, 200);
                                



        
           

     
</script>
{{-- get laboratorys --}}
<script>
    const url = "{{ route('laboratory') }}"
      fetch(url).then(response => { return response.json() }).then(laboratory => {
       var x = "";
      var y = "";

       laboratory.map(function(ac){
         
     x = ac.product_qty;
       y = ac.product_desc;
      
  
          $("#addlaboratory").click(function (x , y) {
   

      var existingContent = $('#svgmap').html();
      var toInsert = '<circle cx=' + ac.product_qty + ' cy=' + ac.product_desc + ' r="2.5" x=' + x +' y=' + y +' stroke-width="4" fill="green" />'
     
          $('#svgmap').html(existingContent + toInsert);
        
      });
     
          
       })


    });
    setTimeout(() => {
        document.getElementById("addlaboratory").click();
}, 2500);
</script>  

{{-- get crus --}}
<script>
    const urllaboratory = "{{ route('cru') }}"
      fetch(urllaboratory).then(response => { return response.json() }).then(data2 => {
       var x = "";
      var y = "";

       data2.map(function(ac){
    
         
     x = ac.product_qty;
       y = ac.product_desc;
      
  
          $("#addcru").click(function (x , y) {
   

      var existingContent = $('#svgmap').html();
      var toInsert = '<<rect x=' + ac.product_qty + ' y=' + ac.product_desc +'  fill="#7f00ff"  width="5" height="5"/>'
 
          $('#svgmap').html(existingContent + toInsert);
        
      });
     
          
       })


    });
    setTimeout(() => {
        document.getElementById("addcru").click();
}, 2500);

</script>  





</body>
</html>