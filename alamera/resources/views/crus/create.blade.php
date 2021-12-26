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
    <title>add-cru</title>
</head>
<body>  
    <div style="margin-top: 5%" class="container">


        <div class="mapcontainer">
        <div class="map">
         





        </div>
        </div>
    
    
    
    </div>



    
@extends('crus.layout')

@section('content')

<div class="row">
    <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{ route('crus.index') }}"> Back</a>
    </div>
</div>


<form style="display: none" action="{{ route('crus.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            
                <input id="title" type="text" name="product_name" class="form-control" placeholder="Product Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            
                <textarea id="x-cru" class="form-control" style="height:150px" name="product_desc" placeholder="Product Description"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
    
                <input id="y-cru" type="text" class="form-control" name="product_qty" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection



<script>


    $(".mapcontainer").on('dblclick', function(e) {
    
    var $this = $(this),
        // mapPagePositionToXY() allows to get the x,y coordinates
        // on the map from a x,y coordinates on the page
        coords = $this.data('mapael').mapPagePositionToXY(e.pageX, e.pageY),
        // Each new plot must have its own unique ID
        plotId = 'cru'
        updateOptions = {
            'newPlots': {
            },
        };
    updateOptions.newPlots[plotId] = {
        x: coords.x,
        y: coords.y
    };
    $this.trigger('update', [updateOptions]);

    document.getElementById("title").value = plotId
    document.getElementById("x-cru").value = coords.y
    document.getElementById("y-cru").value = coords.x
    var submit =  document.getElementById("submit");
    submit.click();




    });
 setTimeout(function() {
        // Get the data
        $.getJSON("http://127.0.0.1:8000/public/api/cru", function(data) {
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
                        fill: "#6f00ff"
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
                            eventHandlers: {
                                click: function(e, id, mapElem, textElem) {
                                    var newData = {
                                        'areas': {}
                                    };
                                    if (mapElem.originalAttrs.fill == "#5ba4ff") {
                                        newData.areas[id] = {
                                            attrs: {
                                                fill: "#eee"
                                            }
                                        };
                                    } else {
                                        newData.areas[id] = {
                                            attrs: {
                                                fill: "#5ba4ff"
                                            }
                                        };
                                    }
                                    $(".mapcontainer").trigger('update', [{
                                        mapOptions: newData
                                    }]);
                                }
                            }
                        }
                    
                    },
                    areas: {
                        "department-29": {
                        
                            eventHandlers: {
                                click: function() {},
                                dblclick: function(e, id, mapElem, textElem) {
                                    var newData = {
                                        'areas': {}
                                    };
                                    if (mapElem.originalAttrs.fill == "#5ba4ff") {
                                        newData.areas[id] = {
                                            attrs: {
                                                fill: "#0088db"
                                            }
                                        };
                                    } else {
                                        newData.areas[id] = {
                                            attrs: {
                                                fill: "#5ba4ff"
                                            }
                                        };
                                    }
                                    $(".mapcontainer").trigger('update', [{
                                        mapOptions: newData
                                    }]);
                                }
                            }
                        }
                    },
                    plots: plots
                   });
               
                                })
                            
                            }, 200);
                        




   


</script>





</body>
</html>