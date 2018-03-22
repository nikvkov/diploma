//показать все сообщения
function showMessagesArchive(){

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/messages-show",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainPanel').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainPanel').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}

//jотметить все сообщения
function checkAllMessages(){

    // Отметить все
    $('#containerMessages input:checkbox').prop('checked', $('#checkAllMess').is(':checked'));

}//checkAllMessages()

//удалить все сообщения
function deleteAllMessages(){

    var messages = [];

    //заполняем массив значениями отмеченных ссылок
    $('#containerMessages input:checkbox:checked').each(function(){
        messages.push($(this).val());
    });

    var result = confirm("Подтвердите удаление "+messages.length+" сообщений!");

    if (result ==true) {
        //преобразуем массив в json
        var json = JSON.stringify(messages);

        //отправка ajax запроса
        $.ajax({

            url: "/custom-admin/delete-selected-messages",
            type: "GET",
            data: {messages: json},

            // //добавляем заголовок к запросу
            // headers: {
            //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            // },

            //успешное выполнениу
            success: function (data) {

                $('#containerMessages').html(data);
                // сперва получаем позицию элемента относительно документа
                var scrollTop = $('#containerMessages').offset().top;
                // скроллим страницу на значение равное позиции элемента
                $(document).scrollTop(scrollTop);

            },
            //при ошибке
            error: function (msg) {
                alert('Ошибка');
            }

        });
    }else{

    }

    return false
}//deleteAllMessages()

//удалить текущее сообщение
function deleteMessage(id) {

    var result = confirm("Подтвердите удаление сообщения!");

    if (result ==true) {
        //отправка ajax запроса
        $.ajax({

            url: "/custom-admin/delete-current-message/" + id,
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

                $('#containerMessages').html(data);
                // сперва получаем позицию элемента относительно документа
                var scrollTop = $('#containerMessages').offset().top;
                // скроллим страницу на значение равное позиции элемента
                $(document).scrollTop(scrollTop);
            },
            //при ошибке
            error: function (msg) {

                showMessagesArchive();
            }
        });
    }else{

    }

    return false;

}//deleteMessage

//показать сообщения по пользователю
function showByUser() {

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/messages-show-by-user/"+$('#selected_user').val(),
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#containerMessages').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#containerMessages').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//showByUser()

//показать сообщение
function viewMessage(id) {

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/show-current-message/"+id,
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

            // var elem = "#"+"message"+id;
            //
            // //console.log(elem);
            // $(elem).addClass("read");

        },
        //при ошибке
        error: function (msg) {
            $("#prevMessage").attr('srcdoc' , 'Ошибка');
        }
    });

    $("#modalMessage").modal('show');

}//ma_showMessage

/*****************ОТПРАВИТЬ НОВОЕ СООБЩЕНИЕ*********************/
function sendNewMessage() {

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-new-message",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainPanel').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainPanel').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//sendNewMessage()

//выделить пользователей для обработки
function checkUsersForData() {

    // Отметить все
    $('#t_body_users_messages input:checkbox').prop('checked', $('#selected_users').is(':checked'));

}//checkUsersForData()

var user;
//показать диалоговое окно
function sendNewMessageToUser(id_user) {

    user = id_user;
    $("#modalMessageDialog").modal('show');

}//sendNewMessageToUser

//отправить сообщение пользователю
function sendMessageToUser(){

    if(user!=0) {

        $('#success_message').hide();
        $('#error_message').hide();

        var title = $('#message_title').val();
        var content = $('#message_content').val();
        var isNeedMail = $('#is_need_mail').is(':checked');

        //отправка ajax запроса
        $.ajax({

            url: "/custom-admin/send-message-to-user",
            type: "GET",
            data: {
                title: title,
                content: content,
                user_id: user,
                is_need_email: isNeedMail
            },

            // //добавляем заголовок к запросу
            // headers: {
            //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            // },

            //успешное выполнениу
            success: function (data) {

                $('#success_message').show();

            },
            //при ошибке
            error: function (msg) {
                $('#error_message').show();
            }

        });

        $("#modalMessageDialog").modal('hide');
    }else{
        sendNewMessageToSelectedUser();
    }
}//sendMessageToUser()

//отправка сообщения выделенным пользователям
function sendNewMessageToSelectedUser() {

    var users = [];

    //заполняем массив значениями отмеченных ссылок
    $('#t_body_users_messages input:checkbox:checked').each(function(){
        users.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(users);

    $('#success_message').hide();
    $('#error_message').hide();

    var title = $('#message_title').val();
    var content = $('#message_content').val();
    var isNeedMail = $('#is_need_mail').is(':checked');

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/send-message-to-selected-users",
        type: "GET",
        data: {title: title,
            content:content,
            users_id:json,
            is_need_email : isNeedMail},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#success_message').show();

        },
        //при ошибке
        error: function (msg) {
            $('#error_message').show();
        }

    });

    $("#modalMessageDialog").modal('hide');

}//sendNewMessageToSelectedUser()

