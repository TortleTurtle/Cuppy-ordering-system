@extends('layouts.app');

@section('menubuttons')
            <a href="/" class="btn navbar-button-back home"></a>
            <a href="/" class="btn navbar-button-back ">Selecteer beker</a>
            <button type="submit" class="btn">test</button>
@endsection

@section('content')
<div class="cuppyprevieuwbox"></div>
@endsection

@section('konva')
<div id="cuppyprevieuwbox"></div>
<div id="buttons"><button id="save">Save as image</button></div>
<script src="https://unpkg.com/konva@4.1.2/konva.min.js"></script>

<script>
        var width = 400;
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
          x: 20,
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
      });
      layer.add(tr1);

        var userimgObj = new Image();
        userimgObj.onload = function() {
          userimg.image(userimgObj);
          layer.draw();
        };
        userimgObj.src = "../images/1578855622.jpg";

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

      document.getElementById('save').addEventListener(
        'click',
        function() {
          var dataURL = stage.toDataURL({ pixelRatio: 3 });

                        $.ajax({
                type: "POST",
                url: "uploudedit",
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            data: {
                imgBase64: dataURL
            }
            }).done(function(o) {
            console.log('saved');
            });
            downloadURI(dataURL, 'stage.png');
        },
        false
      );
      </script>
@endsection
