$('.bgc-ike').click(function () {
    $('#canvas').css( "background-image" , "url(./imgs/member-center/bgc-ike.png)" );
    });
    $('.bgc-Luca').click(function () {
    $('#canvas').css( "background-image" , "url(./imgs/member-center/bgc-Luca.png)" );
    });
    $('.bgc-mysta').click(function () {
    $('#canvas').css( "background-image" , "url(./imgs/member-center/bgc-mysta.png)" );
    });
    $('.bgc-shu').click(function () {
    $('#canvas').css( "background-image" , "url(./imgs/member-center/bgc-shu.png)" );
    });
    $('.bgc-vox').click(function () {
    $('#canvas').css( "background-image" , "url(./imgs/member-center/bgc-vox.png)" );
    });



//畫布設定---------------------------------
    var canvas = new fabric.Canvas('canvas');
    //  --------文字設定--------------------
     const text = new fabric.Text('hello', {
    left: 0,
    top: 0,
    scaleX: 0.5,
    scaleY: 0.5, 
    });
    canvas.add(text);
// -------------------免費圖片設定-----------------
    fabric.Image.fromURL('./imgs/member-center/free-item1.png', function(img) {
    img.scale(1).set({
    left: 0,
    top: 0,
    angle: 0,
    lockRotation: false,
    type:'st1'//可用來替物件命名
  });
  $('.f-img1').click(function () {
    canvas.add(img);
        })
    });

    fabric.Image.fromURL('./imgs/member-center/free-item2.png', function(img) {
    img.scale(1).set({
    left: 0,
    top: 0,
    angle: 0,
    lockRotation: false,
    type:'st2'//可用來替物件命名
  });
  $('.f-img2').click(function () {
    canvas.add(img);
        })
    });

    fabric.Image.fromURL('./imgs/member-center/free-item3.png', function(img) {
    img.scale(1).set({
    left: 0,
    top: 0,
    angle: 0,
    lockRotation: false,
    type:'st3'//可用來替物件命名
  });
  $('.f-img3').click(function () {
    canvas.add(img);
        })
    });

    fabric.Image.fromURL('./imgs/member-center/free-item4.png', function(img) {
    img.scale(1).set({
    left: 0,
    top: 0,
    angle: 0,
    lockRotation: false,
    type:'st4'//可用來替物件命名
  });
  $('.f-img4').click(function () {
    canvas.add(img);
        })
    });
// -------------------免費圖片-----------------