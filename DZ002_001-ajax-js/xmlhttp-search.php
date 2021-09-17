<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="RNWA projekt">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="Lucija Lasic, Antonia Pinjuh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RNWA Projekt</title>
    <style>
        body,
        html {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            margin: 0px !important;
        }
        
        .grid-container {
            height: 100%;
            display: grid;
            width: 100%;
            grid-template-columns: 15% 85%;
            grid-template-rows: 80px 100% 100px;
            gap: 0px 0px;
            grid-template-areas: "header header" "sidebar mainArea" "sidebar footer";
        }
        
        .header {
            grid-area: header;
            background: #ba936c;
            display: flex;
            align-items: center;
            padding-left: 1em;
            color: rgb(247, 247, 247);
            font-weight:bold;
            box-shadow: 0 4px 4px rgb(0 0 0 / 16%);
        }
        
        .sidebar {
            color: #8f434383;
            font-size: 18px;
            flex-direction: column;
            background: #fffde4;
            grid-area: sidebar;
            height: 100%;
            box-shadow: 0 6px 4px rgb(0 0 0 / 16%);
        }
        
        .sidebar .navWrapper {
            margin-bottom: 1.5em !important;
        }
        
        .mainArea {
            height: 100%;
            grid-area: mainArea;
            padding: 3em;
            font-size: 16px;
            color: #4d4d4d
        }

        #input {
            width: 30%;
            height: 32px;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        td,
        th {
            text-align: left;
            padding: 8px;
        }
        
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        
        a {
            color: inherit;
            text-decoration: none;
        }
        
        .emailPng {
            filter: invert(15%);
            margin-right: 1em;
            height: 12px;
            margin-left: 5px;
        }
        
        .emailWrapper {
            height: 50px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        
        .nav {
            margin-top: 1em;
            padding: 10%;
        }
        
        .mainAreaPng {
            width: 40%;
        }
        
        .emailLink {
            display: flex;
            align-items: center;
        }
        
        .imgWrapper {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        
        .footer {
            background: #7f861870;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            grid-area: footer;
        }
        
        .copyright {
            color: #1B1B1B;
            font-size: 13px;
        }
        
        .tableWrapper {
            border: 1px solid #dddddd;
            max-width: 100%;
            overflow-x: auto;
        }
        
        .navWrapper {
            display: flex;
            align-items: center;
        }
        
        .emailLink .navPng {
            margin-right: 5px;
            height: 18px;
            filter: invert(20%);
            color: #4D4D4D !important;
        }
        
        @media only screen and (max-width: 900px) {
            .sidebar {
                font-size: 14px !important;
            }
            .mainArea {
                font-size: 14px;
            }
            .mainAreaPng {
                width: 70%;
            }
            .grid-container {
                grid-template-columns: 25% 75%;
            }
        }
    </style>
    <script>
        function searchProduct(input) {
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("searchTable").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "products.php?input=" +"'"+ input+"'", true);
            xmlhttp.send();
        }
    </script>
</head>

<body>
    <div class="grid-container">
        <div class="header">
            Inventory Management
        </div>
        <div class="sidebar">
            <div class="nav">
                <div class="navWrapper">
                    <a class="emailLink" href="http://fsre.sum.ba/naslovnica/" target="_blank">
                        <img class="navPng" src="https://cdn.onlinewebfonts.com/svg/img_364590.png" alt="">
                        <div>FSRE</div>
                    </a>
                </div>
                <div>
                    <a class="emailLink" href="https://www.sum.ba/" target="_blank">
                        <img class="navPng" src="http://getdrawings.com/free-icon-bw/headquarters-icon-14.png" alt="">
                        <div>SUM Mostar</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="mainArea">
            <h1>Welcome to Inventory Management!</h1>
            <div class="imgWrapper">
                <img class="mainAreaPng" src="../purchase-guy.png" alt="Shop">
            </div>
            <div class="tableWrapper">
                <div class="search-container">
                    <form>
                    <input id="input" type="text" placeholder="🔍  Pretražite po punom nazivu..." name="search" onkeyup="searchProduct(this.value)">
                    <div id="searchTable">
                        <?php 
                            require ("../DZ-sjediste/products.php")
                        ?>
                    </div>
                    </form>
                </div>
                <?php
                    
                ?>
            </div>
            <br><br>
            <h2>Fugiat dolorem labore</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat dolorem labore pariatur delectus iusto facilis deserunt ab omnis aut? Omnis numquam fuga esse dolores illo! Excepturi, ducimus? Et, cum cupiditate!</p>
            <br><br>
            <div class="tableWrapper">
                <table id="customers">
                    <tr>
                        <th>Product Name </th>
                        <th>Product Description</th>
                        <th>Product Category</th>
                        <th>Re-Order Point</th>
                    </tr>
                    <tr>
                        <td>ES30</td>
                        <td>ES30 Desc</td>
                        <td>SAMSUNG</td>
                        <td>15</td>
                    </tr>
                    <tr class="alt">
                        <td>ES25</td>
                        <td>ES25 Desc</td>
                        <td>SAMSUNG</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <td>ES65</td>
                        <td>ES65 Desc</td>
                        <td>SAMSUNG</td>
                        <td>4</td>
                    </tr>
                    <tr class="alt">
                        <td>ES75</td>
                        <td>ES75 Desc</td>
                        <td>SAMSUNG</td>
                        <td>19</td>
                    </tr>
                    <tr>
                        <td>ES70</td>
                        <td>ES70 Desc</td>
                        <td>SAMSUNG</td>
                        <td>2</td>
                    </tr>
                    <tr class="alt">
                        <td>ES20</td>
                        <td>ES20 Desc</td>
                        <td>SAMSUNG</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>ES73</td>
                        <td>ES73 Desc</td>
                        <td>SAMSUNG</td>
                        <td>10</td>
                    </tr>
                    <tr class="alt">
                        <td>ES80</td>
                        <td>ES80 Desc</td>
                        <td>SAMSUNG</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>DSC-HX7V</td>
                        <td>DSC-HX7V Desc</td>
                        <td>SONY</td>
                        <td>5</td>
                    </tr>
                    
                </table>
            </div>
        </div>
        <div class="footer">
            <div class="emails">
                <div class="emailWrapper">
                    <a class="emailLink" href="mailto:lucija.lasic@student.fsre.com" target="_blank">
                        <div class="copyright">Lucija Lasic</div>
                        <img class="emailPng" src="https://pluspng.com/img-png/email-icon-png-download-icons-logos-emojis-email-icons-2400.png" alt="">
                    </a>
                    <a class="emailLink" href="mailto:antonia.pinjuh@student.fsre.com" target="_blank">
                        <div class="copyright">Antonia Pinjuh</div>
                        <img class="emailPng" src="https://pluspng.com/img-png/email-icon-png-download-icons-logos-emojis-email-icons-2400.png" alt="">
                    </a>
                </div>
            </div>
            <div class="copyright">&copy; Copyright 2021 </div>
        </div>
    </div>
</body>

</html>