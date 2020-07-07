<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees | PATROCLE.ME</title>

    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="inc/css/main.css">

    <script src="inc/js/timedate.js" defer></script>
</head>
<body>
    
    <?php
        require 'inc/html/sidebar.php';
    ?>

    <!-- TABELUL FUNCTIONEAZA, TO DO SEARCH MAI COMPLEX
        OBLIGATORIU ACTUALIZARE REGULA CSS (2n+1) LA RANDURILE TABELULUI DUPA SEARCH -->

    <div class="ucp-wrapper">
        <div class="ucp-navbar">
            <div id="ucp-navbar-info">
                <h3 id="page-title">Employees</h3>
                <span id="page-detail">Detailed overview of your employees</span>
            </div>
            <div id="ucp-navbar-time">
                <span id="timedate"></span>
            </div>
        </div>
        <div class="table-card" id="employees-table">
            <div class="table-card-header">
                <div id="table-title">EMPLOYEES</div>
                <div id="table-header-action">
                    <input type="text" id="employee-search-input" onkeyup="search()" placeholder="search...">
                    <a href="employees/add" class="btn-primary" id="table-header-btn">+ ADD EMPLOYEE</a>
                </div>
            </div>
            
            <div class="table-content">
                <table id="employees-table-admin">
                    <tr class="table-header">
                        <th style="width: 7%">#</th>
                        <th style="width: 17%">NAME</th>
                        <th style="width: 17%">TEAM</th>
                        <th style="width: 19%">RFID-TAG</th>
                        <th style="width: 23%">LAST SEEN</th>
                        <th style="width: 19%">ACTION</th>
                    </tr>
                    
                    <?php 
                        $counter = 0;
                        foreach($this->data as $employee) {
                            $counter++;
                            echo '<tr>';
                            echo "<td>{$counter}</td>";
                            echo "<td>".$employee[0]['display_name']."</td>";
                            echo "<td>".$employee[0]['team']."</td>";
                            echo "<td>".$employee[0]['rfid_tag']."</td>";
                            echo "<td>".$employee[0]['last_seen']."</td>";
                            echo "<td class=\"td-inline-btns\">";
                            echo "<a href=\"employees/view?=".$employee[0]['uid']."\" class=\"btn-primary table-row-btn\">VIEW</a>";
                            echo "<a href=\"employees/delete?=".$employee[0]['uid']."\" class=\"btn-danger table-row-btn\">DELETE</a>";
                            echo "</td>";
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
            
        </div>
        
    </div>

    </div>

    <script>
        function search() {
            var input = document.getElementById('employee-search-input');
            var filter = input.value;
            var table = document.getElementById('employees-table-admin');
            var tr = table.getElementsByTagName('tr');

            for(let i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName('td')[1];
                if(td) {
                    let textVal = td.textContent;
                    if(textVal.indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>
</html>

<!-- 
    <tr>
        <td>1</td>
        <td>Ion Ungureanu</td>
        <td>Networking</td>
        <td>AC-34-F3-D9</td>
        <td>1:53PM 04/04/2020</td>
        <td class="td-inline-btns">
            <a href="employees/view?=2" class="btn-primary table-row-btn">VIEW</a>
            <a href="" class="btn-danger table-row-btn">DELETE</a>
        </td>
    </tr>
 -->