// ARTEMY
// Не рекомендуется использование синхронного режима
// так как это влияет на конечное восприятие пользователя
// @ts-ignore
import {HTTPmethod} from "/static/js/HTTPMethod.js";

interface SenderReturnData {
    status: string,
    data: string | object
}

export const send = function (method: HTTPmethod, url: string, data: object, log: boolean = true, async: boolean = false) {
    url = window.location.protocol + "//" + window.location.host + "/" + url;

    let result;

    //bug workaround for ajax
    if (!url.endsWith("/", url.length)) url += "/";

    let sent;
    sent = $.post({
        url: url,
        data: data,
        async: async,
        // accepts: {json: "application/json, text/javascript"},
        dataType: "json"
    });

    let parse_result;

    function updateResult(d: JQuery.jqXHR, parsed_successfully: boolean) {
        result = d;
        parse_result = parsed_successfully;
    }

    sent.done(function (d) {
        try {
            let parsed = JSON.parse(d.responseText);
            updateResult(parsed, true)
        } catch (Error) {
            updateResult(d, false)
        }
    });
    sent.fail(function (d) {

        try {
            let parsed = JSON.parse(d.responseText);
            updateResult(parsed, true)
        } catch (Error) {
            updateResult(d, false)
        }

    });

    if (log) {
        console.group("send() FUNCTION to: ", url);

        console.groupCollapsed("отправленные данные");
        console.table(data)
        console.groupEnd();
        if (parse_result === false) {
            console.error("%c Ошибка сервера", 'background: #444; color: #ba4324;');
            console.info(result.responseText);
        }

        if (result["status"] === "success") {
            console.log("%c Ответ с сервера: ", 'background: #00FF00; color: #ba4324; font-size: 2em')
            // @ts-ignore
            console.log(result["data"])
            console.log("%c Конец ответа. ", 'background: #00FF00; color: #ba4324; font-size: 2em')
        }

        // @ts-ignore
        if (result["status"] === "error") {
            console.log("%c Ответ с сервера: ", 'background: #FFED00; color: #ba4324; font-size: 2em')
            // @ts-ignore
            console.log(result["error_message"])
            console.log("%c Конец ответа. ", 'background: #FFED00; color: #ba4324; font-size: 2em')
        }
        console.groupEnd();
    }
    return {
        // @ts-ignore
        status: result["status"],
        // @ts-ignore
        isSuccess: result["status"] === "success",
        // @ts-ignore
        data: result["data"],
        error: result["error_message"],
        url: url,
        object: result,
    };
}