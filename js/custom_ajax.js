function ajaxGetSimilarity ( imgId ) {
    console.log( "ajaxGetSimilarity" );
    
    // AJAX CALL
    $.ajax({
        url : myAjax.ajaxurl,
        data : {
            "action"    : "similarity",
            "id"        : imgId
        },
        type:"POST",
        dataType :'json', 
        success:function(data) {

            // console.log( 20, data);
            Page.getSimilaritySuccess(data);

        },
        error: function(errorThrown){
            console.log( "Error", errorThrown );
        }
    }); 


}
