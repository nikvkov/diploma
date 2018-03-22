//var files; // переменная. будет содержать данные файлов
//идентификатор таймера
var timerId;
// Данная функция выполняется, когда объектная модель готова к использованию:

$( document ).ready(function() {

    $('#bad-links-step-2').hide();
    $('#bad-links-step-3').hide();
    $('#get-all-links-step-2').hide();
    $('#loader').hide();
    $('#sitemap-step-2').hide();
    $('#sitemap-step-3').hide();
    $('#sitemap-step-4').hide();

    $('[data-toggle="offcanvas"]').click(function(){
        $("#navigation").toggleClass("hidden-xs");
    });

});


/**
 * Страница service-bad-links
 */
//выбор типа задания ссылок и переход к шагу 2
function badLinksStep2() {

        //отправка ajax запроса
        $.ajax({

            url: "/services/ajax-bad-links",
            type: "POST",
            data: {checkedRadioStep2:$("input:radio[name ='bad_links_show_step_2']:checked").val()},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#bad-links-step-2').html(data);
            $('#bad-links-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#bad-links-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//badLinksStep2

//изменение выбора radiobox
function changeLinkContainer() {
    $('#bad-links-step-2').hide();
    $('#loader').hide();
}//changeLinkContainer()

//начало обраборътки ссылок из textarea
function startCheckBadLinksFromArea(){

    //делаем кнопку и поле ввода недоступной на время работы скрипта
    $('#area-from-bad-links').prop('disabled',true);
    $('#bt_start_check_area').prop('disabled',true);
    $('#bad-links-step-3').hide();
    $('#loader').show();
    //получаем данные из области
    var text = $('#area-from-bad-links').val();
    var arr = text.split('\n');
    //убираем пустые элементы
    arr = arr.filter(function(n){ return n != undefined && $.trim(n).length != 0 });

    //кодируем массив в json
    var json = JSON.stringify(arr);
    //запускаем удаленное віполнение скрипта

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-bad-links",
        type: "POST",
        data: {get_bad_links_from_area: json,
               is_need_email:$("#is_need_email").is(':checked'),
               need_email:$("#need_email").val()
        },

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
            $('#bad-links-step-3').html(data);
            $('#bad-links-step-3').show();
            $('#area-from-bad-links').prop('disabled',false);
            $('#bt_start_check_area').prop('disabled',false);
            $('#bad-links-step-3').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#bad-links-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#area-from-bad-links').prop('disabled',false);
            $('#bt_start_check_area').prop('disabled',false);

        }
    });

}//startCheckBadLinksFromArea

//начало обраборътки ссылок из textarea
function showExistFile(){

    //делаем кнопку и поле ввода недоступной на время работы скрипта
    $('#bad-links-step-2').show();
    $('#bad-links-step-3').hide();
    $('#loader').show();

//отправка ajax запроса
    $.ajax({

        url: "/services/ajax-bad-links",
        type: "POST",
        data: {checkedRadioStep2:$("input:radio[name ='bad_links_show_step_2']:checked").val(),
               currentUser:"currentUser"},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
            $('#bad-links-step-3').html(data);
            $('#bad-links-step-3').show();
            $('#area-from-bad-links').prop('disabled',false);
            $('#bt_start_check_area').prop('disabled',false);
            $('#bad-links-step-3').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#bad-links-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#area-from-bad-links').prop('disabled',false);
            $('#bt_start_check_area').prop('disabled',false);

        }
    });

}//startCheckBadLinksFromArea

//отправка данных на сервер
function ajaxLoadFiles(formData) {

    $('#bad-links-step-3').hide();
    $('#loader').show();
    $.ajax({
        url: "/services/ajax-bad-links-load-file",
        type: "POST",
        data: formData,

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        success: function (data) {

            $('#loader').hide();
            $('#bad-links-step-3').html(data);
            $('#bad-links-step-3').show();
            $('#bad-links-step-3').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#bad-links-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        error: function(msg) {
            alert('Ошибка!');
            $('#loader').hide();
        },
        cache: false,
        contentType: false,
        processData: false
    });

}//ajaxLoadFiles(formData)

/**
 *service-get-all-links
 */
