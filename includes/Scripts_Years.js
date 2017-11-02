  $(document).ready(function(){
   
   //***************************************************Oculta 2012 y 2013******************************************
$("#year_2012").hide();
$("#year_2013").hide();
$("#year_2014").hide();
$("#year_2015").hide();
$("#year_2016").hide();
$('#btn_2012').css('cursor','pointer');
$('#btn_2013').css('cursor','pointer');
$('#btn_2014').css('cursor','pointer');
$('#btn_2015').css('cursor','pointer');
$('#btn_2016').css('cursor','pointer');
	
$("#btn_2012").click(function() {
    var $this = $(this);
    if ($this.hasClass("clicked-once")) {
        // already been clicked once, hide it
        //$this.hide();
        $("#year_2012").hide();
        $this.removeClass("clicked-once")
    }
    else {
        // first time this is clicked, mark it
        $this.addClass("clicked-once");        
        $("#year_2012").show();
    }
});

$("#btn_2013").click(function(event){
	var $this = $(this);
    if ($this.hasClass("clicked-once")) {
        // already been clicked once, hide it
        //$this.hide();
        $("#year_2013").hide();
        $this.removeClass("clicked-once")
    }
    else {
        // first time this is clicked, mark it
        $this.addClass("clicked-once");        
        $("#year_2013").show();
    }
});	

$("#btn_2014").click(function(event){
    var $this = $(this);
    if ($this.hasClass("clicked-once")) {
        // already been clicked once, hide it
        //$this.hide();
        $("#year_2014").hide();
        $this.removeClass("clicked-once")
    }
    else {
        // first time this is clicked, mark it
        $this.addClass("clicked-once");        
        $("#year_2014").show();
    }
}); 

$("#btn_2015").click(function(event){
    var $this = $(this);
    if ($this.hasClass("clicked-once")) {
        // already been clicked once, hide it
        //$this.hide();
        $("#year_2015").hide();
        $this.removeClass("clicked-once")
    }
    else {
        // first time this is clicked, mark it
        $this.addClass("clicked-once");        
        $("#year_2015").show();
    }
});

$("#btn_2016").click(function(event){
    var $this = $(this);
    if ($this.hasClass("clicked-once")) {
        // already been clicked once, hide it
        //$this.hide();
        $("#year_2016").hide();
        $this.removeClass("clicked-once")
    }
    else {
        // first time this is clicked, mark it
        $this.addClass("clicked-once");        
        $("#year_2016").show();
    }
}); 

 
});
 
 