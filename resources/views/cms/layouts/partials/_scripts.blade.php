
<!-- jQuery 3 --> 
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{!! asset('cms/plugins/jquery-ui/jquery-ui.min.js') !!}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- v4.0.0-alpha.6 --> 
<script src="{!! asset('cms/bootstrap/js/bootstrap.min.js') !!}"></script> 

<!-- template --> 
<script src="{!! asset('cms/js/niche.js') !!}"></script> 


<script src="{!! asset('cms/plugins/hmenu/ace-responsive-menu.js') !!}" type="text/javascript"></script> 
<!--Plugin Initialization--> 
<script type="text/javascript">
         $(document).ready(function () {
             $("#respMenu").aceResponsiveMenu({
                 resizeWidth: '768', // Set the same in Media query       
                 animationSpeed: 'fast', //slow, medium, fast
                 accoridonExpAll: false //Expands all the accordion menu on click
             });
         });
</script>

<script src="{!! asset('cms/vendors/fancy-file-uploader/jquery.fileupload.js') !!}"></script>
<script src="{!! asset('cms/vendors/fancy-file-uploader/jquery.iframe-transport.js') !!}"></script>
<script src="{!! asset('cms/vendors/fancy-file-uploader/jquery.fancy-fileupload.js') !!}"></script>
<script src="{!! asset('cms/vendors/select2/select2.min.js') !!}"></script>

@yield('custom-scripts')

<script>
  function readURL(input, divId = "featured-img-tag") {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#' + divId).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#featured-image").change(function() {
    readURL(this);
  });
  $("#icon-light").change(function() {
    readURL(this, "icon-light-img");
  });
  $("#icon-dark").change(function() {
    readURL(this, "icon-dark-img");
  });
  $("#banner-image").change(function() {
    readURL(this);
  });

  $(document).ready(function(){
    $('#search_box').keyup(function(e){
    if(e.keyCode == 13)
    {
      var searchTxt = $("#search_box").val();
      var action = $("#search_box").attr("route");
      if(searchTxt !== "")
      {
        var form = document.createElement('form');
        form.setAttribute("method", "GET");
        form.setAttribute("action", action);

        var input = document.createElement("input");
          input.setAttribute("type", "hidden");
          input.setAttribute("name", "search_txt");
          input.setAttribute("value", searchTxt);
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
      }
    }
    });
    $("#search-btn").click(function(){
      var searchTxt = $("#search_box").val();
      var action = $("#search_box").attr("route");
      if(searchTxt !== "")
      {
        var form = document.createElement('form');
        form.setAttribute("method", "GET");
        form.setAttribute("action", action);

        var input = document.createElement("input");
          input.setAttribute("type", "hidden");
          input.setAttribute("name", "search_txt");
          input.setAttribute("value", searchTxt);
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
      }
    });
  });
</script>
</body>
</html>