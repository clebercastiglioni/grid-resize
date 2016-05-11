var masks = {
    init: function(){
        $(".phone-input").mask('(99) 9999.9999?9');
        $(".date-input").mask('99/99/9999');
        $(".cep-input").mask('99999-999');
        $(".cpf-input").mask('999.999.999-99');
        $(".cnpj-input").mask('99.999.999/9999-99');
    },
};

var browserDetect = {
    init: function () {
        this.browser = this.searchString(this.dataBrowser) || "Other";
        this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";

        if(browserDetect.browser == 'Explorer'){
            $('html').addClass('ie ie-' + browserDetect.version);
        }
    },
    searchString: function (data) {
        for (var i = 0; i < data.length; i++) {
            var dataString = data[i].string;
            this.versionSearchString = data[i].subString;

            if (dataString.indexOf(data[i].subString) !== -1) {
                return data[i].identity;
            }
        }
    },
    searchVersion: function (dataString) {
        var index = dataString.indexOf(this.versionSearchString);
        if (index === -1) {
            return;
        }

        var rv = dataString.indexOf("rv:");
        if (this.versionSearchString === "Trident" && rv !== -1) {
            return parseFloat(dataString.substring(rv + 3));
        } else {
            return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
        }
    },

    dataBrowser: [
        {string: navigator.userAgent, subString: "Edge", identity: "MS Edge"},
        {string: navigator.userAgent, subString: "Chrome", identity: "Chrome"},
        {string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
        {string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
        {string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
        {string: navigator.userAgent, subString: "Safari", identity: "Safari"},
        {string: navigator.userAgent, subString: "Opera", identity: "Opera"}
    ]

};

$.fn.extend({
    watch: function(){
        return this.each(function() {
            target = this;

            $(target).submit(function(e){
                e.preventDefault();

                var form = $(target);

                var button = $(form.find('button[type=submit]'));

                var msg = button.text();

                button.text('Enviando...');

                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function (data) {
                        $(target).trigger('form.success', data);

                        if(data.state == 'success'){
                            form[0].reset();
                            button.text(data.msg);
                            setTimeout(function () {
                                button.text(msg);
                            }, 4000);
                        }
                    },
                    error: function (data) {
                        $(target).trigger('form.error', data);

                        button.text('Erro ao enviar mensagem');
                        setTimeout(function () {
                            button.text(msg);
                        },4000);
                        
                    }
                });
            });
        });
    },
});
    
function bannerClick(prev, next, b){                
    $banner = $(b);
    bannerOffset = $banner.offset().top;
    bannerHeight = $banner.height();

    $(document).keydown(function(e){
        var isLightbox = $('html').hasClass('uk-modal-page');
        if($(window).scrollTop() < (bannerOffset + bannerHeight) && !isLightbox){
            if(e.keyCode == 39)
                $($(next)).trigger('click');
            else if(e.keyCode == 37)
                $($(prev)).trigger('click');
        }
    });                    
}


$(function(){
    masks.init();
    browserDetect.init();

    // $('#formTeste').watch();    
});
