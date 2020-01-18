@extends('layouts.app');

@section('menubuttons')
            <a href="/" class="btn navbar-button-back home"></a>
            <a href="/" class="btn navbar-button-back ">Selecteer beker</a>
            <button type="submit" class="btn">Upload ontwerp</button>
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-primary">
                <div class="panel-body">

                    @if ($message = Session::get('success'))

                    <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                    </div>

                    {{-- <img class="cuppyprint" src="images/uploads/{{ Session::get('image') }}">
                    <img class="cuppyplaceholder" src="images/system/cuppyblack.png"> --}}


                    @php $userimg = "images" . Session::get('image') @endphp
                        <div id="container"></div>


                        @section('konva')
                        <div class="button-box">
                            <div class="btnhome" id="save"> goedkeuren</div> <a href="../newcuppy" class="btnhome navbar-button-back"> Heruploaden </a>
                        </div>

                        <div class="cuppypreviewbox" id="cuppyprevieuwbox"></div>
                        <div id="buttons"></div>
                        <script src="https://unpkg.com/konva@4.1.2/konva.min.js"></script>

                        <script>
                            var width = 380;
                            var height = 700;

                            var stage = new Konva.Stage({
                                container: 'cuppyprevieuwbox',
                                width: width,
                                height: height
                            });

                            var layer = new Konva.Layer();
                            stage.add(layer);

                            // darth vader
                            var userimg = new Konva.Image({
                                width: 200,
                                height: 137
                            });

                            // yoda
                            var cupptplaceholder = new Konva.Image({
                                width: 300,
                                height: 600
                            });

                            var placeholder = new Konva.Group({
                                x: 40,
                                y: 20,
                                draggable: false
                            });
                            layer.add(placeholder);
                            placeholder.add(cupptplaceholder);

                            var userimgGroup = new Konva.Group({
                                x: 180,
                                y: 50,
                                draggable: true
                            });
                            layer.add(userimgGroup);
                            userimgGroup.add(userimg);
                            var MAX_WIDTH = 400;

                            var tr1 = new Konva.Transformer({
                            node: userimgGroup,
                            centeredScaling: true,
                            rotationSnaps: [0, 90, 180, 270],
                            resizeEnabled: true,
                            anchorStroke: '#ECE0D1',
                            anchorFill: '#71AC23',
                            anchorSize: 15,
                            borderStroke: '#ECE0D1',
                            borderDash: [3, 3],
                            strokeWidth: 1,
                            anchorCornerRadius:	4,
                            boundBoxFunc: function(oldBoundBox, newBoundBox) {
                                if (Math.abs(newBoundBox.width) > MAX_WIDTH) {
                                    return oldBoundBox;
                                }

                                return newBoundBox;
                                }
                            });
                            layer.add(tr1);

                            var userimgObj = new Image();
                            userimgObj.onload = function() {

                                userimg.image(userimgObj);
                                userimg.cache();
                                userimg.filters([Konva.Filters.Invert]);
                                layer.draw();

                            };



                            userimgObj.src = "../images/uploads/{{ Session::get('image') }}";
                            var placholderObj = new Image();
                            placholderObj.onload = function() {
                                cupptplaceholder.image(placholderObj);

                                layer.draw();
                            };
                            placholderObj.src = '../images/system/cuppyblack.png';

                            function downloadURI(uri, name) {
                            var link = document.createElement('a');
                            link.download = name;
                            link.href = uri;
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            delete link;
                            }


                            // create new transformer

                              document.getElementById('save').addEventListener(
                                'click',
                                    function() {
                                        var dataURL = stage.toDataURL({ pixelRatio: 3 });
                                            $.ajax({
                                                type: "POST",
                                                url: "uploudedit",
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                data: { imgBase64: dataURL }
                                            }).done(function(o) {
                                            console.log('saved');
                                            console.log('dingdong');
                                            });
                                            window.location.href = "../orders/graveren";

                                            },
                                            false



                                );


                        </script>

                        @endsection

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

                    @if (!$message = Session::get('success'))
                    <div class="alert alert-info">
                        <strong>Upload je ontwerp</strong> deze wordt omgezet in zwart wit. <br> Het witte gedeelde wordt van de beker afgehaald met een laser.
                    </div>

                    <form action="/newcuppy" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input onchange="this.form.submit()" type="file" name="image" class="form-control btn">
                            </div>
                        </div>
                    </form>

                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
