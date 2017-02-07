<form name="eventform" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>?month=<?php echo $month;?>&day=<?php echo $day;?>&year=<?php echo $year;?>&v=true&add=true">

    <table width="400px">
        <br>

        <tr>
            <td width="50px"><input type="radio" name="Tillgängliga Tider" value="#Time 1 from db#">#Tid 1 utifrån db#</td>
        </tr>

        <tr>
            <td width="50px"><input type="radio" name="Tillgängliga Tider" value="#Time 2 from db#">#Tid 2 utifrån db#</td>
        </tr>
        <tr>
            <td width="50px"><input type="radio" name="Tillgängliga Tider" value="#Time 3 from db#">#Tid 3 utifrån db#</td>
        </tr>

        <tr>
            <td width="150px"><br>Kommentar</td>
        </tr>
        <tr>
            <td width="250px"><textarea name="txtdetail"></textarea></td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="button" name="btnback" value="Tillbacka"> &nbsp; &nbsp;
                <input type="submit" name="btnadd" value="Boka">
            </td>
        </tr>
    </table>
</form>
