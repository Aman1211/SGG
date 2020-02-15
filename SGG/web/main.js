



$(document).ready(function(){
    /*STAR RATING*/
 
    $('.star').on("mouseover",function(){
        //get the id of star
        var star_id = $(this).attr('id');
        switch (star_id){

            case "star-1":
                $("#star-1").addClass('checked');
                break;
            case "star-2":
                $("#star-1").addClass('checked');
                $("#star-2").addClass('checked');
                break;
            case "star-3":
                $("#star-1").addClass('checked');
                $("#star-2").addClass('checked');
                $("#star-3").addClass('checked');
                break;
            case "star-4":
                $("#star-1").addClass('checked');
                $("#star-2").addClass('checked');
                $("#star-3").addClass('checked');
                $("#star-4").addClass('checked');
                break;
            case "star-5":
                $("#star-1").addClass('checked');
                $("#star-2").addClass('checked');
                $("#star-3").addClass('checked');
                $("#star-4").addClass('checked');
                $("#star-5").addClass('checked');
                break;
        }
    }).mouseout(function(){
        //remove the star checked class when mouseout
        $('.star').removeClass('checked');
    });
 
     
    $('.star').click(function(){
        //get the stars index from it id
        var star_index = $(this).attr("id").split("-")[1],
            product_id = $("#hello").val(), //store the product id in variable
            star_container = $(this).parent(), //get the parent container of the stars
            result_div = $("#result"); //result div
         
        $.ajax({
            url: "store_rating.php",
            type: "POST",
            data: {star:star_index,product_id:product_id},
            beforeSend: function(){
                star_container.hide(); //hide the star container
                result_div.show().html("Loading..."); //show the result div and display a loadin message
            },
            success: function(data){
                result_div.html(data);
                
            }
        });
    });
 
});