//получение ссылок сайта
function startCheckSite() {
    $('#loader').show();
    startTimer();

    // console.log($("#is_need_email").is(':checked'));
    // console.log($("#need_email").val());
    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-get-all-links",
        type: "POST",
        data: {main_uri:$("#uri-for-check").val(),
               is_check_images:$("#is_check_images").is(':checked'),
               is_check_mining:$("#is_check_mining").is(':checked'),
               is_need_email:$("#is_need_email").is(':checked'),
               need_email:$("#need_email").val()
        },

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {
            $('#loader').hide();
            stopTimer();
            $('#get-all-links-step-2').html(data);
            $('#get-all-links-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#get-all-links-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            $('#loader').hide();
            stopTimer();
            alert('Ошибка!Проверьте указанный адрес'+msg);
            $('#get-all-links-step-2').html(msg);
            $('#get-all-links-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#get-all-links-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        }

    });

}//startCheckSite

//данных из файла
function showDataInFile(filename) {

    $('#loader').show();
    startTimer();
    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-get-links-show-data",
        type: "POST",
        data: {filename:filename,
            is_need_email:$("#is_need_email").is(':checked'),
            need_email:$("#need_email").val()
        },

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {
            $('#loader').hide();
            stopTimer();
            $('#get-all-links-step-2').html(data);
            $('#get-all-links-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#get-all-links-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка чтения данных : '+msg);
            $('#loader').hide();
            stopTimer();
        }

    });

}//showDataInFile

//показать ранее созданные файлы
function showAllFiles() {

    $('#loader').show();
    startTimer();
    $('#get-all-links-step-2').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-get-links-show-all-files",
        type: "POST",
        data: {currentUser:""},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {
            $('#loader').hide();
            stopTimer();
            $('#get-all-links-step-2').html(data);
            $('#get-all-links-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#get-all-links-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка чтения данных : '+msg);
            $('#loader').hide();
            stopTimer();
        }

    });

}//showAllFiles(

//показать поле mail
function showEmailField() {

    if($('#is_need_email').is(':checked')){
        $('#showMailField').show();
    }else{
        $('#showMailField').hide();
    }

}//showEmailField()

/**
 * service-sitemap-generator
 */

//выбор источника ссылок
function sitemapStep2() {

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-sitemap-step",
        type: "POST",
        data: {checkedRadioStep2: $("input:radio[name ='radio_sitemap_step_2']:checked").val()},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#sitemap-step-2').html(data);
            $('#sitemap-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#sitemap-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });

}//sitemapStep2

//изменение выбора radiobox
function changeStep2Sitemap() {
    $('#sitemap-step-2').hide();
    $('#loader').hide();
    stopTimer();
}//changeLinkContainer()

//обработка ссылок из текста
function step3FromArea() {

    //делаем кнопку и поле ввода недоступной на время работы скрипта

    $('#sitemap-step-3').hide();
    $('#loader').show();
    startTimer();
    //получаем данные из области
    var text = $('#area-from-sitemap').val();
    var arr = text.split('\n');
    //убираем пустые элементы
    arr = arr.filter(function(n){ return n != undefined && $.trim(n).length != 0 });

    //кодируем массив в json
    var json = JSON.stringify(arr);
    //запускаем удаленное віполнение скрипта

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-sitemap-step3-from-area",
        type: "POST",
        data: {get_sitemap_from_area: json},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
            stopTimer();
            $('#sitemap-step-3').html(data);
            $('#sitemap-step-3').show();
            $('#sitemap-step-3').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#sitemap-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
            stopTimer();
        }
    });

}//step3FromArea()

//отметить все ссылки
function checkAllRow(){

    // Отметить все
    $('#linksForSitemap input:checkbox').prop('checked', $('#allCheckInTable').is(':checked'));

}//checkAllRow

//получение данных из таблицы
function getLinksFromTable() {
    var links = [];

    //заполняем массив значениями отмеченных ссылок
    $('#linksForSitemap input:checkbox:checked').each(function(){
        var temp = [];
        temp.push($(this).val());

        var row = $(this).parent().parent().parent().parent().children().eq(2);
       // console.log($(this).parent().parent().parent().parent().children().eq(2));
        temp.push(row.children("select").val());
        row = $(this).parent().parent().parent().parent().children().eq(3);
        temp.push(row.children("select").val());

        links.push(temp);
    });

   // console.log(links);


    //преобразуем массив в json
    var json = JSON.stringify(links);

    ///console.log(json);

    return json;
}//getLinksFromTable

//создание XML файла
function createXMLFile() {

    $('#sitemap-step-4').hide();
    startTimer();
    var json = getLinksFromTable();
    
    //console.log(json);
    // console.log($("#is_need_email").is(':checked'));
    // console.log($("#need_email").val());

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-sitemap-step3-from-area",
        type: "POST",
        data: {data_links_xml: json,
               is_need_email:$("#is_need_email").is(':checked'),
               need_email:$("#need_email").val()},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
            stopTimer();
            $('#sitemap-step-4').html(data);
            $('#sitemap-step-4').show();
            $('#sitemap-step-4').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#sitemap-step-4').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
            stopTimer();
        }
    });

}//createXMLFile

