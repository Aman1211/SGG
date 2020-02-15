 var abc=$('.abc').attr('value');
    alert('abc');
$(document).ready(function(){
    /*STAR RATING*/
    var abc=$('.abc').attr('value');
    alert('abc');
    $('.abc').on("load",function(){
        //get the id of star
        var star_id = $(this).attr('value');
        alert('star_id'.'ADsadsa');
        switch(star_id){

            case "4":
                    alert("Aman");
                $("#star-1").addClass('checked');
                break;
            case "2":
                $("#star-1").addClass('checked');
                $("#star-2").addClass('checked');
                break;
            case "3":
                $("#star-1").addClass('checked');
                $("#star-2").addClass('checked');
                $("#star-3").addClass('checked');
                break;
            case "1":
                $("#star-1").addClass('checked');
                $("#star-2").addClass('checked');
                $("#star-3").addClass('checked');
                $("#star-4").addClass('checked');
                break;
            case "5":
                $("#star-1").addClass('checked');
                $("#star-2").addClass('checked');
                $("#star-3").addClass('checked');
                $("#star-4").addClass('checked');
                $("#star-5").addClass('checked');
                break;
        }
    });
});