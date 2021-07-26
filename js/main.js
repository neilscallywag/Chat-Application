document.addEventListener(
  'DOMContentLoaded',
  function()
  {
   
	
	$("input").change(function(e) {

    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        
        var file = e.originalEvent.srcElement.files[i];
        
        var img = document.createElement("img");
        var reader = new FileReader();
        reader.onloadend = function() {
             img.src = reader.result;
        }
        reader.readAsDataURL(file);
        $(".input").before(img);
    }
});

    function refresh()
    {
      var div = $('#chatroom'),
        divHtml = div.html();
      div.html(divHtml);
      console.log("test");
    }
    setInterval(function()
    {
      refresh()
    }, 1000);
    setInterval(function()
    {
      loadinitial()
    }, 9000);
    setInterval(function()
    {
      loadnew()
    }, 3000);

    function loadinitial()
    {
      $.getJSON("getmessage.php",
        function(data)
        {
          $.each(data, function(key,
            val)
          {
            console.log(val);
          });
        });
    }

    function loadnew()
    {
      $.getJSON("getmessage.php",
        function(data)
        {
          console.log(data[Object
            .keys(data)
            .reverse()[0]]);
        });
    }
    $('#chatroom')
      .scrollTop($('#chatroom')[0]
        .scrollHeight - $(
        '#chatroom')[0].clientHeight);
    const a = document.getElementById(
      'chatroom');
    a.style.cursor = 'grab';
    let p = {
      top: 0,
      left: 0,
      x: 0,
      y: 0
    };
    const mouseDownHandler = function(
      e)
    {
      a.style.cursor = 'grabbing';
      a.style.userSelect = 'none';
      p = {
        left: a.scrollLeft,
        top: a.scrollTop,
        x: e.clientX,
        y: e.clientY,
      };
      document.addEventListener(
        'mousemove',
        mouseMoveHandler);
      document.addEventListener(
        'mouseup', mouseUpHandler);
    };
    const mouseMoveHandler = function(
      e)
    {
      const dx = e.clientX - p.x;
      const dy = e.clientY - p.y;
      a.scrollTop = p.top - dy;
      a.scrollLeft = p.left - dx;
    };
    const mouseUpHandler = function()
    {
      a.style.cursor = 'grab';
      a.style.removeProperty(
        'user-select');
      document.removeEventListener(
        'mousemove',
        mouseMoveHandler);
      document.removeEventListener(
        'mouseup', mouseUpHandler);
    };
    a.addEventListener('mousedown',
      mouseDownHandler);
  });
