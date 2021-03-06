  /*
 * These are functions for Gov 2.0 Indonesia based on various library so it has dependencies
 * Each library used here has their own credit and license.
 * You may reproduce, copy and modfiy it as long as you keep each library name remain intact
 * Known libs so far: jQuery, Bootstrap, Footable
 * Any comment or feedback please contact Wibisono Sastrodiwiryo (wibi@alumni.ui.ac.id)
 */

    $(document).ready(function(){
        $('.footable').footable();
        $('.footable-order').footable(); 

    //---------- search 
        $('table').footable().bind('footable_filtering', function (e) {        
          var selected = $('#filter_status').find(':selected').val();
          if (selected && selected.length > 0) {
            e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
            e.clear = !e.filter;
          }
        });

        $('.filter-status').change(function (e) {
            e.preventDefault();
            $('table.filter_<?echo $_GET['pageID'];?>').trigger('footable_filter', {filter: $('#filter').val()});
        });

    //---------- del

        $('#remove<?echo $_GET['pageID'];?>').on('show.bs.modal', function(e) {
            var <?echo $_GET['pageID'];?>_id = $(e.relatedTarget).data('<?echo $_GET['pageID'];?>_id');
            $('#remove_<?echo $_GET['pageID'];?>_id').val(<?echo $_GET['pageID'];?>_id);
            var item = $(e.relatedTarget).data('item');
            document.getElementById('remove_item').innerHTML = item;
        });

        $('#change<?echo $_GET['pageID'];?>').on('show.bs.modal', function(e) {
            var <?echo $_GET['pageID'];?>_id = $(e.relatedTarget).data('<?echo $_GET['pageID'];?>_id');
            $('#change_<?echo $_GET['pageID'];?>_id').val(<?echo $_GET['pageID'];?>_id);
            var item = $(e.relatedTarget).data('item');
            document.getElementById('change_item').innerHTML = item;
        });

        $('#reset<?echo $_GET['pageID'];?>').on('show.bs.modal', function(e) {
            var <?echo $_GET['pageID'];?>_id = $(e.relatedTarget).data('<?echo $_GET['pageID'];?>_id');
            $('#reset_<?echo $_GET['pageID'];?>_id').val(<?echo $_GET['pageID'];?>_id);
            var item = $(e.relatedTarget).data('item');
            document.getElementById('reset_item').innerHTML = item;
        });

        $('table').footable().on('click', '.row-delete', function(e) {
            e.preventDefault();
            var footable = $('table').data('footable');
            var row = $(this).parents('tr:first');
            footable.removeRow(row);
        });
        
    //---------- add    

        $('#openForm_<?echo $_GET['pageID'];?>').on('click', function(e) {
            $('#button_<?echo $_GET['pageID'];?>').val("add"); 
            $('#button_<?echo $_GET['pageID'];?>').text("Submit");  
        });
        
        $('#closeForm_<?echo $_GET['pageID'];?>').click(function() {
            $(this).closest('form').find("input[type=text], textarea").val("");
        });

        $("#form_reset").click(function() {
            $(this).closest('form').find("input[type=text], textarea").val("");
        });  

    //---------- cloud iframe

        function resize(){
            if ('parentIFrame' in window) {
                // Fix race condition in FireFox with setTimeout
                setTimeout(parentIFrame.size(parentIFrame),0);
            }
        }
        $('.tabresize').click(resize);

    //---------- panel iframe

        $('.sidepanel').on('click', function(){
            $('#config-tool').toggleClass('closed');
            $('#panel_button_top').toggleClass('fa-arrow-circle-right');
            $('#panel_button_bottom').toggleClass('fa-arrow-circle-right');
        });

        $("#panelbody").height($(window).height()-141);

        $(window).resize(function() {
            $("#panelbody").height($(window).height()-141);
            $('#panelbody').animate({scrollTop: $('#panel_frame').height()}, 1000);
        });

        $('#panel_refresh').click(function() {
           $('#panel_frame').prop("src", $('#panel_frame').prop("src"));
        });

        $('#panel_ontop').click(function() {
            if ($('#panel_ontop_icon').hasClass('unpin')) {
                var ontop='ontop_panel';
            } else {
                var ontop='offtop_panel';
            }
            $.post("cloud.php",
            {
                cmd: ontop,
                url: $('#panel_frame').prop("src"),
            },
            function(data, status){
                alert("Message: " + data + "\nStatus: " + status);
            });
            $('#panel_ontop_icon').toggleClass('unpin');
        }); 

        $('#cloud_refresh').click(function() {
           $('#service_frame').prop("src", $('#service_frame').prop("src"));
        });  

        $('#share_to_panel').click(function() {
            var cloud_url=$('#panel_url').val();
            var panel_url=cloud_url.replace("identify","panel");

           $('#panel_frame').prop("src", panel_url);
            if ($('#config-tool').hasClass('closed')) {
                $('#config-tool').toggleClass('closed');
                $('#panel_button_top').toggleClass('fa-arrow-circle-right');
                $('#panel_button_bottom').toggleClass('fa-arrow-circle-right');
            }
            $('#panel_icon').prop('class',$('#cloud_icon').prop('class'));
            $('#panel_caption').text($('#cloud_caption').text());
        });

        $(".panel_scroll").click(function(){
            if ('parentIFrame' in window) {
                window.parentIFrame.sendMessage('toppanel');
            }
        });

        $(".cloud_scroll").click(function(){
            if ('parentIFrame' in window) {
                window.parentIFrame.sendMessage('topcloud');
            }
        });
     });

    function openForm(data) {
        var obj = jQuery.parseJSON(data);
        jQuery.each(obj, function(key, val) {
            if ($('#form_'+key).is(':checkbox')) {
                $('#form_'+key).prop('checked', true);
            } else {
                $('#form_'+key).val(val);
            }
        });

        $('#button_<?echo $_GET['pageID'];?>').val("update"); 
        $('#button_<?echo $_GET['pageID'];?>').text("Save");  
        $('#addform_<?echo $_GET['pageID'];?>').modal('show');
    }

    function closeForm_<?echo $_GET['pageID'];?>() {
        $('#addform_<?echo $_GET['pageID'];?>').modal('hide');
        $('#button_<?echo $_GET['pageID'];?>').val("add"); 
        $('#button_<?echo $_GET['pageID'];?>').text("Submit");
        $(this).closest('form').find("input[type=text], textarea").val("");
    }

    function closeRemove_<?echo $_GET['pageID'];?>() {
        $('#closeRemove_<?echo $_GET['pageID'];?>').click();
    }

    function closeChange_<?echo $_GET['pageID'];?>() {
        $('#closeChange_<?echo $_GET['pageID'];?>').click();
    }
    
    function RemoveUpdate_<?echo $_GET['pageID'];?>(row) {
        $('#del_<?echo $_GET['pageID'];?>_'+row).click();
    }

    function AddUpdate_<?echo $_GET['pageID'];?>() {
        $('#redraw_<?echo $_GET['pageID'];?>').click();
    }
   
    function showAdded() {
        var paramTable = $('.footable');
        paramTable.trigger('footable_expand_first_row'); //Report row addition
    }

    function showUpdated(row) {
        var paramRow=$('#row_<?echo $_GET['pageID'];?>_'+row);
        paramRow.trigger('footable_row_expanded'); 
    }
        
    function updateFootable() {
        var paramTable = $('.footable');
        paramTable.trigger('footable_redraw'); //Redraw the table
    }

    function magnific_gallery() {
        $('.gallery-photos-lightbox').magnificPopup({
            type: 'image',
            delegate: 'a',
            gallery: {
                enabled: true
            }
        });
    }