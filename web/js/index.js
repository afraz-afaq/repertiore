var total_time = 0;

// Shorthand for $( document ).ready()
$(function () {
    $(document).on('click', '.onCollapse', function () {

        var collapse_id = $(this).attr('href');
        var check = $(collapse_id).attr('aria-expanded');
        if (check == "true") {
            $(this).children().first().attr('src', home_url + 'web/images/close.png');
        } else if (check == "false") {
            $(this).children().first().attr('src', home_url + 'web/images/expand.png');
        }

    });

});

var playlist = [];

function addToPlaylist(id, runtime) {
    runtime = parseInt(runtime);
    if ((total_time + runtime) <= max_runtime) {
        total_time += runtime;
        $("#repertoireRuntime").html("Tempo total: " + secToMinutes(total_time) + " MINUTOS");
    }
    else {
        alert("Max Repertoire Runtime Limit is " + secToMinutes(max_runtime) + " Minutes");
        return;
    }


    var url = $("#add-" + id).html();
    var newSong = "<div id='remove-" + id + "'>" +
        "<span class='remove-to' onclick='removeFromPlaylist(" + id + "," + runtime + ")'>-Remove</span> " +
        url +
        "</div>"
    $('.my-songs').append(newSong);
    playlist.push(id);
    if (playlist.length > 0)
        $('#no-songs').hide();

    $("#hiddenRuntime").val(secToMinutes(total_time));
    $("#hiddenSongs").val(playlist.toString());
}

function removeFromPlaylist(id, runtime) {
    total_time -= runtime;
    $("#repertoireRuntime").html("Tempo total: " + secToMinutes(total_time) + " MINUTOS");
    playlist = playlist.filter(function (value, index, arr) {
        return value != id;
    });
    $('#remove-' + id).remove();

    if (playlist.length <= 0)
        $('#no-songs').show();
    $("#hiddenRuntime").val(secToMinutes(total_time));
    $("#hiddenSongs").val(playlist.toString());
}

function secToMinutes(time) {
    var minutes = Math.floor(time / 60);
    var seconds = time - minutes * 60;
    return str_pad_left(minutes, '0', 3) + ':' + str_pad_left(seconds, '0', 2);
}

function str_pad_left(string, pad, length) {
    return (new Array(length + 1).join(pad) + string).slice(-length);
}

$('#request-form')
    .on('beforeSubmit', function (event) {
        if (total_time <= 0) {
            alert("Please select some song(s).");
            event.preventDefault();
        }

    })
    .on('submit', function (event) {
        if (total_time <= 0) {
            event.preventDefault();
        }
    });