/*****************Отчеты*********************/
//Отчет по текущему пользователю
function orderForMessageToUser(user_id) {

    $('#order_message').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-message-to-user/"+user_id,
        type: "GET",
        data: {
            temp: ""
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_message_content').html(data);

        },
        //при ошибке
        error: function (msg) {
            $('#order_message_content').html("Ошибка составления отчета");
        }

    });
    $('#order_message').show();
}//orderForMessageToUser({{$user->id}})

//Составить отчет по выбранным пользователям
function orderForMessageToSelectedUser(){

    $('#order_message').hide();

    var users = [];

    //заполняем массив значениями отмеченных ссылок
    $('#t_body_users_messages input:checkbox:checked').each(function(){
        users.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(users);

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-message-selected-users",
        type: "GET",
        data: {
            users_id: json
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_message_content').html(data);

        },
        //при ошибке
        error: function (msg) {
            $('#order_message_content').html("Ошибка составления отчета");
        }

    });
    $('#order_message').show();

}//orderForMessageToSelectedUser

/*****************Новая рассылка*********************/
function newMailing(){

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-new-mailing",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainPanel').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainPanel').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//newMailing()

//начать рассылку
function startMailing(){

    $('#success_mail').hide();
    $('#error_mail').hide();

    var title = $('#mail_title').val();
    var content = $('#mail_content').val();

    var emails = [];

    //заполняем массив значениями отмеченных ссылок
    $('#t_body_mailing input:checkbox:checked').each(function(){
        emails.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(emails);

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/start-mailing",
        type: "GET",
        data: {
            title: title,
            content: content,
            emails: json
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#success_mail').show();

        },
        //при ошибке
        error: function (msg) {
            $('#error_mail').show();
        }

    });

}//newMailing()

//Отметить все имейлы
function checkSubscribrsForMailing(){

    // Отметить все
    $('#t_body_mailing input:checkbox').prop('checked', $('#selected_subscribers').is(':checked'));

}//checkAllEmails()

/*****************Архив рассылки*********************/
function archiveMailing(){

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/archive-mailing",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainPanel').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainPanel').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//archiveMailing()

//отметить все рассылки
function checkAllMailings() {

    // Отметить все
    $('#containerMailings input:checkbox').prop('checked', $('#checkAllMailings').is(':checked'));

}//checkAllMailings()

//показать сообщение рассылки
function viewMailing(id) {

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/show-current-mailing/"+id,
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

            $("#prevMailing").attr('srcdoc' , data);

        },
        //при ошибке
        error: function (msg) {
            $("#prevMailing").attr('srcdoc' , 'Ошибка');
        }
    });

    $("#modalMailing").modal('show');

}//ma_showMessage

//удалить текущее сообщение
function deleteMailing(id) {

    var result = confirm("Подтвердите удаление сообщения!");

    if (result ==true) {
        //отправка ajax запроса
        $.ajax({

            url: "/custom-admin/delete-current-mailing/" + id,
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

                $('#containerMailings').html(data);
                // сперва получаем позицию элемента относительно документа
                var scrollTop = $('#containerMailings').offset().top;
                // скроллим страницу на значение равное позиции элемента
                $(document).scrollTop(scrollTop);
            },
            //при ошибке
            error: function (msg) {

                archiveMailing();
            }
        });
    }else{

    }

    return false;

}//deleteMailing

//удалить выбранные рассылки
function deleteAllMessages() {

    var mailings = [];

    //заполняем массив значениями отмеченных ссылок
    $('#containerMailings input:checkbox:checked').each(function(){
        mailings.push($(this).val());
    });

    var result = confirm("Подтвердите удаление "+mailings.length+" сообщений!");

    if (result ==true) {
        //преобразуем массив в json
        var json = JSON.stringify(mailings);

        //отправка ajax запроса
        $.ajax({

            url: "/custom-admin/delete-selected-mailings",
            type: "GET",
            data: {mailings: json},

            // //добавляем заголовок к запросу
            // headers: {
            //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            // },

            //успешное выполнениу
            success: function (data) {

                $('#containerMailings').html(data);
                // сперва получаем позицию элемента относительно документа
                var scrollTop = $('#containerMailings').offset().top;
                // скроллим страницу на значение равное позиции элемента
                $(document).scrollTop(scrollTop);

            },
            //при ошибке
            error: function (msg) {
                alert('Ошибка');
            }

        });
    }else{

    }

    return false

}//deleteAllMessages()

