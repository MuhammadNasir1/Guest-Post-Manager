<!DOCTYPE html>
<html>

<head>
    <title>Welcome To LMS</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .mainContainer {
        margin-left: 30px
    }


    .mainContainer h1 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 50px;
        text-align: center;
        margin-top: 50px;
        color: #339b96;
        font-weight: bolder;
    }

    .mainContainer h2 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 36px;
        margin-top: 50px;
        color: #339b96;
        font-weight: bolder;
    }
</style>

<body>
    <div class="mainContainer">
        <div>
            <h2>Here is it login credentials:</h2>
        </div>
        <div style="display: flex; justify-content: center; ">
            <div style="display: flex; align-items: center; ">
                <h2 style="color:#edbd58;font-size:26px">Email: </h2>
                <h2 style="font-size:26px;">{{ $email }}</h2>
            </div>
            <div style="display: flex; align-items: center; gap:20px; margin-left: 30px;  ">
                <h2 style="color:#edbd58;font-size:26px;">Password: </h2>
                <h2 style="font-size:26px;">{{ $Mpassword }}</h2>
            </div>
        </div>
    </div>
</body>

</html>
