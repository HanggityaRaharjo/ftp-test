(function (factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery", "summernote"], factory);
    } else if (typeof module === "object" && module.exports) {
        module.exports = factory(require("jquery"), require("summernote"));
    } else {
        factory(window.jQuery, window.jQuery.fn.summernote);
    }
})(function ($, summernote) {
    // Tambahkan plugin ke daftar plugin Summernote
    $.extend($.summernote.plugins, {
        iframe: function (context) {
            var self = this;

            // Buat tombol iframe
            var iframeButton = function (lang) {
                var button = $.summernote.ui.button({
                    contents: '<i class="fa fa-cog"></i>',
                    tooltip: "Iframe",
                    click: function () {
                        console.log("here", self.show);
                        // context.invoke("iframe.show");
                        //iframe.iframeDialog();
                        self.show;
                    },
                });
                return button.render();
            };

            iframeDialog = function () {
                return $("<div>")
                    .addClass("modal")
                    .attr("tabindex", -1)
                    .attr("role", "dialog")
                    .append(
                        $("<div>")
                            .addClass("modal-dialog")
                            .attr("role", "document")
                            .append(
                                $("<div>")
                                    .addClass("modal-content")
                                    .append(
                                        $("<div>")
                                            .addClass("modal-header")
                                            .append(
                                                $("<h5>")
                                                    .addClass("modal-title")
                                                    .html("Insert Iframe")
                                            )
                                            .append(
                                                $("<button>")
                                                    .addClass("close")
                                                    .attr("type", "button")
                                                    .attr(
                                                        "data-dismiss",
                                                        "modal"
                                                    )
                                                    .attr("aria-label", "Close")
                                                    .append(
                                                        $("<span>")
                                                            .attr(
                                                                "aria-hidden",
                                                                true
                                                            )
                                                            .html("&times;")
                                                    )
                                            )
                                    )
                                    .append(
                                        $("<div>")
                                            .addClass("modal-body")
                                            .append(
                                                $("<div>")
                                                    .addClass("form-group")
                                                    .append(
                                                        $("<label>").html("URL")
                                                    )
                                                    .append(
                                                        $("<input>")
                                                            .addClass(
                                                                "form-control"
                                                            )
                                                            .attr(
                                                                "type",
                                                                "text"
                                                            )
                                                            .attr(
                                                                "id",
                                                                "iframeUrl"
                                                            )
                                                            .attr(
                                                                "placeholder",
                                                                "https://example.com"
                                                            )
                                                    )
                                            )
                                            .append(
                                                $("<div>")
                                                    .addClass("form-group")
                                                    .append(
                                                        $("<label>").html(
                                                            "Width"
                                                        )
                                                    )
                                                    .append(
                                                        $("<input>")
                                                            .addClass(
                                                                "form-control"
                                                            )
                                                            .attr(
                                                                "type",
                                                                "text"
                                                            )
                                                            .attr(
                                                                "id",
                                                                "iframeWidth"
                                                            )
                                                            .attr(
                                                                "placeholder",
                                                                "100%"
                                                            )
                                                    )
                                            )
                                            .append(
                                                $("<div>")
                                                    .addClass("form-group")
                                                    .append(
                                                        $("<label>").html(
                                                            "Height"
                                                        )
                                                    )
                                                    .append(
                                                        $("<input>")
                                                            .addClass(
                                                                "form-control"
                                                            )
                                                            .attr(
                                                                "type",
                                                                "text"
                                                            )
                                                            .attr(
                                                                "id",
                                                                "iframeHeight"
                                                            )
                                                            .attr(
                                                                "placeholder",
                                                                "400"
                                                            )
                                                    )
                                            )
                                    )
                                    .append(
                                        $("<div>")
                                            .addClass("modal-footer")
                                            .append(
                                                $("<button>")
                                                    .addClass("btn btn-primary")
                                                    .attr("type", "button")
                                                    .html("Insert")
                                                    .on("click", function (e) {
                                                        // Ambil nilai input
                                                        var url =
                                                            $(
                                                                "#iframeUrl"
                                                            ).val();
                                                        var width =
                                                            $(
                                                                "#iframeWidth"
                                                            ).val();
                                                        var height =
                                                            $(
                                                                "#iframeHeight"
                                                            ).val();

                                                        // Buat kode iframe
                                                        var iframe = $(
                                                            "<iframe>"
                                                        )
                                                            .attr("src", url)
                                                            .attr(
                                                                "width",
                                                                width
                                                            )
                                                            .attr(
                                                                "height",
                                                                height
                                                            );

                                                        // Sisipkan kode iframe
                                                        context.invoke(
                                                            "insertNode",
                                                            iframe[0]
                                                        );

                                                        // Tutup dialog
                                                        $(this)
                                                            .closest(".modal")
                                                            .modal("hide");
                                                    })
                                            )
                                    )
                            )
                    );
            };

            // Tampilkan dialog iframe
            this.show = function () {
                var iframe = $(
                    '<textarea class="form-control" rows="10"></textarea>'
                );
                context.invoke("editor.saveRange");
                context.invoke("dialog.show", {
                    title: "Insert Iframe",
                    body: iframe,
                    callback: function () {
                        var iframeSrc = iframe.val();
                        context.invoke("editor.restoreRange");
                        context.invoke(
                            "editor.insertNode",
                            $("<iframe>").attr("src", iframeSrc)
                        );
                    },
                });
            };

            // Tambahkan tombol ke toolbar
            this.initialize = function () {
                var ui = $.summernote.ui;
                var $toolbar = context.layoutInfo.toolbar;
                var button = iframeButton(context.options.lang);
                $toolbar.prepend(button);
            };

            // Hapus plugin dari toolbar
            this.destroy = function () {
                this.$panel.remove();
                this.$panel = null;
            };
        },
    });
});
