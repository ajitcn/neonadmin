 //autocomplete or suggestion
 
  $("#search_product").keyup(function(){
    var search_product=$(this).val();
    //alert(search_product);
      $.post("ajax/search_product_suggestion.php", {
            search_product: search_product 
           }, function (data, status) {
            
            $('#js_hold').empty();
            $('#js_hold').append('<script> $( "#search_product" ).autocomplete({ source: '+data+'});</script>');
           }); 
  });