/*****************Отчеты по рассылкам*********************/
//Отчет по текущему пользователю
function orderMailing(user_id) {

    $('#order_mailing').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-current-mailing/"+user_id,
        type: "GET",
        data: {
            temp: ""
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_mailing_content').html(data);

        },
        //при ошибке
        error: function (msg) {
            $('#order_mailing_content').html("Ошибка составления отчета");
        }

    });
    $('#order_mailing').show();
}//orderForMessageToUser({{$user->id}})

//Составить отчет по выбранным пользователям
function orderForAllMailing(){

    $('#order_mailing').hide();

    var mailings = [];

    //заполняем массив значениями отмеченных ссылок
    $('#containerMailings input:checkbox:checked').each(function(){
        mailings.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(mailings);

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-selected-mailings",
        type: "GET",
        data: {
            mailings_id: json
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_mailing_content').html(data);

        },
        //при ошибке
        error: function (msg) {
            $('#order_mailing_content').html("Ошибка составления отчета");
        }

    });
    $('#order_mailing').show();

}//orderForMessageToSelectedUser

/*****Пользователи****/
//отобразить страницу
function users_page(){

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/show-user-page",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainPanel').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainPanel').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//users_page()

//отчет по созданию файлов
function createOrderByFiles() {

    $('#order_data_user').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-stat-create-file",
        type: "GET",
        data: {
            temp: ""
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_data_user_content').html(data);


        },
        //при ошибке
        error: function (msg) {
            $('#order_data_user_content').html("Ошибка составления отчета");
        }

    });

    $('#order_data_user').show();

    // сперва получаем позицию элемента относительно документа
    var scrollTop = $('#mainPanel').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

}//createOrderByFiles()

//отчет по созданию отчетов
function createOrderByUserOrders() {

    $('#order_data_user').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-stat-create-order",
        type: "GET",
        data: {
            temp: ""
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_data_user_content').html(data);


        },
        //при ошибке
        error: function (msg) {
            $('#order_data_user_content').html("Ошибка составления отчета");
        }

    });

    $('#order_data_user').show();

    // сперва получаем позицию элемента относительно документа
    var scrollTop = $('#mainPanel').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

}//createOrderByFiles()

//отчет по сообщениям пользователя
function createOrderByUserMessages() {

    $('#order_data_user').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-stat-create-message",
        type: "GET",
        data: {
            temp: ""
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_data_user_content').html(data);


        },
        //при ошибке
        error: function (msg) {
            $('#order_data_user_content').html("Ошибка составления отчета");
        }

    });

    $('#order_data_user').show();

    // сперва получаем позицию элемента относительно документа
    var scrollTop = $('#mainPanel').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

}//createOrderByFiles()

//отчет по статистике рабочего времени
function createOrderByUserCteateTime() {

    $('#order_data_user').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-stat-created_time",
        type: "GET",
        data: {
            temp: ""
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_data_user_content').html(data);


        },
        //при ошибке
        error: function (msg) {
            $('#order_data_user_content').html("Ошибка составления отчета");
        }

    });

    $('#order_data_user').show();

    // сперва получаем позицию элемента относительно документа
    var scrollTop = $('#mainPanel').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

}//createOrderByFiles()

//статистика по отдельному пользователю
function orderByUser(user_id){

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-by-current-user/"+user_id,
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_data_user_content').html(data);


        },
        //при ошибке
        error: function (msg) {
            $('#order_data_user_content').html("Ошибка составления отчета");
        }

    });

    $('#order_data_user').show();

    // сперва получаем позицию элемента относительно документа
    var scrollTop = $('#mainPanel').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

}//orderByUser({{$user->id}})

//отчет по всем пользователям
function orderBySelectUsers() {

    var users = [];

    //заполняем массив значениями отмеченных ссылок
    $('#containerUsers input:checkbox:checked').each(function(){
        users.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(users);

    $('#order_data_user').hide();
    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-by-selected-users",
        type: "GET",
        data: {
            users_id: json
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_data_user_content').html(data);


        },
        //при ошибке
        error: function (msg) {
            $('#order_data_user_content').html("Ошибка составления отчета");
        }

    });

    $('#order_data_user').show();

    // сперва получаем позицию элемента относительно документа
    var scrollTop = $('#mainPanel').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

}//orderBySelectUsers()

