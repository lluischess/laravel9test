url = 'http://laravel9.com';
$(document).ready(function(){

        $('.btn-like').css('cursor','pointer');
        $('.btn-dislike').css('cursor','pointer');

        // Button dislike
        function dislike(){
            $('.btn-like').unbind('click').click(function(){
                $(this).addClass('btn-dislike').removeClass('btn-like');
                $(this).attr('src',url+'/images/me-gustaNegro.png');
                
                // Petición a Backend
                $.ajax({
                    url: url+'/dislike/'+$(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                    }
                });
                
                like();
            });
        }
        dislike();

        // Button like
        function like(){
            $('.btn-dislike').unbind('click').click(function(){
                $(this).addClass('btn-like').removeClass('btn-dislike');
                $(this).attr('src',url+'/images/me-gustaRojo.png');

                // Petición a Backend
                $.ajax({
                    url: url+'/like/'+$(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                    }
                });

                dislike();
            });
        }
        like();

        // Buscador

        $('#buscador').submit(function(){
            $(this).attr('action',url+'/users/'+$('#buscador #search').val());
        });

   });