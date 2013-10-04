var archive_videowork = {

  init: function (options) {
    this.options = options;
    
    // resize
    this.resize16x9(this.options.mainBody);
  },

  resize16x9 : function ( mainBody ) {
    var self = this;

    var width = mainBody.children('div').width();
    var height = width / 16 * 9 ;
    mainBody.children('div').css('height',height+'px');

    // show one by one 
    mainBody.children('div').hide();
    this.showOneByOne( mainBody );

  },
  showOneByOne : function( mainBody ){
    var self = this;

    mainBody.children('div').each( function(index){
      var delayTime = 200 * index;
      // console.log($(this));
      mainBody.children('div').eq(index).delay(delayTime).fadeIn();
    });

  }

};
