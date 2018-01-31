//var files; // переменная. будет содержать данные файлов

// Данная функция выполняется, когда объектная модель готова к использованию:

$( document ).ready(function() {

    $('#bad-links-step-2').hide();
    $('#bad-links-step-3').hide();
    $('#get-all-links-step-2').hide();
    $('#loader').hide();
    $('#sitemap-step-2').hide();
    $('#sitemap-step-3').hide();
    $('#sitemap-step-4').hide();
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
        data: {get_bad_links_from_area: json},

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
    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-get-all-links",
        type: "POST",
        data: {main_uri:$("#uri-for-check").val(),
               is_check_images:$("#is_check_images").is(':checked'),
               is_check_mining:$("#is_check_mining").is(':checked')
        },

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {
            $('#loader').hide();
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
            alert('Ошибка!Проверьте указанный адрес');
        }

    });

}//startCheckSite

//данных из файла
function showDataInFile(filename) {

    $('#loader').show();
    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-get-links-show-data",
        type: "POST",
        data: {filename:filename},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {
            $('#loader').hide();
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
        }

    });

}//showDataInFile

//показать ранее созданные файлы
function showAllFiles() {

    $('#loader').show();
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
        }

    });

}//showAllFiles(

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
}//changeLinkContainer()

//обработка ссылок из текста
function step3FromArea() {

    //делаем кнопку и поле ввода недоступной на время работы скрипта

    $('#sitemap-step-3').hide();
    $('#loader').show();
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
        var row = $(this).parent().parent().children().eq(2);
        temp.push(row.children("select").val());
        row = $(this).parent().parent().children().eq(3);
        temp.push(row.children("select").val());

        links.push(temp);
    });

   // console.log(links);


    //преобразуем массив в json
    var json = JSON.stringify(links);

    return json;
}//getLinksFromTable

//создание XML файла
function createXMLFile() {

    $('#sitemap-step-4').hide();
    
    var json = getLinksFromTable();
    
    //console.log(json);

    //отправка ajax запроса
    $.ajax({

        url: "/services/ajax-sitemap-step3-from-area",
        type: "POST",
        data: {data_links_xml: json},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
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
        }
    });

}//createXMLFile

//создание html файла
function createHTMLFile() {

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
        data: {data_links_html: json},

        //добавляем заголовок к запросу
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },

        //успешное выполнениу
        success: function (data) {

            $('#loader').hide();
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
        }
    });

}//createHTMLFile()

//отправка данных на сервер
function ajaxLoadFilesForSitemap(formData) {

    $('#sitemap-step-3').hide();
    $('#sitemap-step-4').hide();
    $('#loader').show();
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
        }
    });

}//step3FromExistFile()