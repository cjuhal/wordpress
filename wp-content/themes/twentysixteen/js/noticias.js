function ajaxSelect(url, select, contenido){
  var id = select.value;
  var posting = $.post (url, {id: id})
  posting.done(function( data ) {
    $('#' + contenido).html(data);
  });
}
