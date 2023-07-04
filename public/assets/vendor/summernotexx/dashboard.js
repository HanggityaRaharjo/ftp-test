(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD. Register as an anonymous module.
        define(["jquery"], factory);
    } else if (typeof module === "object" && module.exports) {
        // Node/CommonJS

        module.exports = factory(require("jquery"));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
})(function ($) {
    // Extends plugins for Summernote
    // -----------------------------
    $.extend($.summernote.plugins, {
        iframe: function (context) {
            var self = this;
            var ui = $.summernote.ui;
            var $note = context.layoutInfo.note;
            var $editor = context.layoutInfo.editor;
            var $editable = context.layoutInfo.editable;

            // plugin options
            var options = context.options;
            console.log("hereerer ", options);

            // create button
            var $button = ui.button({
                contents: '<i class="fa fa-code"/> iframe',
                tooltip: "Insert Iframe",
                click: function () {
                    self.show();
                },
            });

            // add button to the toolbar
            context.options.toolbar[0].push("iframe");
            $toolbar = $editor.find(".note-toolbar");
            $toolbar.append($button);

            // create modal
            var $modal = ui
                .modal({
                    title: "Insert Iframe",
                    body: '<div class="form-group"><label>Embed URL</label><input class="note-iframetext form-control" type="text"></div>',
                    footer: '<button href="#" class="btn btn-primary note-iframe-btn">Insert</button>',
                })
                .render();

            $modal.find(".modal-body").css({
                "max-height": 300,
                overflow: "scroll",
            });

            // add event listener to Insert button in modal
            $modal.find(".note-iframe-btn").on("click", function (event) {
                event.preventDefault();
                var url = $modal.find(".note-iframetext").val();

                // create iframe
                var iframe = '<iframe src="' + url + '"></iframe>';

                // insert iframe into editor
                context.invoke("editor.insertHTML", iframe);

                // hide modal
                $modal.modal("hide");
            });

            // show modal
            this.show = function () {
                $modal.modal("show");
            };

            // hide modal
            this.hide = function () {
                $modal.modal("hide");
            };

            // this methods will be called when editor is initialized by $('..').summernote();
            this.initialize = function () {
                var ui = $.summernote.ui;
                var $toolbar = context.layoutInfo.toolbar;
                var button = $button(context.options.lang);
                $toolbar.prepend(button);
            };

            // this methods will be called when user click the button within the editor
            this.destroy = function () {
                $button.remove();
                $modal.remove();
            };
        },
    });
});
