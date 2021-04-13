document.getElementById('archive_csv').onchange = function () {
    if (typeof (document.getElementById('archive_csv').files[0].name) != undefined)
        document.getElementById('file_csv').innerHTML = document.getElementById('archive_csv').files[0].name;
    else
        document.getElementById('file_csv').innerHTML = "";
}
