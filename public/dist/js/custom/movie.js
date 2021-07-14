$(document).ready(function () {


    let favCount = $('#nav__fav-count').data('fav-count');

    $(document).on('click','.movie__fav-icon',function () {


        let url = $(this).data('url');
        let movieId = $(this).data('movie-id');
        let isFavored = $(this).hasClass('fw-900');
        
        !isFavored ? favCount++ : favCount-- ;
        favCount > 9 ? $('#nav__fav-count').html('9+') : $('#nav__fav-count').html(favCount);

        $('.movie-'+ movieId).toggleClass('fw-900');

        $.ajax({
                    url: url,
                    method: 'POST',
                    success: function () {

                        },

                });//end of ajax call



    });// end of on click fav icon

}); // end of document