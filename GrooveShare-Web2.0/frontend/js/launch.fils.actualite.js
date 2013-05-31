function tick(){
$('#ticker li:first').animate({'opacity':0}, 200, function () { $(this).appendTo($('#ticker')).css('opacity', 3); });
}
setInterval(function(){ tick () }, 4000);
