function vote(id, dir)
{
    $.ajax(
        {
            type: "POST",
            url: 'vote.php',
            data: {
                "id": id,
                "direction": dir,
            },
            success: onVoteReply,
            error: onError,
            dataType: "json"
        }
    );
}

function onError(res)
{
    console.log("err", res);

    $('p.error').remove();

    if (typeof(res.message) != "undefined") {
        err = res;
        msg = $('<p />').addClass("error").text("Error:" + err.message);
        msg.click(
            function () {
                $(this).remove(); }
        );
        msg.appendTo($('body'));
    }
}

function voteUp(id)
{
    vote(id, "up");
}

function voteDown(id)
{
    vote(id, "down");
}

function onVoteReply(json)
{
    if (json.type == "error") {
        if (json.cause == "needsLogin") {
            window.location = "login.php";
        } else {
            onError(json);
        }
    } else {
        voteCount = $('#quote' + json.id).find('.voteCount');

        if (json.newVal == 0) {
            voteCount.addClass('novotes');
        } else {
            voteCount.removeClass('novotes');
        }

        voteCount.text(json.newVal);
    }
}
