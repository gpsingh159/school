/* common ajax function  */
function ajax(url, method, data, asyncv = true) {
    return $.ajax({
        url: url,
        async: asyncv,
        method: method,
        data: data,
    });
}