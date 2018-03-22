/*Фунции для кабинета*/

//показать страницу заказов
function showPage(page) {
    $("#mainContainer").html();

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-page",
        type: "GET",
        data: {page:page},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainContainer').html(data);
            $('#mainContainer').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainContainer').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });
}//showOrdersPage

//вывести данные по всем файлам пользователя
function ma_showAllUserFile(){

    $("#dataForFiles").html();
    $("#detailData").html();

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-file-info",
        type: "GET",
        data: {test:"test"},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });
}//ma-showAllUserFile

//вывести данные по всем файлам пользователя
function ma_showProjectUserFile(project){

    $("#dataForFiles").html();
    $("#detailData").html();
    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-file-in-project",
        type: "GET",
        data: {project:project},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });
}//ma-showAllUserFile

//вывести данные по сервису
function ma_showServiceUserFile(service){

    $("#dataForFiles").html();
    $("#detailData").html();
    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-file-in-service",
        type: "GET",
        data: {service:service},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });
}//ma-showAllUserFile

//показать детализацию по сервисам
function ma_showDetailData(ind) {

    $("#detailData").html();
    $("#dataForFiles").html();

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-detail-data",
        type: "GET",
        data: {ind:ind},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#detailData').html(data);
            $('#detailData').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#detailData').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//ma_showDetailData

//найти файлы
function searchFile() {

    $("#dataForFiles").html();
    $("#detailData").html();
    //отправка ajax запроса
    $.ajax({

        url: "/my-account/search-file",
        type: "GET",
        data: {filename: $("#search_filename").val()},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//seachFile()

/*Отчеты*/
//создать отчет по всем файлам пользователя
function ma_createOrderAllUserFile(){

    $("#dataForFiles").html();
    $("#detailData").html();

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/create-all-file-order",
        type: "GET",
        data: {test:"test"},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });
}//ma-showAllUserFile

//создать отчет по файлам проекта
function ma_createOrderAtProjectUserFile(ind) {

    $("#dataForFiles").html();
    $("#detailData").html();
    //отправка ajax запроса
    $.ajax({

        url: "/my-account/create-order-file-in-project",
        type: "GET",
        data: {project:ind},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//ma_createOrderAtProjectUserFile

//создать отчет по файлам сервиса
function ma_createOrderAtServiceUserFile(ind) {

    $("#dataForFiles").html();
    $("#detailData").html();
    //отправка ajax запроса
    $.ajax({

        url: "/my-account/create-order-file-in-service",
        type: "GET",
        data: {service:ind},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//ma_createOrderAtServiceUserFile

//вывести данные по всем отчетам пользователя
function ma_showAllUserOrder(){

    $("#dataForFiles").html();
    $("#detailData").html();

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-order-info",
        type: "GET",
        data: {test:"test"},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });
}//ma_showAllUserOrder

//вывести данные по всем отчетам пользователя
function ma_showProjectUserOrder(project){

    $("#dataForFiles").html();
    $("#detailData").html();
    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-order-in-project",
        type: "GET",
        data: {project:project},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });
}// ma_showProjectUserOrder

//показать детализацию по сервисам
function ma_showDetailDataForOrder(ind) {

    $("#detailData").html();
    $("#dataForFiles").html();

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-detail-data-for-order",
        type: "GET",
        data: {ind:ind},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#detailData').html(data);
            $('#detailData').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#detailData').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//ma_showDetailData

//вывести данные по сервису
function ma_showServiceUserOrder(service){

    $("#dataForFiles").html();
    $("#detailData").html();
    //отправка ajax запроса
    $.ajax({

        url: "/my-account/show-order-in-service",
        type: "GET",
        data: {service:service},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });
}//ma-showAllUserFile

//найти отчеты
function searchOrder() {

    $("#dataForFiles").html();
    $("#detailData").html();
    //отправка ajax запроса
    $.ajax({

        url: "/my-account/search-order",
        type: "GET",
        data: {filename: $("#search_order").val()},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#dataForFiles').html(data);
            $('#dataForFiles').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#dataForFiles').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//seachFile()

/*Профиль*/
//добавить дополнительные данные пользователя
function additionalData() {

    // $("#dataForFiles").html();
    // $("#detailData").html();

    //отправка ajax запроса
    $.ajax({

        url: "/subscribe/add-user-data",
        type: "GET",
        data: {
            tel: $("#addInputTel").val(),
            skype: $("#addInputSkype").val(),
            country: $("#addInputCountry").val(),
            city: $("#addInputCity").val(),
            b_date: $("#addInputDate").val(),

        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            showPage('person');
            $('#mainContainer').html(data);
            $('#mainContainer').show();
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainContainer').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }


    });
}//additionalData

/*Сообщения*/
// $("#modalMessage").modal('show');
function ma_showMessage(id) {

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/get-message-body",
        type: "GET",
        data: {
            ind: id

        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $("#prevMessage").attr('srcdoc' , data);

            var elem = "#"+"message"+id;

            //console.log(elem);
            $(elem).addClass("read");

        },
        //при ошибке
        error: function (msg) {
            $("#prevMessage").attr('srcdoc' , 'Ошибка');
        }
    });

        $("#modalMessage").modal('show');

}//ma_showMessage

//закрытие модального окна
function closeModal(){
    showPage('message');
}

//найти сообщение
function searchMessage() {


    //отправка ajax запроса
    $.ajax({

        url: "/my-account/search-message",
        type: "GET",
        data: {filename: $("#search_message").val()},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#search_item').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#search_item').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//seachFile()

//показать все прочитанные сообщения
function showReadMessages(){

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/search-read-message",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#search_item').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#search_item').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//showReadEvents()

//показать все непрочитанные сообщения
function showNoReadMessages(){

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/search-noread-message",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#search_item').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#search_item').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}


/*Events*/
function ma_showEvents(id) {

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/get-event-body",
        type: "GET",
        data: {
            ind: id

        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $("#prevMessage").html(data);

            //console.log(elem);
            $(elem).addClass("read");

        },
        //при ошибке
        error: function (msg) {
            $("#prevMessage").html('Ошибка');
        }
    });

    $("#modalMessage").modal('show');

}//ma_showMessage

//найти событие
function searchEvent() {

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/search-event",
        type: "GET",
        data: {filename: $("#search_event").val()},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#search_item').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#search_item').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//seachFile()

//показать все прочитанные сообщения
function showReadEvents(){

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/search-read-event",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#search_item').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#search_item').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//showReadEvents()

//показать все непрочитанные сообщения
function showNoReadEvents(){

    //отправка ajax запроса
    $.ajax({

        url: "/my-account/search-noread-event",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#search_item').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#search_item').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}
