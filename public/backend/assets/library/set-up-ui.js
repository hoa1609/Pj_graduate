(function($){
    "use strict";

    var HT = {};
    HT.sortui = () => {
        $( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
    }

    $(document).ready(function(){
        HT.sortui();

    });
})(jQuery);
