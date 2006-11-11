<SCRIPT>

var date_arr = new Array;
var days_arr = new Array;

date_arr[0]=new Option("January",31);
date_arr[1]=new Option("February",29);
date_arr[2]=new Option("March",31);
date_arr[3]=new Option("April",30);
date_arr[4]=new Option("May",31);
date_arr[5]=new Option("June",30);
date_arr[6]=new Option("July",31);
date_arr[7]=new Option("August",31);
date_arr[8]=new Option("September",30);
date_arr[9]=new Option("October",31);
date_arr[10]=new Option("November",30);
date_arr[11]=new Option("December",31);

function fill_select(f)
{
        document.writeln("<SELECT class='select' name=\"reg_months\"               onchange=\"update_days(FRM)\">");
        for(x=0;x<12;x++)
                document.writeln("<OPTION value=\""+date_arr[x].value+"\">"+date_arr[x].text);
        document.writeln("</SELECT><SELECT class='select' name=\"reg_days\"></SELECT>");
        selection=f.reg_months[f.reg_months.selectedIndex].value;
}

function update_days(f)
{
        temp=f.reg_days.selectedIndex;
        for(x=days_arr.length;x>0;x--)
        {
                days_arr[x]=null;
                f.reg_days.options[x]=null;
         }
        selection=parseInt(f.reg_months[f.reg_months.selectedIndex].value);
        ret_val = 0;
        if(f.reg_months[f.reg_months.selectedIndex].value == 28)
        {
                year=parseInt(f.reg_years.options[f.reg_years.selectedIndex].value);
                if (year % 4 != 0 || year % 100 == 0 ) ret_val=0;
                else
                        if (year % 400 == 0)  ret_val=1;
                        else
                                ret_val=1;
        }
        selection = selection + ret_val;
        for(x=1;x < selection+1;x++)

        {
                days_arr[x-1]=new Option(x);
                f.reg_days.options[x-1]=days_arr[x-1];
        }
        if (temp == -1) f.reg_days.options[0].selected=true;
        else
             f.reg_days.options[temp].selected=true;
}
function year_install(f)
{
        document.writeln("<SELECT class='select' name=\"reg_years\" onchange=\"update_days(FRM)\">")
        for(x=1906;x<1998;x++) document.writeln("<OPTION value=\""+x+"\">"+x);
        document.writeln("</SELECT>");
        update_days(f)
}
</script>