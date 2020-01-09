<!DOCTYPE html>

<html>

<head>
        <script src="https://unpkg.com/konva@4.0.18/konva.min.js"></script>
    <title>cuppy</title>

    <style>
        .cuppyplaceholder{
            height: 800px;
            position: absolute;
            z-index: 1
        }

        .cuppyprint{
            top: 300px;
            left: 40px;
            max-height: 700px;
            max-width: 230px;
            position: absolute;
            z-index: 2;
            filter: invert(100%);
        }

    </style>

</head>



<body>

<div class="container">

    @if($errors->any())
<div id="error-box">
    <!-- Display errors here -->
</div>
@endif

    <div class="panel panel-primary">

      <div class="panel-heading"><h2>Cuppy lazer cut converter</h2></div>

      <div class="panel-body">



        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

        </div>
        <img class="cuppyprint" src="images/{{ Session::get('image') }}">
        <img class="cuppyplaceholder" src="images/system/cupyplaceholder.png">

        <h1>Click Image then Drag</h1>


        @php $userimg = "images" . Session::get('image') @endphp

        <div id="container"></div>

        <script>
            var width = window.innerWidth;
            var height = window.innerHeight;

            function drawImage(imageObj) {
            var stage = new Konva.Stage({
                container: 'container',
                width: width,
                height: height
            });

            var layer = new Konva.Layer();
            // darth vader
            var darthVaderImg = new Konva.Image({
                image: imageObj,
                x: stage.width() / 2 - 200 / 2,
                y: stage.height() / 2 - 137 / 2,
                width: 200,
                height: 137,
                draggable: true
            });

            // add cursor styling
            darthVaderImg.on('mouseover', function() {
                document.body.style.cursor = 'pointer';
            });
            darthVaderImg.on('mouseout', function() {
                document.body.style.cursor = 'default';
            });

            layer.add(darthVaderImg);
            stage.add(layer);
            }
            var imageObj = new Image();
            imageObj.onload = function() {
            drawImage(this);
            };
            imageObj.src = 'images/{!! json_encode($userimg) !!}';
        </script>

        @endif



        @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



        <form action="/newcuppy" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">



                <div class="col-md-6">

                    <input type="file" name="image" class="form-control">

                </div>



                <div class="col-md-6">

                    <button type="submit" class="btn btn-success">Upload</button>

                </div>



            </div>

        </form>



      </div>

    </div>

</div>

</body>



</html>
