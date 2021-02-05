$(document).ready(function() {
    catPostList();
});

//old all posts
function catListPost() {
    var idCat = $('#cat_id').val();
    $.ajax({
        type: 'get',
        url: routeForoCatPosts + "/" + idCat,
        success: function(data) {
            $('#postList').empty().html(data);
        }
    });
}

//per page listing
function catPostList(page_id = 1) {
    var idCat = $('#cat_id').val();

    $.get(routeForoCatPosts + "/" + idCat + "/" + page_id, function (data, state) 
    {
        $("#postList").html(data);
        $('.pageList').on('click', '.page-link', function (event) {
            event.preventDefault();
            let btnPageText = $(this).html();
            let currentPage = $('#page_id').attr('value');

            if (btnPageText === '›')
                catPostList(Number(currentPage) + 1);
            else if (btnPageText === '‹')
                catPostList(currentPage - 1);
            else
                catPostList(btnPageText);
        });
        $('#page_id').attr('value', page_id);
    }).done(function (){
        document.getElementById('topPostList').scrollIntoView({behavior: 'smooth'});
        // $("#topPostList").animate({
        //     scrollTop: $("#topPostList").offset().top
        // }, 800, function(){
        //     window.location.hash = "#topPostList";
        // });
    });
}