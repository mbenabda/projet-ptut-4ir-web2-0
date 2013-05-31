            $(function() {$('.star').raty({
                    start: function() {
                        return $(this).attr('data-rating');
                    }
                });    
            });