//создание html файла
function createHTMLFile() {

    startTimer();
    var links = [];

    //заполняем массив значениями отмеченных ссылок
    $('#linksForSitemap input:checkbox:checked').each(function(){
        links.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(links);

    //console.log(json);

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-sitemap-step3-from-area",
        type: "POST",
        data: {data_links_html: json,
              is_need_email:$("#is_need_email").is(':checked'),
              need_email:$("#need_email").val()},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
            stopTimer();
            $('#sitemap-step-4').html(data);
            $('#sitemap-step-4').show();
            $('#sitemap-step-4').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#sitemap-step-4').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
            stopTimer();
        }
    });

}//createHTMLFile()

//отправка данных на сервер
function ajaxLoadFilesForSitemap(formData) {

    $('#sitemap-step-3').hide();
    $('#sitemap-step-4').hide();
    $('#loader').show();
    startTimer();
    $.ajax({
        url: "/services/ajax-sitemap-load-file",
        type: "POST",
        data: formData,
        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        success: function (data) {

            $('#loader').hide();
            stopTimer();
            $('#sitemap-step-3').html(data);
            $('#sitemap-step-3').show();
            $('#sitemap-step-3').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#sitemap-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        error: function(msg) {
            alert('Ошибка!');
            $('#loader').hide();
            stopTimer();
        },
        cache: false,
        contentType: false,
        processData: false
    });

}//ajaxLoadFiles(formData)

//выбор ранее созданного файла для чтения ссылок
function step3FromExistFile() {

    //делаем кнопку и поле ввода недоступной на время работы скрипта

    $('#sitemap-step-3').hide();
    $('#loader').show();
    startTimer();
    //получаем данные из области
    var text = $('#selectedExistFile').val();

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-sitemap-step3-from-exist-file",
        type: "POST",
        data: {filename: text},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
            stopTimer();
            $('#sitemap-step-3').html(data);
            $('#sitemap-step-3').show();
            $('#sitemap-step-3').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#sitemap-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
            stopTimer();
        }
    });

}//step3FromExistFile()

//показать ранее созданные XML карты
function showAllXMLFile() {

    $('#sitemap-step-3').hide();
    $('#loader').show();
    startTimer();
    //получаем данные из области
    var text = $('#selectedExistFile').val();

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-sitemap-step3-show-created-files",
        type: "POST",
        data: {typeFiles: "xml"},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
            stopTimer();
            $('#sitemap-step-3').html(data);
            $('#sitemap-step-3').show();
            $('#sitemap-step-3').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#sitemap-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
            stopTimer();
        }
    });

}//showAllXMLFile(

//показать ранее созданные HTML карты
function showAllHTMLFile() {

    $('#sitemap-step-3').hide();
    $('#loader').show();
    startTimer();
    //получаем данные из области
    var text = $('#selectedExistFile').val();

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-sitemap-step3-show-created-files",
        type: "POST",
        data: {typeFiles: "html"},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
            stopTimer();
            $('#sitemap-step-3').html(data);
            $('#sitemap-step-3').show();
            $('#sitemap-step-3').focus();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#sitemap-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);
        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
            stopTimer();
        }
    });

}//showAllHTMLFile(


/*общие файлы*/
function startTimer() {
    var time ;
    var startTime = new Date($.now());
    // начать повторы с интервалом 2 сек
    timerId = setInterval(function() {
        time = new Date($.now());
        var diff = new Date(time-startTime);
        var h = (diff.getHours()-2)<10? "0"+(diff.getHours()-2):(diff.getHours()-2) ;
        var m = (diff.getMinutes())<10? "0"+(diff.getMinutes()):(diff.getMinutes()) ;
        var s = (diff.getSeconds())<10? "0"+(diff.getSeconds()):(diff.getSeconds()) ;
        mes = "<p>С момента старта прошло : <br/>\n " + h +" : " + m + " : " + s + "</p>";
        $('#timer').html(mes);

    }, 100);
}//startTimer()


function stopTimer() {
    clearInterval(timerId);
}

/*Подписаться на рассылку*/
function subscribe() {

    var email = $("#subscribe_email").val();

    var uri = "/subscribe/add-email/"+email;

    //отправка ajax запроса
    $.ajax({

        url: uri,
        type: "GET",
        data: {subscriber: email},

        //успешное выполнениу
        success: function (data) {
            $('#subscribe_button').html("Спасибо за подписку!");
        },
        //при ошибке
        error: function (msg) {
           console.log(msg);
        }
    });

}//subscribe()

