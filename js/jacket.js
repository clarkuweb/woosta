// moves certain hero elements into #jacket at the top of the body
( function() {

	function createJacket() {
		var skip = document.querySelector(".skip-link")
		var j = document.createElement("DIV");
		j.id = "jacket";
		
		skip.parentNode.insertBefore(j, skip.nextSibling);
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