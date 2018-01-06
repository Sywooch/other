function validate() {
    var submit = true;
    if (!check_us()) submit = false;
	if (!check_mail2()) submit = false;
    return submit;
}



function check_us()
{
    $("#us_error").html("¬ведите номер в следующем формате: +7(XXX)XXX-XX-XX");
    if ($("#us").val() == "")
    {
        $("#us_error").show();
        return false;
    }
    else
    {
        if (validateus($("#us").val()))
        {
            $("#us_error").hide();
            return true;
        }
        else
        {
            $("#us_error").show();
            return false;
        }
    }
}

function check_mail2()
{
    $("#mail2_error").html("¬ведите ¬аш email");
    if ($("#mail2").val() == "")
    {
        $("#mail2_error").show();
        return false;
    }
	else
        {
            return true;
        }
}

function validateus(mail2) {
    var re = /^{4,44}\d$/;
    return re.test(mail2);
}
function validateus(us) {
    var re = /^\+\d[\d\(\)\ -]{4,14}\d$/;
    return re.test(us);
}