/***Market Place Amazon***/

//показать способ выбора файла
function MarketplaceAmazonStep2(){

    //отправка ajax запроса
    $.ajax({

        url: "/services/amazon-marketplace-show-select-file-type",
        type: "GET",
        data: {checkedRadioStep2:$("input:radio[name ='marketplace_amazon_show_step_2']:checked").val(),
               toLang:$("#amazon_localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-2').html(data);
            $('#mpa-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//MarketplaceAmazonStep2()

//изменение выбора radiobox
function changeLinkContainerMA() {
    $('#mpa-step-2').hide();
    $('#loader').hide();
}//changeLinkContainer()

//отправка данных на сервер
function ajaxLoadFilesMA(formData) {

    $('#mpa-step-3').hide();
    $('#loader').show();
    $.ajax({
        url: "/services/amazon-marketplace-load-file",
        type: "POST",
        data: formData,

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        success: function (data) {

            parseDataFromFile(data);
        },
        error: function(msg) {
            alert('Ошибка!');
            $('#loader').hide();
        },
        cache: false,
        contentType: false,
        processData: false
    });

}//ajaxLoadFiles(formData)

//получаем данные из файла
function parseDataFromFile(filename){

    $('#loader').show();
    $('#mpa-step-3').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/services/amazon-marketplace-parse-data-from-file",
        type: "GET",
        data: {
               is_need_email:$("#is_need_email").is(':checked'),
               need_email:$("#need_email").val(),
               filename:filename,
               fromLang:$("#amazon_original_lang").val(),
               toLang:$("#amazon_localization").val(),
               cms: $("#amazon_CMS").val(),
               category:$("#amazon_category").val(),
               amazon_feed_product_type:$("#amazon_feed_product_type").val(),
               amazon_external_product_id_type:$("#amazon_external_product_id_type").val(),
               amazon_variation_theme:$("#amazon_variation_theme").val(),
               amazon_update_delete:$("#amazon_update_delete").val(),
               amazon_size_map:$("#amazon_size_map").val(),
               amazon_item_display_length_unit_of_measure:$("#amazon_item_display_length_unit_of_measure").val(),
               amazon_item_dimensions_unit_of_measure:$("#amazon_item_dimensions_unit_of_measure").val(),
               amazon_item_weight_unit_of_measure:$("#amazon_item_weight_unit_of_measure").val(),
               amazon_website_shipping_weight_unit_of_measure:$("#amazon_website_shipping_weight_unit_of_measure").val(),
               amazon_package_dimensions_unit_of_measure:$("#amazon_package_dimensions_unit_of_measure").val(),
               amazon_package_weight_unit_of_measure:$("#amazon_package_weight_unit_of_measure").val(),
               amazon_country_of_origin:$("#amazon_country_of_origin").val(),
               amazon_battery_cell_composition:$("#amazon_battery_cell_composition").val(),
               amazon_battery_type:$("#amazon_battery_type").val(),
               amazon_lithium_battery_packaging:$("#amazon_lithium_battery_packaging").val(),
               amazon_are_batteries_included:$("#amazon_are_batteries_included").val(),
               amazon_eu_toys_safety_directive_age_warning:$("#amazon_eu_toys_safety_directive_age_warning").val(),
               amazon_eu_toys_safety_directive_warning:$("#amazon_eu_toys_safety_directive_warning").val(),
               amazon_eu_toys_safety_directive_language:$("#amazon_eu_toys_safety_directive_language").val(),
               amazon_currency:$("#amazon_currency").val(),
               amazon_condition_type:$("#amazon_condition_type").val(),
               amazon_product_tax_code:$("#amazon_product_tax_code").val(),
               amazon_bullet_point1:$("#amazon_bullet_point1").val(),
               amazon_bullet_point2:$("#amazon_bullet_point2").val(),
               amazon_bullet_point3:$("#amazon_bullet_point3").val(),
               amazon_bullet_point4:$("#amazon_bullet_point4").val(),
               amazon_bullet_point5:$("#amazon_bullet_point5").val(),
               amazon_generic_keywords1:$("#amazon_generic_keywords1").val(),
               amazon_generic_keywords2:$("#amazon_generic_keywords2").val(),
               amazon_generic_keywords3:$("#amazon_generic_keywords3").val(),
               amazon_generic_keywords4:$("#amazon_generic_keywords4").val(),
               amazon_generic_keywords5:$("#amazon_generic_keywords5").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-3').html(data);
            $('#loader').hide();
            $('#mpa-step-3').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
        }

    });

}//parseDataFromFile

//показать данные при изменении категории
function getTemplateData() {

    $("#mpa-template-data").hide();
    $("#loader").show();

    //отправка ajax запроса
    $.ajax({

        url: "/services/amazon-marketplace-show-template-data",
        type: "GET",
        data: {
            category : $("#amazon_category").val(),
            fromLang : $("#amazon_original_lang").val(),
            toLang : $("#amazon_localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-template-data').html(data);
            $('#loader').hide();
            $('#mpa-template-data').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-template-data').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            $("#loader").hide();
            alert('Ошибка');
        }

    });

}//getTemplateData()

//показать ранее созданные файлы
function showMarketplaceExistFile(type) {

    $('#loader').show();
    $('#mpa-step-2').hide();
    $('#mpa-template-data').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/services/amazon-marketplace-show-exist-file",
        type: "GET",
        data: {type:type,
               toLang:$("#amazon_localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-2').html(data);
            $('#mpa-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
     });
    $('#loader').hide();

}//showMarketplaceExistFile('amazon')


/*Amazon Sponsored Products*/
//очистить поле шага 2
function changeLinkContainerAmazonAds() {
    $('#amazon-ads-step-2').hide();
    $('#loader').hide();
}

//показать данные ключевых слов
function showKeywordBlock() {

    if($("#amazon_ads_type_keywords").val() == "Auto"){

        $("#show_keywords").hide();
        $("#show_match_type").hide();

    }else{
        $("#show_keywords").show();
        $("#show_match_type").show();
    }

}//showKeywordBlock()

//показать файлы созданные в сервисе 4
function amazonSponsoredProductsStep2(){

    //отправка ajax запроса
    $.ajax({

        url: "/services/adwertising-amazon-ads-show-step2",
        type: "GET",
        data: {checkedRadioStep2:$("input:radio[name ='amazon_ads_show_step_2']:checked").val(),
            toLang:$("#amazon_ads_localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#amazon-ads-step-2').html(data);
            $('#amazon-ads-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#amazon-ads-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//amazonSponsoredProductsStep2()

//показать товары в файле
function amazonAdsShowProducts(filename) {

    $('#amazon-ads-step-3').hide();
    $('#amazon-ads-step-4').hide();
    $('#loader').show();

    //отправка ajax запроса
    $.ajax({

        url: "/services/amazon-ads-show-product-in-file",
        type: "GET",
        data: {
            filename : filename,
            fromLang : $("#amazon_ads_original_lang").val(),
            toLang : $("#amazon_ads_localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#amazon-ads-step-3').html(data);
            $('#loader').hide();
            $('#amazon-ads-step-3').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#amazon-ads-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            $("#loader").hide();
            alert('Ошибка');
        }

    });

}//amazonAdsShowProducts

//отметить все товары для файла
function checkAllProductAds() {

    // Отметить все
    $('#productsForFile input:checkbox').prop('checked', $('#allCheckInTable').is(':checked'));

}//checkAllProductAds()

//предварительный просмотр данных
function previewAmazonAdsFile() {

    $('#loader').show();
    var scrollTop = $('#loader').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

    $('#amazon-ads-step-4').hide();

    var products = [];

    //заполняем массив значениями отмеченных ссылок
    $('#productsForFile input:checkbox:checked').each(function(){

        products.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(products);



    //отправка ajax запроса
    $.ajax({

        url: "/services/amazon-ads-preview-file",
        type: "GET",
        data: {sku:json,
            fromLang:$("#amazon_ads_original_lang").val(),
            toLang:$("#amazon_ads_localization").val(),
            category_status:$("#amazon_ads_category_status").val(),
            type_keywords:$("#amazon_ads_type_keywords").val(),
            show_keywords:$("#amazon_ads_template_keyword").val(),
            show_match_type:$("#amazon_ads_match_type_keywords").val(),
            campaign_daily_budet:$("#amazon_ads_daily_budget").val(),
            campaign_start_date:$("#amazon_ads_start_date").val(),
            is_need_email:$("#is_need_email").val(),
            need_email:$("#need_email").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#amazon-ads-step-4').html(data);
            $('#amazon-ads-step-4').show();
            // сперва получаем позицию элемента относительно документа
            scrollTop = $('#amazon-ads-step-4').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();


}//previewAmazonAdsFile()

//запись данных в файл
function createAmazonAdsFile() {
    $('#loader').show();
    var scrollTop = $('#loader').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

    $('#amazon-ads-step-4').hide();

    var products = [];

    //заполняем массив значениями отмеченных ссылок
    $('#productsForFile input:checkbox:checked').each(function(){

        products.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(products);



    //отправка ajax запроса
    $.ajax({

        url: "/services/amazon-ads-write-file",
        type: "GET",
        data: {sku:json,
            fromLang:$("#amazon_ads_original_lang").val(),
            toLang:$("#amazon_ads_localization").val(),
            category_status:$("#amazon_ads_category_status").val(),
            type_keywords:$("#amazon_ads_type_keywords").val(),
            show_keywords:$("#amazon_ads_template_keyword").val(),
            show_match_type:$("#amazon_ads_match_type_keywords").val(),
            campaign_daily_budet:$("#amazon_ads_daily_budget").val(),
            campaign_start_date:$("#amazon_ads_start_date").val(),
            is_need_email:$("#is_need_email").val(),
            need_email:$("#need_email").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#amazon-ads-step-4').html(data);
            $('#amazon-ads-step-4').show();
            // сперва получаем позицию элемента относительно документа
            scrollTop = $('#amazon-ads-step-4').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();
}//createAmazonAdsFile()

//показать существующие файлы
function amazonSponsoredProductsExistFile(type_file) {

    $('#loader').show();
    $('#amazon-ads-step-2').hide();
    $('#amazon-ads-step-3').hide();
    $('#amazon-ads-step-4').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/services/amazon-ads-show-exist-file",
        type: "GET",
        data: {type:type_file,
            toLang:$("#amazon_localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#amazon-ads-step-2').html(data);
            $('#amazon-ads-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#amazon-ads-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();

}//amazonSponsoredProductsExistFile('amazon_ads')

/*Merchant Center*/
//выбор файла товаров
function MerchantCenterStep2() {

    //отправка ajax запроса
    $.ajax({

        url: "/services/merchant-center-show-step2",
        type: "GET",
        data: {checkedRadioStep2:$("input:radio[name ='merchant_center_show_step_2']:checked").val(),
            toLang:$("#localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-2').html(data);
            $('#mpa-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//MerchantCenterStep2()

//изменение выбора radiobox
function changeLinkContainerGMC() {
    $('#mpa-step-2').hide();
    $('#loader').hide();
}//changeLinkContainer()

//отправка данных на сервер
function ajaxLoadFilesGMC(formData) {

    $('#mpa-step-3').hide();
    $('#loader').show();
    $.ajax({
        url: "/services/merchant-center-load-file",
        type: "POST",
        data: formData,

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        success: function (data) {

            parseDataFromFileGMC(data);
        },
        error: function(msg) {
            alert('Ошибка!');
            $('#loader').hide();
        },
        cache: false,
        contentType: false,
        processData: false
    });

}//ajaxLoadFiles(formData)

//получаем данные из файла
function parseDataFromFileGMC(filename){

    $('#loader').show();
    $('#mpa-step-3').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/services/google-merchant-parse-data-from-file",
        type: "GET",
        data: {
            is_need_email:$("#is_need_email").is(':checked'),
            need_email:$("#need_email").val(),
            filename:filename,
            fromLang:$("#original_lang").val(),
            toLang:$("#localization").val(),
            cms:$("#cms").val(),

        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-3').html(data);
            $('#loader').hide();
            $('#mpa-step-3').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
        }

    });

}//parseDataFromFile

//отметить все продукты
function checkAllProductGMC() {

    // Отметить все
    $('#productsForFileGMC input:checkbox').prop('checked', $('#allCheckInTable').is(':checked'));

}//checkAllProductGMC()

//предварительный просмотр данных
function previewGMCFile(){

    $('#loader').show();
    var scrollTop = $('#loader').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

    $('#step-4').hide();

    var products = [];

    //заполняем массив значениями отмеченных ссылок
    $('#productsForFileGMC input:checkbox:checked').each(function(){

        products.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(products);

    //отправка ajax запроса
    $.ajax({

        url: "/services/google-merchant-preview-file",
        type: "GET",
        data: {sku:json,
            fromLang:$("#original_lang").val(),
            toLang:$("#localization").val(),
            cms:$("#cms").val(),
            description:$("#google-merchant-description").val(),
            availability:$("#google-merchant-availability").val(),
            product_category:$("#google-merchant-google-product-category").val(),
            brand:$("#google-merchant-brand").val(),
            condition:$("#google-merchant-condition").val(),
            multipack:$("#google-merchant-multipack").val(),
            is_bundle:$("#google-merchant-is-​bundle").val(),
            age_group:$("#google-merchant-age-group").val(),
            material:$("#google-merchant-material").val(),
            is_need_email:$("#is_need_email").val(),
            need_email:$("#need_email").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#step-4').html(data);
            $('#step-4').show();
            // сперва получаем позицию элемента относительно документа
            scrollTop = $('#step-4').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();

}//previewGMCFile()

//запись данных в файл
function createGMCFile() {

    $('#loader').show();
    var scrollTop = $('#loader').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

    $('#step-4').hide();

    var products = [];

    //заполняем массив значениями отмеченных ссылок
    $('#productsForFileGMC input:checkbox:checked').each(function(){

        products.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(products);

    //отправка ajax запроса
    $.ajax({

        url: "/services/google-merchant-write-file",
        type: "GET",
        data: {sku:json,
            fromLang:$("#original_lang").val(),
            toLang:$("#localization").val(),
            cms:$("#cms").val(),
            description:$("#google-merchant-description").val(),
            availability:$("#google-merchant-availability").val(),
            product_category:$("#google-merchant-google-product-category").val(),
            brand:$("#google-merchant-brand").val(),
            condition:$("#google-merchant-condition").val(),
            multipack:$("#google-merchant-multipack").val(),
            is_bundle:$("#google-merchant-is-​bundle").val(),
            age_group:$("#google-merchant-age-group").val(),
            material:$("#google-merchant-material").val(),
            is_need_email:$("#is_need_email").val(),
            need_email:$("#need_email").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#step-4').html(data);
            $('#step-4').show();
            // сперва получаем позицию элемента относительно документа
            scrollTop = $('#step-4').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();

}//createGMCFile()

//показать существующие файлы
function showGMCExistFile() {

    $('#loader').show();
    $('#mpa-step-2').hide();
    $('#mpa-step-3').hide();
    $('#step-4').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/services/google-merchant-show-exist-file",
        type: "GET",
        data: {type:""

        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-2').html(data);
            $('#mpa-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();

}//amazonSponsoredProductsExistFile('amazon_ads')

/*Yandex market*/
//способ выбора файла
function MarketplaceYandexStep2(){

    //отправка ajax запроса
    $.ajax({

        url: "/services/yandex-marketplace-show-select-file-type",
        type: "GET",
        data: {checkedRadioStep2:$("input:radio[name ='show_step_2']:checked").val(),
            toLang:$("#localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-2').html(data);
            $('#mpa-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//MarketplaceYandexStep2()

//отправка данных на сервер
function ajaxLoadFilesYM(formData) {

    $('#mpa-step-3').hide();
    $('#loader').show();
    $.ajax({
        url: "/services/yandex-marketplace-load-file",
        type: "POST",
        data: formData,

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        success: function (data) {

            parseDataFromFileYM(data);
        },
        error: function(msg) {
            alert('Ошибка!');
            $('#loader').hide();
        },
        cache: false,
        contentType: false,
        processData: false
    });

}//ajaxLoadFiles(formData)

//получаем данные из файла
function parseDataFromFileYM(filename){

    $('#loader').show();
    $('#mpa-step-3').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/services/yandex-marketplace-parse-data-from-file",
        type: "GET",
        data: {
            cms: $("#cms").val(),
            is_need_email:$("#is_need_email").is(':checked'),
            need_email:$("#need_email").val(),
            filename:filename,
            fromLang:$("#original_lang").val(),
            toLang:$("#localization").val(),

        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-3').html(data);
            $('#loader').hide();
            $('#mpa-step-3').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
        }

    });

}//parseDataFromFile

//отметить все продукты
function checkAllProductYM() {

    // Отметить все
    $('#productsForFile input:checkbox').prop('checked', $('#allCheckInTable').is(':checked'));

}//checkAllProductGMC()

//предварительный просмотр файла импорта
function previewYMFile() {

    $('#loader').show();
    var scrollTop = $('#loader').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);



    var products = [];

    //заполняем массив значениями отмеченных ссылок
    $('#productsForFile input:checkbox:checked').each(function(){

        products.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(products);
    $('#mpa-step-3').html('');
    //отправка ajax запроса
    $.ajax({

        url: "/services/yandex-marketplace-preview-file",
        type: "GET",
        data: {sku:json,
            fromLang:$("#original_lang").val(),
            toLang:$("#localization").val(),
            cms:$("#cms").val(),
            available:$('#available').is(':checked'),
            delivery:$('#delivery').is(':checked'),
            pickup:$('#pickup').is(':checked'),
            store:$('#store').is(':checked'),
            category:$("#category").val(),
            sales_notes:$("#sales_notes").val(),
            manufacturer_warranty:$("#manufacturer_warranty").is(':checked'),
            country_of_origin:$("#country_of_origin").val(),
            cpa:$("#cpa").is(':checked'),

            bid:$("#bid").val(),
            cbid:$("#cbid").val(),
            is_need_email:$("#is_need_email").val(),
            need_email:$("#need_email").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-3').html(data);
            $('#mpa-step-3').show();
            // сперва получаем позицию элемента относительно документа
            scrollTop = $('#mpa-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();

}//previewYMFile()

//создание файла импорта
function createYMFile() {

    $('#loader').show();
    var scrollTop = $('#loader').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);



    var products = [];

    //заполняем массив значениями отмеченных ссылок
    $('#productsForFile input:checkbox:checked').each(function(){

        products.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(products);
    $('#mpa-step-3').html('');
    //отправка ajax запроса
    $.ajax({

        url: "/services/yandex-marketplace-write-file",
        type: "GET",
        data: {sku:json,
            fromLang:$("#original_lang").val(),
            toLang:$("#localization").val(),
            cms:$("#cms").val(),
            available:$('#available').is(':checked'),
            delivery:$('#delivery').is(':checked'),
            pickup:$('#pickup').is(':checked'),
            store:$('#store').is(':checked'),
            category:$("#category").val(),
            sales_notes:$("#sales_notes").val(),
            manufacturer_warranty:$("#manufacturer_warranty").is(':checked'),
            country_of_origin:$("#country_of_origin").val(),
            cpa:$("#cpa").is(':checked'),

            bid:$("#bid").val(),
            cbid:$("#cbid").val(),
            is_need_email:$("#is_need_email").val(),
            need_email:$("#need_email").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-3').html(data);
            $('#mpa-step-3').show();
            // сперва получаем позицию элемента относительно документа
            scrollTop = $('#mpa-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();

}//createYMFile()


/*Yandex Direct*/
//выбор файла эекспорта
function showYDStep2() {

    //отправка ajax запроса
    $.ajax({

        url: "/services/yandex-direct-show-select-file-type",
        type: "GET",
        data: {checkedRadioStep2:$("input:radio[name ='show_step_2']:checked").val(),
            toLang:$("#localization").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-2').html(data);
            $('#mpa-step-2').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-2').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//showYDStep2()

//отправка данных на сервер
function ajaxLoadFilesYD(formData) {

    $('#mpa-step-3').hide();
    $('#loader').show();
    $.ajax({
        url: "/services/yandex-direct-load-file",
        type: "POST",
        data: formData,

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        success: function (data) {

            parseDataFromFileYD(data);
        },
        error: function(msg) {
            alert('Ошибка!');
            $('#loader').hide();
        },
        cache: false,
        contentType: false,
        processData: false
    });

}//ajaxLoadFiles(formData)

//изменение выбора radiobox
function changeLinkContainerYD() {
    $('#mpa-step-2').hide();
    $('#loader').hide();
}//changeLinkContainer()

//получаем данные из файла
function parseDataFromFileYD(filename){

    $('#loader').show();
    $('#mpa-step-3').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/services/yandex-direct-parse-data-from-file",
        type: "GET",
        data: {
            cms: $("#cms").val(),
            is_need_email:$("#is_need_email").is(':checked'),
            need_email:$("#need_email").val(),
            filename:filename,
            fromLang:$("#original_lang").val(),
            toLang:$("#localization").val(),

        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-3').html(data);
            $('#loader').hide();
            $('#mpa-step-3').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mpa-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
            $('#loader').hide();
        }

    });

}//parseDataFromFile

//записываем данные в файл
function createYDFile() {
    $('#loader').show();
    var scrollTop = $('#loader').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

    var products = [];

    //заполняем массив значениями отмеченных ссылок
    $('#productsForFileGMC input:checkbox:checked').each(function(){

        products.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(products);
    $('#mpa-step-3').html('');
    //отправка ajax запроса
    $.ajax({

        url: "/services/yandex-direct-write-file",
        type: "GET",
        data: {sku:json,
            fromLang:$("#original_lang").val(),
            toLang:$("#localization").val(),
            cms:$("#cms").val(),

            campaign_type:$('#campaign_type').val(),
            currency:$('#currency').val(),
            negative_words:$('#negative-words').val(),
            item_type:$('#item_type').val(),
            header_1:$("#header_1").val(),
            header_2:$("#header_2").val(),
            description:$("#description").val(),
            region:$("#region").val(),

            is_need_email:$("#is_need_email").val(),
            need_email:$("#need_email").val(),
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mpa-step-3').html(data);
            $('#mpa-step-3').show();
            // сперва получаем позицию элемента относительно документа
            scrollTop = $('#mpa-step-3').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }
    });
    $('#loader').hide();
}//createYDFile()
