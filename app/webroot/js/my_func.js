/*
    Change Url Slag
*/
function changeUrlSlag()
{
    var cat_name = document.getElementById('inputName').value;
    var tmp = cat_name.split(" ").join("-");
    document.getElementById('inputURLSlag').value = tmp.toLowerCase();
}
