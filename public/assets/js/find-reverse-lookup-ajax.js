$(document).ready(function(){
    $(".get_find_name").click(function(e){
        e.preventDefault();
        
        let flow_address = $(this).attr("data-flow-address");
        let cells_to_update = $('.find_name_' + flow_address);
        
        cells_to_update.html('wait...');
        
        $.ajax({
            type: "GET",
            url: "/endpoints/find-reverse-lookup.php?flow_address=" + flow_address,
            success: function (result) {
                if(result.find_name)
                {
                    cells_to_update.html('<a href="https://find.xyz/'+ result.find_name +'" class="text_link_bright" target="_blank">'+ result.find_name +'</a>');
                }
                else
                {
                    cells_to_update.html('n/a');
                }
            },
            dataType: "json"
        });
    });
});