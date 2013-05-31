 $(document).ready(function() {
                $(".vote a").click(function() {
                    $(this).parent().animate({
                        width: '+=5px'
                    }, 10);
                    $(this).prev().html(parseInt($(this).prev().html()) + 1);
                    return false;
                });
            });
            
function hidelink(x){
        document.getElementById(1).innerHTML="<span>0</span>";
        document.getElementById(2).innerHTML="<span>0</span>";
        document.getElementById(3).innerHTML="<span>0</span>";
        document.getElementById(x).innerHTML="<span>+1 thx for voting</span>";
}