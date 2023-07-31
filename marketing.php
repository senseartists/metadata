<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Track - SENSE</title>
    <link href="/CSS/style.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="back-btn">
            <a href="index.php">Back</a>
        </div>
        <h1>Marketing</h1>
        <form action="PHP/insert_track.php" method="post">
           
            <div class="form-group">
                <label for="genre">Pitch/Description:</label>
                <br>
                <textarea type="text" id="genre" name="genre" required> </textarea>
            </div>
        </form>

        <!-- Pop-up message box -->
        <div class="message-container" id="messageContainer">
            <div class="message-box" id="messageBox">
                <p id="messageContent"></p>
                <button onclick="closeMessageBox()">OK</button>
            </div>
        </div>
    </div>
</body>
</html>