//стаистика по текущему пользователю
function statisticByUser(user_id){

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/current-user-statistic/"+user_id,
        type: "GET",
        data: {
            ind: user_id

        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $("#modal-body_user_stat").html(data);

        },
        //при ошибке
        error: function (msg) {
            $("#modal-body_user_stat").html(msg);
        }
    });

    $("#modalUserStat").modal('show');
}//statisticByUser({{$user->id}})

//статистика по выделенным пользователям
function statisticBySelectUsers() {

    var users = [];

    //заполняем массив значениями отмеченных ссылок
    $('#containerUsers input:checkbox:checked').each(function(){
        users.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(users);

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/selected-user-statistic",
        type: "GET",
        data: {
            users_id: json
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $("#modal-body_user_stat").html(data);

        },
        //при ошибке
        error: function (msg) {
            $("#modal-body_user_stat").html(msg);
        }
    });

    $("#modalUserStat").modal('show');

}//statisticBySelectUsers()

/***ФАЙЛЫ***/
//оказать страницу "Файлы"
function files_page(){

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/show-files-page",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainPanel').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainPanel').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//files_page()

//создание отчета по файлам
function statisticExistFiles() {

    $('#order_data_file').hide();

    var files = [];

    //заполняем массив значениями отмеченных ссылок
    $('#containerFiles input:checkbox:checked').each(function(){
        files.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(files);

   // console.log(json);

    $('#order_data_file').hide();


    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-by-selected-files",
        type: "GET",
        data: {
            files_id: json
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_data_file_content').html(data);


        },
        //при ошибке
        error: function (msg) {
            $('#order_data_file_content').html("Ошибка составления отчета<br/>"+msg);
        }

    });

    $('#order_data_file').show();

    // сперва получаем позицию элемента относительно документа
    var scrollTop = $('#mainPanel').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

}//statisticExistFiles()

//выбрать все файлы
function checkAllFiles(){

    // Отметить все
    $('#containerFiles input:checkbox').prop('checked', $('#checkAllFiles').is(':checked'));


}//checkAllFiles()

/***ОТЧЕТЫ ПОЛЬЗОВАТЕЛЯ***/
function users_orders_page() {

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/show-user-orders-page",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainPanel').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainPanel').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//users_orders_page()

//выбрать все файлы
function checkAllOrders(){

    // Отметить все
    $('#containerOrders input:checkbox').prop('checked', $('#checkAllOrders').is(':checked'));


}//checkAllFiles()

//создание отчета по отчетам пользователям
function statisticExistOrders() {

    $('#order_data_file').hide();

    var files = [];

    //заполняем массив значениями отмеченных ссылок
    $('#containerOrders input:checkbox:checked').each(function(){
        files.push($(this).val());
    });

    //преобразуем массив в json
    var json = JSON.stringify(files);

    // console.log(json);

    $('#order_data_file').hide();


    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/create-order-by-selected-user-orders",
        type: "GET",
        data: {
            files_id: json
        },

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#order_data_file_content').html(data);


        },
        //при ошибке
        error: function (msg) {
            $('#order_data_file_content').html("Ошибка составления отчета<br/>"+msg);
        }

    });

    $('#order_data_file').show();

    // сперва получаем позицию элемента относительно документа
    var scrollTop = $('#mainPanel').offset().top;
    // скроллим страницу на значение равное позиции элемента
    $(document).scrollTop(scrollTop);

}//statisticExistOrders()

/***ОТЧЕТЫ АДМИНИСТРАТОРА***/
function admin_orders_page() {

    //отправка ajax запроса
    $.ajax({

        url: "/custom-admin/show-admin-orders-page",
        type: "GET",
        data: {filename: ""},

        // //добавляем заголовок к запросу
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        // },

        //успешное выполнениу
        success: function (data) {

            $('#mainPanel').html(data);
            // сперва получаем позицию элемента относительно документа
            var scrollTop = $('#mainPanel').offset().top;
            // скроллим страницу на значение равное позиции элемента
            $(document).scrollTop(scrollTop);

        },
        //при ошибке
        error: function (msg) {
            alert('Ошибка');
        }

    });

}//users_orders_page()