function markRead(id) {
    fetch("api/mark_read.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "id=" + id
    })
    .then(res => res.text())
    .then(() => location.reload());
}

function deleteMessage(id) {
    if(confirm("Delete this message?")) {
        fetch("api/delete_message.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "id=" + id
        })
        .then(res => res.text())
        .then(() => document.getElementById("msg-"+id).remove());
    }
}
