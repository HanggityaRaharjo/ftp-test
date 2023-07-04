(function ($) {
    // Tambahkan nama plugin di sini
    $.extend($.summernote.plugins, {
        insertIframe: function (context) {
            var self = this;

            // Buat tombol untuk memanggil dialog box
            var insertIframeButton = function () {
                var button = $.summernote.ui.button({
                    contents: '<i class="fa fa-code"></i> Insert Iframe',
                    tooltip: "Insert Iframe",
                    click: function () {
                        // Panggil method showIframeDialog ketika tombol diklik
                        self.showIframeDialog();
                    },
                });
                return button.render();
            };

            // Buat dialog box untuk memasukkan iframe
            this.showIframeDialog = function () {
                var $iframeDialog = $("<div/>", {
                    class: "modal fade",
                    tabindex: "-1",
                    role: "dialog",
                }).appendTo("body");
                var $iframeDialogModal = $("<div/>", {
                    class: "modal-dialog",
                    role: "document",
                }).appendTo($iframeDialog);
                var $iframeDialogContent = $("<div/>", {
                    class: "modal-content",
                }).appendTo($iframeDialogModal);
                var $iframeDialogHeader = $("<div/>", {
                    class: "modal-header",
                }).appendTo($iframeDialogContent);
                var $iframeDialogTitle = $("<h5/>", {
                    class: "modal-title",
                    text: "Insert Iframe",
                }).appendTo($iframeDialogHeader);
                var $iframeDialogBody = $("<div/>", {
                    class: "modal-body",
                }).appendTo($iframeDialogContent);
                var $iframeDialogFooter = $("<div/>", {
                    class: "modal-footer",
                }).appendTo($iframeDialogContent);
                var $iframeDialogCloseButton = $("<button/>", {
                    type: "button",
                    class: "btn btn-secondary",
                    "data-dismiss": "modal",
                    text: "Close",
                }).appendTo($iframeDialogFooter);
                var $iframeDialogInsertButton = $("<button/>", {
                    type: "button",
                    class: "btn btn-primary",
                    text: "Insert",
                }).appendTo($iframeDialogFooter);

                var $iframeUrlInput = $("<input/>", {
                    type: "text",
                    class: "form-control",
                    placeholder: "URL of the iframe",
                }).appendTo($iframeDialogBody);

                $iframeDialog.modal("show");

                // Ketika tombol Insert diklik, masukkan iframe ke dalam editor
                $iframeDialogInsertButton.on("click", function () {
                    var iframeUrl = $iframeUrlInput.val();
                    //console.log("insert", iframeUrl);
                    //context.invoke("editor.insertText", iframeUrl);
                    // context.invoke(
                    //     "editor.insertText",
                    //     '<iframe src="' + iframeUrl + '"></iframe>'
                    // );

                    var node = document.createElement("span");
                    node.innerHTML =
                        '<iframe src="' + iframeUrl + '"' + "></iframe>";
                    context.invoke("editor.insertNode", node);

                    $iframeDialog.modal("hide");
                });
            };

            // Tambahkan tombol pada toolbar Summernote
            context.memo("button.insertIframe", insertIframeButton);
        },
    });
})(jQuery);
