$("#all").on("click",function(){
    $(".category_1").fadeIn(500);    
    $(".category_2").fadeIn(500);    
    $(".category_3").fadeIn(500);    
});

$("#program").on("click",function(){
    $(".category_1").fadeIn(500);    
    $(".category_2").fadeOut(500);    
    $(".category_3").fadeOut(500);    
});

$("#work").on("click",function(){
    $(".category_1").fadeOut(500);    
    $(".category_2").fadeIn(500);    
    $(".category_3").fadeOut(500);    
});

$("#life").on("click",function(){
    $(".category_1").fadeOut(500);    
    $(".category_2").fadeOut(500);    
    $(".category_3").fadeIn(500);    
});