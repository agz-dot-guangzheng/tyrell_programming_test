<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function sendAjax() {
                var player_count = $("input#num-players").val();
                $("#validate-num-players").empty();
                // validate user input
                if (player_count && player_count > 0) {
                    // Make ajax post to deal cards
                    $.post('ajax.php', {action: "dealCards", num_players: player_count}, function(res) {
                        
                        if (res, res = JSON.parse(res)) {
                            if (res.response_code == 0) {
                                $(".outputBox").empty();
                                $.each(res.data, function(idx, ele) {
                                    $(".outputBox").append(ele+"<br>");
                                });
                                // prints irregularity message
                                if (res.irregularity) {
                                    $(".outputBox").append("<br><br>"+res.irregularity);
                                }
                                
                            } else $(".outputBox").empty().append("Submission failed."+res.response_msg);
                        } else $(".outputBox").empty().append("Request error. "+res.response_msg);
                    });
                } else {
                    $(".outputBox").empty();
                    $("#validate-num-players").append('Invalid input. Please enter a number that is not Zero and greater than Zero.')
                }
            }

        </script>
        <style>
            .outputBox {
                border: 1px solid black;
                min-height: 400;
                min-width: 50%;
                width: auto;
            }
            #validate-num-players {
                font-size: 10px;
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="">
            <h3>Playing Cards Dealer</h3>
        </div>
        <div>
            <form action="POST">
                <div class="">
                    <table>
                        <tr>
                            <td><label for="num-players">Please enter number of players: </label></td>
                            <td><input type="number" name="num_players" id="num-players"><span id="validate-num-players"></span></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <button type="button" id="deal" onclick="sendAjax()">Deal cards</button>
                </div>
            </form>
            <div class="">Output:</div>
            <pre>
            <div class="outputBox">

            </div>
            </pre>
        </div>
    </body>
    <footer>
        
    </footer>
</html>
