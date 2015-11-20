var imageCrop = function () {

    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        jcrop_api2,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();

    function events() {
        // Attach interface buttons
        // This may appear to be a lot of code but it's simple stuff
        $('#setSelect').click(function (e) {
            e.preventDefault();
            // Sets a random selection
            jcrop_api2.setSelect(getRandom());
        });
        $('#animateTo').click(function (e) {
            e.preventDefault();
            // Animates to a random selection
            jcrop_api2.animateTo(getRandom());
        });
        $('#release').click(function (e) {
            e.preventDefault();
            // Release method clears the selection
            jcrop_api2.release();
        });
        $('#disable').click(function (e) {
            e.preventDefault();
            // Disable Jcrop instance
            jcrop_api2.disable();
            // Update the interface to reflect disabled state
            $('#enable').show();
            $('.requiresjcrop').hide();
        });
        $('#enable').click(function (e) {
            e.preventDefault();
            // Re-enable Jcrop instance
            jcrop_api2.enable();
            // Update the interface to reflect enabled state
            $('#enable').hide();
            $('.requiresjcrop').show();
        });
        $('#rehook').click(function (e) {
            e.preventDefault();
            // This button is visible when Jcrop has been destroyed
            // It performs the re-attachment and updates the UI
            $('#rehook,#enable').hide();
            initJcrop();
            $('#unhook,.requiresjcrop').show();
            return false;
        });
        $('#unhook').click(function (e) {
            e.preventDefault();
            // Destroy Jcrop widget, restore original state
            jcrop_api2.destroy();
            // Update the interface to reflect un-attached state
            $('#unhook,#enable,.requiresjcrop').hide();
            $('#rehook').show();
            return false;
        });

        // Hook up the three image-swapping buttons
        $('#img1').click(function (e) {
            e.preventDefault();
            $(this).addClass('active').closest('.btn-group')
                .find('button.active').not(this).removeClass('active');

            jcrop_api2.setImage('img/sago.jpg');
            jcrop_api2.setOptions({
                bgOpacity: 0.6
            });
            return false;
        });
        $('#img2').click(function (e) {
            e.preventDefault();
            $(this).addClass('active').closest('.btn-group')
                .find('button.active').not(this).removeClass('active');

            jcrop_api2.setImage('img/pool.jpg');
            jcrop_api2.setOptions({
                bgOpacity: 0.6
            });
            return false;
        });
        $('#img3').click(function (e) {
            e.preventDefault();
            $(this).addClass('active').closest('.btn-group')
                .find('button.active').not(this).removeClass('active');

            jcrop_api2.setImage('img/sago.jpg', function () {
                this.setOptions({
                    bgOpacity: 1,
                    outerImage: 'img/sagomod.jpg'
                });
                this.animateTo(getRandom());
            });
            return false;
        });

        // The checkboxes simply set options based on it's checked value
        // Options are changed by passing a new options object

        // Also, to prevent strange behavior, they are initially checked
        // This matches the default initial state of Jcrop

        $('#can_click').change(function (e) {
            e.preventDefault();
            jcrop_api2.setOptions({
                allowSelect: !!this.checked
            });
            jcrop_api2.focus();
        });
        $('#can_move').change(function (e) {
            e.preventDefault();
            jcrop_api2.setOptions({
                allowMove: !!this.checked
            });
            jcrop_api2.focus();
        });
        $('#can_size').change(function (e) {
            e.preventDefault();
            jcrop_api2.setOptions({
                allowResize: !!this.checked
            });
            jcrop_api2.focus();
        });
        $('#ar_lock').change(function (e) {
            e.preventDefault();
            jcrop_api2.setOptions(this.checked ? {
                aspectRatio: 4 / 3
            } : {
                aspectRatio: 0
            });
            jcrop_api2.focus();
        });
        $('#size_lock').change(function (e) {
            e.preventDefault();
            jcrop_api2.setOptions(this.checked ? {
                minSize: [80, 80],
                maxSize: [350, 350]
            } : {
                minSize: [0, 0],
                maxSize: [0, 0]
            });
            jcrop_api2.focus();
        });
    }

    function updatePreview(c) {
        if (parseInt(c.w) > 0) {
            var rx = xsize / c.w;
            var ry = ysize / c.h;

            $pimg.css({
                width: Math.round(rx * boundx) + 'px',
                height: Math.round(ry * boundy) + 'px',
                marginLeft: '-' + Math.round(rx * c.x) + 'px',
                marginTop: '-' + Math.round(ry * c.y) + 'px'
            });
        }
    }

    // The function is pretty simple
    function initJcrop() //{{{
    {
        // Hide any interface elements that require Jcrop
        // (This is for the local user interface portion.)
        $('.requiresjcrop').hide();


        $('#target').Jcrop({
            onChange: updatePreview,
            onSelect: updatePreview,
            aspectRatio: xsize / ysize
        }, function () {
            // Use the API to get the real image size
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            // Store the API in the jcrop_api variable
            jcrop_api = this;

            // Move the preview into the jcrop container for css positioning
            $preview.appendTo(jcrop_api.ui.holder);
        });


        // Invoke Jcrop in typical fashion
        $('#target2').Jcrop({
            onRelease: releaseCheck
        }, function () {

            jcrop_api2 = this;
            jcrop_api2.animateTo([100, 100, 400, 300]);

            // Setup and dipslay the interface for "enabled"
            $('#can_click,#can_move,#can_size').attr('checked', 'checked');
            $('#ar_lock,#size_lock,#bg_swap').attr('checked', false);
            $('.requiresjcrop').show();

        });
    }

    // Use the API to find cropping dimensions
    // Then generate a random selection
    // This function is used by setSelect and animateTo buttons
    // Mainly for demonstration purposes
    function getRandom() {
        var dim = jcrop_api2.getBounds();
        return [
        Math.round(Math.random() * dim[0]),
        Math.round(Math.random() * dim[1]),
        Math.round(Math.random() * dim[0]),
        Math.round(Math.random() * dim[1])
      ];
    }

    // This function is bound to the onRelease handler...
    // In certain circumstances (such as if you set minSize
    // and aspectRatio together), you can inadvertently lose
    // the selection. This callback re-enables creating selections
    // in such a case. Although the need to do this is based on a
    // buggy behavior, it's recommended that you in some way trap
    // the onRelease callback if you use allowSelect: false
    function releaseCheck() {
        jcrop_api2.setOptions({
            allowSelect: true
        });
        $('#can_click').attr('checked', false);
    }

    return {
        init: function () {
            events();
            initJcrop();
        }
    };
}();

$(function () {
    "use strict";
    imageCrop.init();
});