var Page = {

    init: function () {

        console.log("Page.init");

        this.bindEvents();

    }, 

    bindEvents: function () {

        console.log("Page.bindEvents");

        var self = this;

        $(".image").on("click", function(){

            console.log("click");
            self.getSimilarity( $(this).attr("id") );

        });

    }, 

    getSimilarity: function ( imgId ) {

        console.log("Page.getSimilarity", imgId);

        ajaxGetSimilarity( imgId );

    },

    getSimilaritySuccess: function ( data ) {

        console.log("Page.getSimilaritySuccess",data);

        // // SORT ARRAY BY SIMILARITY
        // var data_sorted = data.sort(function(a, b) {
        //     return parseFloat(a.similarity) - parseFloat(b.similarity);
        // });

        // // REORDER IMAGES
        // _.each( data_sorted, function( image ){
        //     // PUSH TO TOP
        //     var imgId = image.id;
        //     $("#" + imgId).parent("li").prependTo( $("#images_wrapper") );
        // });

    }

}

$(document).on( "ready", function(){

    Page.init();

});




