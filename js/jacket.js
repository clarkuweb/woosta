// moves certain hero elements into #jacket at the top of the body
( function() {

	function createJacket() {
		var j = document.createElement("DIV");
		j.id = "jacket";
		document.body.insertBefore(j, document.getElementById("page"));
	}
	
	window.addEventListener("DOMContentLoaded", function() {
		var js = document.getElementById("primary").querySelectorAll(".jacket");
		if ( !! js ) {
			createJacket();
			js.forEach(function(el) {
				document.getElementById("jacket").appendChild(el);
			});
		}
  }, false);
    
})();